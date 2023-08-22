<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use Illuminate\Support\Facades\Http;

use function App\Helpers\palindromeChecker;

class WordController extends Controller
{
    public function verifyWord($wordOrRequest)
    {
        if (is_string($wordOrRequest)) {
            $word = $wordOrRequest;
        } else {
            // It's an HTTP request, so retrieve the word from the request.
            $validatedData = $wordOrRequest->validated();
            $word = $validatedData["word"];
        }

        $cleanedStr = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $word));

        $apiUrl = "https://api.dictionaryapi.dev/api/v2/entries/en/$cleanedStr";
        $response = Http::get($apiUrl);

        if (!$response->successful()) {
            return response()->json(['valid' => false]);
        }

        $checkPalindrome = palindromeChecker($cleanedStr);
        $uniqueLettersCount = count(array_unique(str_split($cleanedStr)));

        $score = $uniqueLettersCount;
        if ($checkPalindrome == "is a palindrome") {
            $score += 3;
        }
        if ($checkPalindrome == "is almost a palindrome") {
            $score += 2;
        }

        return response()->json(['valid' => true, 'palindrome' => $checkPalindrome, 'uniqueLetters' => $uniqueLettersCount, 'score' => $score]);
    }
}
