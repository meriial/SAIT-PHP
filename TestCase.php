<?php

use aik099\PHPUnit\BrowserTestCase;
use Behat\Mink\WebAssert;
use Behat\Mink\Exception\ExpectationException;

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
        $this->statusCodeEquals(200, 'Could not find page "'.HTTP_ROOT.'/'.$url.'"');
    }

    public function statusCodeEquals($code, $message)
    {
        $actual = $this->getSession()->getStatusCode();
        $message = sprintf($message.'. Current response status code is %d, but %d expected.', $actual, $code);

        $this->assertTrue(intval($code) === intval($actual), $message);
    }

    public function getCurrentUrlPath()
    {
        $webAssert = $this->getAssertSession();
        return $webAssert->getCurrentUrlPath();
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
        try {
            $this->getSession()->getPage()->fillField($field, $value);
        } catch (Exception $e) {
            $message = "\n" . $e;
            throw new Exception($message);
        }

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
        $this->assertPageNotContains('Notice:', '*** There was a PHP error on the page. You must ensure there are no errors. ***');
        $this->assertPageNotContains('Parse error:', '*** There was a PHP error on the page. You must ensure there are no errors. ***');
        $this->assertPageNotContains('Fatal error:', '*** There was a PHP error on the page. You must ensure there are no errors. ***');
    }

    public function printPage()
    {
        echo "\n-------> ".$this->getSession()->getCurrentUrl()."\n";
        echo $this->getSession()->getPage()->getHtml()."\n";
        echo "-------\n";
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

    public function assertFilteredEquals($expected, $actual, $message = false)
    {
        $expected = str_replace(['\r'], '', $expected);
        $actual = str_replace(['\r'], '', $actual);

        $this->assertEquals($expected, $actual, $message);
    }

    public function assertAddressEquals($address)
    {
        $this->getAssertSession()
             ->addressEquals(HTTP_ROOT.$address);
    }

    public function assertElementCount($selector, $count, $message = false)
    {
        $webAssert = $this->getAssertSession();

        try {
            $webAssert->elementsCount('css', $selector, $count);
        } catch (ExpectationException $e) {
            $message .= "\n" . $e;
            throw new ExpectationException($message, $this->getSession()->getDriver());
        }
    }

}
