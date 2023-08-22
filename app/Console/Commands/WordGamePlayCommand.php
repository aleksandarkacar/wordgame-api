<?php

namespace App\Console\Commands;

use App\Http\Controllers\WordController;
use Illuminate\Console\Command;

class WordGamePlayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordgameplay:word {word}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Play the word game with the console command';

    /**
     * Execute the console command.
     */
    public function handle(WordController $wordController)
    {
        $word = $this->argument('word');

        $response = $wordController->verifyWord(null, $word);

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getContent(), true);
            if ($responseData['valid']) {
                $this->info("Unique Letters: {$responseData['uniqueLetters']}");
                $this->info("Palindrome Status: {$responseData['palindrome']}");
                $this->info("Score: {$responseData['score']}");
            } else {
                $this->error("Error: Word is not valid");
            }
        } else {
            $this->error("Error: {$response->getContent()}");
        }
    }
}
