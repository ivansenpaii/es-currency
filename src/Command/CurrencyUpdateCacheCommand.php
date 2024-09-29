<?php

namespace App\Command;

use App\Service\CurrencyService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'currency:update-cache', description: 'update currency cache')]
final class CurrencyUpdateCacheCommand extends Command
{
    public function __construct(private readonly CurrencyService $currencyService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->currencyService->getCurrency();

        return Command::SUCCESS;
    }
}
