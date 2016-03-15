<?php

use aik099\PHPUnit\BrowserTestCase;
use Behat\Mink\WebAssert;

class TestCase extends BrowserTestCase {

    public static $browsers = array(
        array(
            'driver' => 'goutte',
            'browserName' => 'firefox',
            'baseUrl' => HTTP_ROOT,
        ),
    );

    public function setUp()
    {
        parent::setUp();

        $this->faker = Faker\Factory::create();
    }

    public function requireOnce($filepath)
    {
        if(file_exists($filepath)) {
            require_once $filepath;
        } else {
            throw new Exception("Could not find file '$filepath'. This means you need to create it. Make sure that it exists at that location and that it (and its parent directories) are spelled correctly." );
        }
    }

    public function visit($url)
    {
        $this->getSession()->visit(HTTP_ROOT.'/'.$url);
        $this->assertNoPhpErrors();
    }

    public function reload()
    {
        $this->getSession()->reload();
    }

    public function getAssertSession()
    {
        return new WebAssert($this->getSession());
    }

    public function fillField($field, $value)
    {
        $this->getSession()->getPage()->fillField($field, $value);
    }

    public function findField($field)
    {
        return $this->getSession()->getPage()->findField($field);
    }

    public function pressButton($button)
    {
        $this->getSession()->getPage()->pressButton($button);
        $this->assertNoPhpErrors();
    }

    public function assertNoPhpErrors()
    {
        $this->assertPageNotContains('Notice:', 'There was a PHP error on the page.');
        $this->assertPageNotContains('Parse error:', 'There was a PHP error on the page.');
    }

    public function assertPageContains($text, $message = false)
    {
        $this->assertTrue($this->getSession()->getPage()->hasContent($text), $message);
    }

    public function assertPageNotContains($text, $message = false)
    {
        $this->assertFalse($this->getSession()->getPage()->hasContent($text), $message);
    }

    public function assertFunctionExists($functionName)
    {
        $this->assertTrue(function_exists($functionName), "There is no function $functionName. You need to write it.");
    }

}
