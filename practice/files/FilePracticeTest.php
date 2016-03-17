<?php

class LogTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_write_tweets_file()
    {
        $this->requireOnce(PRACTICE_ROOT.'/files/functions.php');

        $this->assertFunctionExists('write_tweet');

        $tweet = $this->faker->text;
        write_tweet($tweet);

        $tweets = file_get_contents(PRACTICE_ROOT.'/files/tweets.txt');

        $this->assertRegExp("/$tweet/", $tweets, "Could not find tweet $tweets .");
    }

}
