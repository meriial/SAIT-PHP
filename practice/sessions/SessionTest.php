<?php

class SessionTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_save_items_between_requests_file()
    {
        $data = join(' ',$this->faker->words(9));
        $this->visit('practice/sessions');
        $this->assertElementCount('input', 1);
        $this->fillField('item', $data);
        $this->pressButton('Submit');

        $this->visit('practice/sessions/collected-output.php');
        $this->assertPageContains($data, 'Page does not contain "'.$data.'", but it should.');
    }

    /**
     * @test
     */
    public function it_should_clear_the_session()
    {
        $data = join(' ',$this->faker->words(9));
        $this->visit('practice/sessions');
        $this->assertElementCount('input', 1);
        $this->fillField('item', $data);
        $this->pressButton('Submit');

        $this->visit('practice/sessions/collected-output.php');
        $this->assertPageContains($data, 'Page does not contain "'.$data.'", but it should.');

        $this->visit('practice/sessions/clear-session.php');
        $this->assertPageContains('Successfully Reset Session!', 'I should see "Successfully Reset Session!" when I clear the session.');

        $this->visit('practice/sessions/collected-output.php');
        $this->getSession()->reload();
        $this->assertPageNotContains($data, 'After clearing the session, I should no longer see "'.$data.'" on collected-output.php, but I do.');
    }
}
