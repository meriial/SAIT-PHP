<?php

class LogTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_write_log_to_a_file()
    {
        $this->requireOnce(ASSIGNMENT_ROOT.'/files/functions.php');

        $this->assertFunctionExists('log_message');
        $this->assertFunctionExists('clear_log');

        $text = $this->faker->text;
        log_message($text);

        $log = file_get_contents(ASSIGNMENT_ROOT.'/files/log.txt');
        clear_log();

        $this->assertRegExp("/\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d $text/", $log, 'The log entry did not match the desired pattern.');

    }

    /**
     * @test
     */
    public function it_should_display_the_log_in_a_table()
    {
        clear_log();
        $word1 = $this->faker->word;
        $word2 = $this->faker->word;
        log_message($word1);
        log_message($word2);

        $this->visit('assignment/files/log.php');

        $tds = $this->getSession()->getPage()->findAll('css', 'td');

        $this->assertRegExp("/\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d $word1/", $tds[0]->getText(), 'The log entry did not match the desired pattern.');

        $this->assertRegExp("/\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d $word2/", $tds[1]->getText(), 'The log entry did not match the desired pattern.');
    }

}
