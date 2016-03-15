<?php

class FormPracticeTest extends TestCase {

    /**
     * @test
     */
    public function it_should_validate_tweet()
    {

        $webAssert = $this->getAssertSession();

        $this->visit('practice/forms/tweet.php');

        $this->fillField('tweet', 'This is a really long tweet.');
        $this->pressButton('Submit');

        $this->assertEquals('This is a really long tweet.', $this->findField('tweet')->getValue());

        $webAssert->pageTextContains('ERROR! Tweet is longer than 10 characters.');

        // correct credentials

        $this->fillField('tweet', 'Short Tweet');
        $this->pressButton('Submit');

        $webAssert->pageTextNotContains('ERROR!');
        $webAssert->addressEquals('/practice/forms/tweet.php');
    }



}
