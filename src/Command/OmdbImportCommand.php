<?php

namespace App\Command;

use App\Api\Client\ApiClientInterface;
use App\Api\Model\DatabaseImporter;
use App\Api\Model\Movie;
use App\Api\Omdb;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
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
        private DatabaseImporter $importer,
        private EntityManagerInterface $entityManager,
        private MovieRepository $movieRepository
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
        $isDryRun = $input->getOption('dry-run');

        if ($search) {
            $io->note(sprintf('Looking up OMDB for the search term : %s', $search));
        }

        $imdbID = $io->choice('Which of these films do you want to import ?', $this->omdbApiClient->search($search));
        
        // Update
        if($this->movieRepository->findOneBy(['imdbID' => $imdbID])){
            $update = $io->confirm('This film already exists, would you like to update it ?');
            if(false === $update) return Command::INVALID;
        }

        //  Fetching movie
        $movie = $this->omdbApiClient->getById($imdbID);
        if(false === $isDryRun){
        }

        if (false === $isDryRun){
            isset($update) ? $this->importer->update($movie, $imdbID) : $this->importer->import($movie);            
            $io->success('Success');
            $io->info(' >>>>>> The following was saved to database <<<<<<< ');
        } else {
            $io->info('Abort');
            $io->info(' >>>>>> The following would have been imported : <<<<<<< ');
        }

        $io->createTable(
            array_keys(get_object_vars($movie)),
            [get_object_vars($movie)]
        );

        return Command::SUCCESS;
    }
}
