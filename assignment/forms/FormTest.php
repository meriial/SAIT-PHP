<?php

class FormTest extends TestCase
{

    /**
     * @test
     */
    public function registration_should_have_3_inputs()
    {
        $this->visit('assignment/forms/registration.php');

        $webAssert = $this->getAssertSession();
        $webAssert->elementsCount('css', 'input', 3);
    }

    /**
     * @test
     */
    public function login_should_have_2_inputs()
    {
        $this->visit('assignment/forms/login.php');

        $webAssert = $this->getAssertSession();
        $webAssert->elementsCount('css', 'input', 2);
    }

    /**
     * @test
     */
    public function login_should_validate_input()
    {
        // the expected correct login should be
        // u: correct@email.com
        // p: correct-password

        // wrong password
        $webAssert = $this->getAssertSession();
        $email = $this->faker->email;
        $password = $this->faker->password;

        $this->visit('assignment/forms/login.php');

        $this->fillField('email', 'correct@email.com');
        $this->fillField('password', $password);
        $this->pressButton('Submit');

        $this->assertEquals('correct@email.com', $this->findField('email')->getValue(), 'You must re-populate the email field when validation fails.');
        $this->assertEquals($password, $this->findField('password')->getValue(),'You must re-populate the password field when validation fails.');

        $webAssert->pageTextContains('ERROR! Incorrect password.');
        $webAssert->pageTextNotContains('ERROR! Incorrect email.');

        // wrong email

        $this->visit('assignment/forms/login.php');
        $webAssert->pageTextNotContains('ERROR!');

        $this->fillField('email', $email);
        $this->fillField('password', 'correct-password');
        $this->pressButton('Submit');

        $this->assertEquals($email, $this->findField('email')->getValue(), 'You must re-populate the email field when validation fails.');
        $this->assertEquals('correct-password', $this->findField('password')->getValue(), 'You must re-populate the password field when validation fails.');
        $webAssert->pageTextContains('ERROR! Incorrect email.');
        $webAssert->pageTextNotContains('ERROR! Incorrect password.');

        // correct credentials

        $this->fillField('email', 'correct@email.com');
        $this->fillField('password', 'correct-password');
        $this->pressButton('Submit');

        $webAssert->pageTextNotContains('ERROR!');
        $this->assertAddressEquals('/assignment/forms/main.php');
    }

    /**
     * @test
     */
    public function successful_registration_redirects_to_login()
    {

        $webAssert = $this->getAssertSession();

        $this->visit('assignment/forms/registration.php');
        $webAssert->pageTextNotContains('SUCCESS!');

        $this->fillField('name', 'bob');
        $this->fillField('email', 'correct@email.com');
        $this->fillField('password', 'pass');
        $this->pressButton('Submit');

        $webAssert->pageTextNotContains('ERROR!');
        $this->assertAddressEquals('/assignment/forms/login.php');

    }

    /**
     * @test
     */
    public function main_page_echos_submitted_values()
    {

        $webAssert = $this->getAssertSession();
        $name = $this->faker->name;

        $this->visit('assignment/forms/main.php');

        $this->fillField('item', $name);
        $this->pressButton('Submit');

        $webAssert->pageTextNotContains('ERROR!');
        $this->assertAddressEquals('/assignment/forms/main.php');
        $webAssert->pageTextContains($name);

        $this->reload();
        $webAssert->pageTextContains($name);

    }
}
