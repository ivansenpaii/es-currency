<?php

namespace App\Connector;

use App\Config\CustomConfig;
use App\Service\Exceptions\AuthDataNotFoundException;
use App\Service\Exceptions\AuthTypeEmptyException;
use App\Service\Exceptions\UrlEmptyException;
use SimpleXMLElement;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use JsonException;

abstract class AbstractConnector
{
    protected HttpClientInterface $client;

    public function __construct(protected CustomConfig $customConfig)
    {
        $config = $this->getAndCheckConfig($customConfig);
        $this->compileClient($config);
    }

    abstract public function getConfigName(): string;

    /**
     * @throws UrlEmptyException
     * @throws AuthTypeEmptyException
     */
    public function getAndCheckConfig(CustomConfig $customConfig): array
    {
        $configName = $this->getConfigName();
        $config = $customConfig->getConfig($configName);

        if (empty($config['url'])) {
            throw new UrlEmptyException();
        }

        if (empty($config['auth_type'])) {
            throw new AuthTypeEmptyException();
        }

        return $config;
    }

    /**
     * @throws AuthDataNotFoundException
     */
    public function compileClient(array $config): void
    {
        $options = (new HttpOptions())->setBaseUri($config['url']);

        $authType = $config['auth_type'];

        switch ($authType) {
            case 'auth_basic':
                if (!isset($config['login']) || !isset($config['password'])) {
                    throw new AuthDataNotFoundException();
                }
                $options->setAuthBasic($config['login'], $config['password']);
                break;
            case 'none':
                break;
            default:
                throw new AuthDataNotFoundException('Unknown auth method');
        }

        $params = $options->toArray();

        if (isset($config['additional_params'])) {
            $params = array_merge($params, $config['additional_params']);
        }

        $this->client = HttpClient::create($params);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function sendRequest(string $method, string $url = '', array $headers = [], array $query = [], array $json = []): ResponseInterface
    {
        $options = [
            'headers' => $headers,
            'query' => $query,
        ];

        if (!empty($json)) {
            $options['json'] = $json;
        }

        return $this->client->request($method, $url, $options);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function sendToRest(string $method, string $url = '', array $headers = [], array $query = [], array $json = []): array
    {
        $response = $this->sendRequest($method, $url, $headers, $query, $json);
        $responseContent = $response->getContent();

        return json_decode($responseContent, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function sendToXml(string $method, string $url = '', array $headers = [], array $query = [], array $json = []): ?SimpleXMLElement
    {
        $response = $this->sendRequest($method, $url, $headers, $query, $json);
        $xmlObject = simplexml_load_string($response->getContent());

        return false === $xmlObject ? null : $xmlObject;
    }
}
