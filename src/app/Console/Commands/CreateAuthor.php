<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Services\SymfonySkeletonService;
use Illuminate\Console\Command;

class CreateAuthor extends Command
{
    const SUCCESS_MESSAGE = 'Successfully created author: %s %s';
    const ERROR_MESSAGE = 'An error occurred while creating the author!';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for creating a new Author';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $author = new Author();
        $author->firstName = $this->ask('Enter first name:');
        $author->lastName = $this->ask('Enter last name:');
        $author->birthday = $this->ask('Enter birthday:');
        $author->biography = $this->ask('Enter biography:');
        $author->gender = $this->ask('Enter gender:');
        $author->placeOfBirth = $this->ask('Enter place of birth:');
        $token = $this->ask('Enter API token:');

        $response = SymfonySkeletonService::createAuthor($author, $token);

        if ($response->successful()) {
            $this->info(sprintf(self::SUCCESS_MESSAGE, $author->firstName, $author->lastName));
            return Command::SUCCESS;
        } else {
            $this->error(self::ERROR_MESSAGE);
            return Command::FAILURE;
        }
    }
}
