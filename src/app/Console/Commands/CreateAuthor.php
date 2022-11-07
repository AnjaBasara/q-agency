<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Services\SymfonySkeletonService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;

class CreateAuthor extends Command
{
    const SUCCESS_MESSAGE = 'Successfully created author: %s %s';
    const CREATE_AUTHOR_ERROR_MESSAGE = 'An error occurred while creating the author!';
    const LOGIN_ERROR_MESSAGE = 'Incorrect username or password!';

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
        $email = $this->ask('Enter email');
        $password = $this->secret('Enter password');
        $response = SymfonySkeletonService::authenticate($email, $password);

        if ($response->failed()) {
            $this->error(self::LOGIN_ERROR_MESSAGE);
            return Command::FAILURE;
        }

        $payload = $response->json();
        Session::put('token', $payload['token_key']);

        $author = new Author();
        $author->firstName = $this->ask('Enter first name');
        $author->lastName = $this->ask('Enter last name');
        $author->birthday = $this->ask('Enter birthday');
        $author->biography = $this->ask('Enter biography');
        $author->gender = $this->ask('Enter gender');
        $author->placeOfBirth = $this->ask('Enter place of birth');

        if (SymfonySkeletonService::createAuthor($author)->successful()) {
            $this->info(sprintf(self::SUCCESS_MESSAGE, $author->firstName, $author->lastName));
            return Command::SUCCESS;
        } else {
            $this->error(self::CREATE_AUTHOR_ERROR_MESSAGE);
            return Command::FAILURE;
        }
    }
}
