<?php

namespace App\Command;

use App\Api\Client\ApiClientInterface;
use App\Api\Model\DatabaseImporter;
use App\Api\Model\Movie;
use App\Api\Omdb;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'omdb:import',
    description: 'Add a short description for your command',
)]
class OmdbImportCommand extends Command
{
    public function __construct(
        private ApiClientInterface $omdbApiClient,
        private DatabaseImporter $importer
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('search', InputArgument::REQUIRED, 'The search string')
            ->addOption('dry-run');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $search = $input->getArgument('search');

        if ($search) {
            $io->note(sprintf('You passed : %s', $search));
        }

        /**
        if ($input->getOption('option1')) {
           // ...
        }
        
         */
        $choice = $io->choice(
            'Which of these result do you want to import ?',
            $this->client->search($search)
        );

        $this->importer->import($this->client->getById($choice));
    

        $io->success('Success');


        return Command::SUCCESS;
    }
}
