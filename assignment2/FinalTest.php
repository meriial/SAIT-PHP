<?php

class FinalTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->visit('assignment2/final/logout.php', false);
        $this->resetDatabase();
        
        $this->user     = $this->faker->name;
        $this->email    = $this->faker->email;
        $this->password = $this->faker->regexify('[a-zA-Z0-9._%+-]{5,12}');
    }

    public function tearDown()
    {
        $this->visit('assignment2/final/logout.php', false);
    }

    /**
     * @test
     */
    public function it_should_register_a_user()
    {
        $this->registerUser();
    }

    /**
     * @test
     */
    public function it_should_stop_me_from_accessing_main_when_not_logged_in()
    {
        $this->registerUser();
        $this->visit('assignment2/final/main.php');
        $this->assertAddressEquals('/assignment2/final/login.php', 'When I am not logged in, I should be redirected to login.php if I try to access main.php');
    }

    /**
     * @test
     */
    public function it_should_let_me_access_main_when_logged_in()
    {
        $this->registerUser();
        $this->loginUser();
        $this->visit('assignment2/final/main.php');
        $this->assertAddressEquals('/assignment2/final/main.php', 'When I am logged in, I should be able to access main.php');
    }

    /**
     * @test
     */
    public function it_should_log_me_out()
    {
        $this->registerUser();
        $this->loginUser();
        $this->visit('assignment2/final/main.php');
        $this->assertAddressEquals('/assignment2/final/main.php', 'When I am logged in, I should be able to access main.php');

        $this->visit('assignment2/final/logout.php');
        $this->assertAddressEquals('/assignment2/final/login.php', 'When I log out I should be redirected to login.php');

        $this->visit('assignment2/final/main.php');
        $this->assertAddressEquals('/assignment2/final/login.php', 'When I am not logged in, I should be redirected to login.php if I try to access main.php');
    }

    /**
     * @test
     */
    public function it_should_save_content_entered_on_main()
    {
        $this->registerUser();
        $this->loginUser();

        $this->enterContent('hahah');

        $this->visit('assignment2/final/main.php');
        $this->assertPageContains('hahah');
    }

    /**
     * @test
     */
    public function it_should_save_multiple_pieces_of_content_entered_on_main()
    {
        $this->registerUser();
        $this->loginUser();

        $this->enterContent('hahah');
        $this->enterContent('hohoho');

        $this->visit('assignment2/final/main.php');
        $this->assertPageContains('hahah');
        $this->assertPageContains('hohoho');
    }

    /**
     * @test
     */
    public function it_should_save_content_in_database()
    {
        $this->registerUser();
        $this->loginUser();

        $this->enterContent('hahah');
        $this->enterContent('hohoho');

        $this->visit('assignment2/final/main.php');
        $this->assertPageContains('hahah');
        $this->assertPageContains('hohoho');

        $this->visit('assignment2/final/logout.php');
        $this->loginUser();

        $this->visit('assignment2/final/main.php');
        $this->assertPageContains('hahah');
        $this->assertPageContains('hohoho');
    }

    public function registerUser()
    {
        $this->visit('assignment2/final/registration.php');
        $this->fillField('name', $this->user);
        $this->fillField('email', $this->email);
        $this->fillField('password', $this->password);
        $this->pressButton('Submit');
    }

    public function loginUser()
    {
        $this->visit('assignment2/final/login.php');
        $this->fillField('email', $this->email);
        $this->fillField('password', $this->password);
        $this->pressButton('Submit');
    }

    public function enterContent($content)
    {
        $this->visit('assignment2/final/main.php');
        $this->fillField('item', $content);
        $this->pressButton('Submit');
    }

    public function resetDatabase()
    {
        $this->visit('assignment2/final/reset.php', false);
    }

}
