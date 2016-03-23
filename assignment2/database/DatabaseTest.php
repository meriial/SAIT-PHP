<?php

class DatabaseTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->requireOnce(ASSIGNMENT_ROOT_2.'/final/functions/database.php');

        $this->assertFunctionExists('resetDatabase');
        resetDatabase();

        $this->name     = $this->faker->name;
        $this->email    = $this->faker->email;
        $this->password = $this->faker->regexify('[a-zA-Z0-9_-]{5,12}');
    }

    /**
    * @test
    */
    public function it_should_store_and_retrieve_users()
    {
        $this->assertFunctionExists('storeUser');
        $this->assertFunctionExists('getUsers');

        storeUser($this->name, $this->email, $this->password);

        $users = getUsers();
        $this->assertCount(1, $users, 'There should be exactly one user.');

        storeUser($this->name, $this->email, $this->password);
        storeUser($this->name, $this->email, $this->password);
        $users = getUsers();
        $this->assertCount(3, $users, 'There should be exactly one user.');
    }

    /**
     * @test
     */
    public function it_should_retrieve_users_by_email()
    {
        $this->assertFunctionExists('getUserByEmail');
        storeUser($this->name, $this->email, $this->password);

        $user = getUserByEmail($this->email);
        $this->assertEquals($user['name'], $this->name);
    }

    /**
     * @test
     */
    public function it_should_return_false_if_the_email_does_not_exist()
    {
        $this->assertFunctionExists('getUserByEmail');
        storeUser($this->name, $this->email, $this->password);

        $user = getUserByEmail('doesnot@exist.com');
        $this->assertFalse($user);
    }

    /**
    * @test
    */
    public function it_should_store_and_retrieve_items()
    {
        $this->assertFunctionExists('getItems');
        $this->assertFunctionExists('storeItem');

        $items = getItems();
        $this->assertCount(0, $items);

        storeItem('ahha', 1);

        $items = getItems();
        $this->assertCount(1, $items);
    }

    /**
    * @test
    */
    public function it_should_store_and_retrieve_users_escaping_input()
    {
        $this->assertFunctionExists('storeUser');
        $this->assertFunctionExists('getUsers');

        storeUser('bad.\'name.', 'stop\'.now.', 'noat\'h.nteoh.');

        $users = getUsers();
        $this->assertCount(1, $users, 'There should be exactly one user.');
    }

}
