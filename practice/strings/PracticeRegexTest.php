<?php

class RegexTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_match_bob_and_Bob()
    {
        $this->requireOnce(PRACTICE_ROOT.'/strings/regex.php');
        $this->assertFunctionExists('matchesBobAndBob');

        $this->assertFalse(
            matchesBobAndBob('rob'),
            'Should only match bob and Bob.'
        );

        $this->assertTrue(
            matchesBobAndBob('bob'),
            'Should match bob and Bob.'
        );

        $this->assertTrue(
            matchesBobAndBob('Bob'),
            'Should match bob and Bob.'
        );
    }

    /**
     * @test
     */
    public function it_should_match_only_numbers()
    {
        $this->requireOnce(PRACTICE_ROOT.'/strings/regex.php');
        $this->assertFunctionExists('onlyNumbers');

        $this->assertFalse(
            onlyNumbers('rob'),
            'Should only match numbers.'
        );

        $this->assertFalse(
            onlyNumbers('123net'),
            'Should only match numbers.'
        );

        $this->assertTrue(
            onlyNumbers('123'),
            'Should only match numbers.'
        );
    }

    /**
     * @test
     */
    public function it_should_match_only_lowercase()
    {
        $this->requireOnce(PRACTICE_ROOT.'/strings/regex.php');
        $this->assertFunctionExists('onlyLowercase');

        $this->assertFalse(
            onlyLowercase('Ronald'),
            'Should only lowercase letters. "Ronald" contains a capital letter.'
        );

        $this->assertFalse(
            onlyLowercase('ronald42'),
            'Should only lowercase letters. "ronald42" contains numbers.'
        );

        $this->assertTrue(
            onlyNumbers('bob'),
            'Should match lowercase letters. "bob" should match.'
        );
    }
}
