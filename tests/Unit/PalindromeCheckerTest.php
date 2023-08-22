<?php

namespace Tests\Unit;

use Tests\TestCase;
use function App\Helpers\palindromeChecker;

class PalindromeCheckerTest extends TestCase
{
    public function testPalindromeCheckerWithPalindrome()
    {
        $word = 'racecar';

        $result = palindromeChecker($word);

        $this->assertEquals('is a palindrome', $result);
    }

    public function testPalindromeCheckerWithAlmostPalindrome()
    {
        $word = 'racecars';

        $result = palindromeChecker($word);

        $this->assertEquals('is almost a palindrome', $result);
    }

    public function testPalindromeCheckerWithNonPalindrome()
    {
        $word = 'hello';

        $result = palindromeChecker($word);

        $this->assertEquals('is not a palindrome', $result);
    }
}
