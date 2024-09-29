<?php

namespace App\Config;

use App\Config\Exceptions\ClientConfigurationNotFoundException;

readonly class CustomConfig
{
    public function __construct(
        private array $config
    ) {
    }

    private function clientsConfiguration(): array
    {
        return $this->config['clients_config'];
    }

    /**
     * @throws ClientConfigurationNotFoundException
     */
    public function getConfig(string $configName): array
    {
        $clients = $this->clientsConfiguration();

        return $clients[$configName] ?? throw new ClientConfigurationNotFoundException();
    }
}
