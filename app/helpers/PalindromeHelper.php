<?php

namespace App\Helpers;

function palindromeChecker($word)
{
    $wordLength = strlen($word);

    for ($i = 0; $i < $wordLength / 2; $i++) {
        if ($word[$i] !== $word[$wordLength - 1 - $i]) {
            $newWord = substr_replace($word, '', $i, 1);
            $newWord2 = substr_replace($word, '', $wordLength - 1 - $i, 1);
            $almost = $newWord === strrev($newWord) || $newWord2 === strrev($newWord2);
            if ($almost) {
                return "is almost a palindrome";
            }
            return "is not a palindrome";
        }
    }
    return "is a palindrome";
}
