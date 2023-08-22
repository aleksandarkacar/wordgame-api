<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\WordController;
use Illuminate\Testing\TestResponse;

class WordControllerTest extends TestCase
{
    public function testVerifyWordWithNonPalindrom()
    {
        $controller = new WordController();

        $word = 'creative';

        $response = $controller->verifyWord($word);
        $testResponse = TestResponse::fromBaseResponse($response);

        $testResponse->assertJsonStructure(['valid', 'palindrome', 'uniqueLetters', 'score']);

        $testResponse->assertJson(['valid' => true]);
        $testResponse->assertJson(['palindrome' => 'is not a palindrome']);
        $testResponse->assertJson(['uniqueLetters' => 7]);
        $testResponse->assertJson(['score' => 7]);
    }
    public function testVerifyWordWithAPalindrom()
    {
        $controller = new WordController();

        $word = 'madam';

        $response = $controller->verifyWord($word);
        $testResponse = TestResponse::fromBaseResponse($response);

        $testResponse->assertJsonStructure(['valid', 'palindrome', 'uniqueLetters', 'score']);

        $testResponse->assertJson(['valid' => true]);
        $testResponse->assertJson(['palindrome' => 'is a palindrome']);
        $testResponse->assertJson(['uniqueLetters' => 3]);
        $testResponse->assertJson(['score' => 6]);
    }
    public function testVerifyWordWithAlmostPalindrom()
    {
        $controller = new WordController();

        $word = 'madams';

        $response = $controller->verifyWord($word);
        $testResponse = TestResponse::fromBaseResponse($response);

        $testResponse->assertJsonStructure(['valid', 'palindrome', 'uniqueLetters', 'score']);

        $testResponse->assertJson(['valid' => true]);
        $testResponse->assertJson(['palindrome' => 'is almost a palindrome']);
        $testResponse->assertJson(['uniqueLetters' => 4]);
        $testResponse->assertJson(['score' => 6]);
    }
    public function testVerifyWordWithInvalidWord()
    {
        $controller = new WordController();

        $word = 'apowgem!$#';

        $response = $controller->verifyWord($word);
        $testResponse = TestResponse::fromBaseResponse($response);

        $testResponse->assertJsonStructure(['valid']);

        $testResponse->assertJson(['valid' => false]);
    }
}
