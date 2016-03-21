<?php

class RegexTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_validate_a_strong_password()
    {
        $this->requireOnce(ASSIGNMENT_ROOT_2.'/final/functions/strings.php');
        $this->assertFunctionExists('isStrongPassword');

        $this->assertFalse(
            isStrongPassword('aonteh'),
            'Only lowercase letters is not strong.'
        );

        $this->assertFalse(
            isStrongPassword('ANTHEU'),
            'Only uppercase letters is not strong.'
        );

        $this->assertFalse(
            isStrongPassword('asnnOTEHU'),
            'Only letters is not strong, it should check for special characters.'
        );

        $this->assertFalse(
            isStrongPassword('ao123snnOTEHU'),
            'Only alphanumeric is not strong, it should check for non-alphanumeric characters.'
        );


        $this->assertTrue(
            isStrongPassword('ao123snnOTEHU!@'),
            'A password with a mix of alphanumeric and non-alphanumeric characters should be considered strong.'
        );

    }

    /**
     * @test
     */
    public function it_should_validate_an_email_address__sort_of()
    {
        $this->requireOnce(ASSIGNMENT_ROOT_2.'/final/functions/strings.php');
        $this->assertFunctionExists('isValidEmailAddress');

        $this->assertFalse(
            isValidEmailAddress('bob'),
            '"bob" should not be considered a valid email address'
        );

        $this->assertTrue(
            isValidEmailAddress('bob@here.com'),
            '"bob@here.com" should be considered a valid email address'
        );

    }

    /**
     * @test
     */
    public function it_should_validate_an_username_is_alphanumeric()
    {
        $this->requireOnce(ASSIGNMENT_ROOT_2.'/final/functions/strings.php');
        $this->assertFunctionExists('isAlphanumeric');

        $this->assertFalse(
            isAlphanumeric('abcd!'),
            '"abcd!" should not be considered alphanumeric'
        );

        $this->assertTrue(
            isAlphanumeric('aA1'),
            '"aA1" should be considered alphanumeric'
        );

    }

}
