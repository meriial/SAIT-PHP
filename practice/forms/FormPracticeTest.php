<?php

class FormPracticeTest extends TestCase {

    /**
     * @test
     */
    public function tweet_form_should_have_1_input()
    {
        $this->visit('practice/forms/tweet.php');

        $webAssert = $this->getAssertSession();
        $webAssert->statusCodeEquals(200);
        $webAssert->elementsCount('css', 'input', 1);
    }

    /**
     * @test
     */
    public function it_should_validate_tweet()
    {

        $webAssert = $this->getAssertSession();

        $this->visit('practice/forms/tweet.php');

        $this->fillField('tweet', 'This is a really long tweet.');
        $this->pressButton('Submit');

        $this->assertEquals('This is a really long tweet.', $this->findField('tweet')->getValue(), 'When the form fails validation, it should re-populate itself so the user doesn\'t have to re-enter everything.');

        $webAssert->pageTextContains('ERROR! Tweet is longer than 10 characters.');

        // correct credentials

        $this->fillField('tweet', 'ShortTweet');
        $this->pressButton('Submit');

        $webAssert->pageTextNotContains('ERROR!');
        $this->assertAddressEquals('/practice/forms/tweet.php');
    }



}
