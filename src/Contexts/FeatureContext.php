<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as PHPUnit;

class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    public function __construct()
    {
        $this->iCanReadYourBootstrapFile();
    }
    
    public function configFilePath()
    {
        $cwd = getcwd();
        
        return $cwd.' '.DIRECTORY_SEPARATOR.'config.php';
    }
    
    public function visit($url)
    {
        if (!defined('HTTP_ROOT')) {
            throw new \Exception("HTTP_ROOT must be defined in your config file, located here: ".$this->configFilePath());
            
        }
        $url = HTTP_ROOT . '/' . $url;
        
        parent::visit($url);
    }
    
    public function assertPageContainsText($text)
    {
        try {
            parent::assertPageContainsText($text);
        } catch (\Behat\Mink\Exception\DriverException $e){
            throw new \Exception("I did not see anything on the page. It was empty.");
        } catch (\Exception $e) {
            $this->printLastResponse();
            throw new \Exception("Could not find '$text' in the page. This is what I saw: \n");
        }
    }
    
    /**
     * @Given the function :arg1 exists
     * @Given I have a :arg1 function 
     */
    public function theFunctionExists($functionName)
    {
        if (!function_exists($functionName)) {
            throw new \Exception("I could not find the function '$functionName'. Make sure that the file it's in has been included.");
        }
    }

    /**
     * @When I call :arg1
     */
    public function iCall($function)
    {
        $this->output = $function();
    }

    /**
     * @Then I should see the output :arg1
     * @Then it should return the output :arg1
     */
    public function iShouldSeeTheOutput($expectedOutput)
    {
        if ($this->output != $expectedOutput) {
            throw new \Exception("The expected output was '$expectedOutput'. What I saw was: '{$this->output}'");
        };
    }

    /**
     * @Given I can read your bootstrap file
     * @Given your bootstrap file is readable
     */
    public function iCanReadYourBootstrapFile()
    {
        $bootstrapFilePath = realpath('config.php');
        if (!file_exists($bootstrapFilePath)) {
            throw new \Exception("I could not find your bootstrap file at '".$this->configFilePath(). "'. Make sure that it is in the correct location.");
        }
        
        require_once $bootstrapFilePath;
        
        if (!defined('HTTP_ROOT')) {
            throw new \Exception("Your config file was readable, but you must define HTTP_ROOT so I know where to find your work. See the example.config.php");
        }
        
        if (!defined('REPOSITORY_ROOT')) {
            throw new \Exception("Your config file was readable, but you must define REPOSITORY_ROOT so I know where to find your work. See the example.config.php");
        }
    }

    /**
     * @Given my website is up and running
     */
    public function myWebsiteIsUpAndRunning()
    {
        $this->visit('practice.php');
    }


    /**
     * @Given I load the file REPOSITORY_ROOT.:arg1
     * @Given I require the file REPOSITORY_ROOT.:arg1
     */
    public function iLoadTheFileRepoRoot($file)
    {
        $path = REPOSITORY_ROOT.'/'.$file;
        if (!file_exists($path)) {
            throw new \Exception("Could not find the file at $path. Double check to make sure it is where you think it is. Also check that you set REPOSITORY_ROOT correctly.");
        }
        require_once $path;
    }
    
    /**
     * @When I call arrayDoubler() and give it an array of numbers
     */
    public function iCallArraydoublerAndGiveItAnArrayOfNumbers()
    {
        $this->input = [rand(1,20), rand(1,20), rand(1,20)];
        $this->output = arrayDoubler($this->input);
    }

    /**
     * @Then it should return an array of double those numbers
     */
    public function iShouldReturnAnArrayOfDoubleThoseNumbers()
    {
        $expectedOutput = array_map(function($e){ return $e * 2;}, $this->input);
        
        try {
            PHPUnit::assertEquals($expectedOutput, $this->output);
        } catch (\Exception $e) {
            print_r($this->input);
            throw new \Exception("Your arrayDoubler function did not properly double the array. I found this: ".print_r($this->output, true));
            
        }
        
    }

    /**
     * @Given my assignment website is up and running
     */
    public function myAssignmentWebsiteIsUpAndRunning()
    {
        $this->visit('assignment/register.php');
    }

    /**
     * @Then I should see :arg2 :arg1 elements on the page
     */
    public function iShouldSeeElements($count, $type)
    {
        try {
            $this->assertNumElements($count, $type);
        } catch (\Exception $e) {
            $this->printLastResponse();
            throw $e;
        }
        
    }

    /**
     * @Given I visit :arg1
     */
    public function iVisit($url)
    {
        $this->visit($url);
    }


    /**
     * @When I enter :arg1 into the :arg2 field
     */
    public function iEnterIntoTheField($value, $fieldName)
    {
        $this->fillField($fieldName, $value);
    }

    /**
     * @Then I should be on :arg1
     * @Then I should still be on :arg1
     */
    public function iShouldBeOn($url)
    {
        $this->assertPageAddress(HTTP_ROOT.'/'.$url);
    }

    /**
     * @Then I should see :arg1 in the :arg2 field
     */
    public function iShouldSeeInTheField($value, $fieldName)
    {
        $this->assertFieldContains($fieldName, $value);
    }


    /**
     * @Given I have an array of User objects as input
     */
    public function iHaveAnArrayOfUserObjectsAsInput()
    {
        $this->input = [
            new User('Bob', 'Smith'),
            new User('Jane', 'Doe')
        ];
        
        echo "The input is: ".print_r($this->input, true);
        
        $this->expectedOutput = "Bob Smith\nJane Doe\n";
        echo "\nThe expected output is:\n{$this->expectedOutput}";
    }

    /**
     * @When I run :arg1 with my input
     */
    public function iRunWithMyInput($function)
    {
        ob_start();
        $function($this->input);
        $this->output = ob_get_clean();
    }

    /**
     * @Then I should see the correct output
     * @Then I should see the expected output
     */
    public function iShouldSeeTheCorrectOutput()
    {
        PHPUnit::assertEquals($this->expectedOutput, $this->output);
    }

    /**
     * @Given I have a :arg1 class
     */
    public function iHaveAClass($className)
    {
        if (!class_exists($className)) {
            throw new \Exception("Class $className does not exist. Make sure you have declared it in a file that has been included.");
            
        }
    }

    /**
     * @Given I have reset my database by visiting :arg1
     */
    public function iHaveResetMyDatabaseByVisiting($url)
    {
        $this->visit($url);
        $this->printLastResponse();
    }

    /**
     * @Given I am logged out
     */
    public function iAmLoggedOut()
    {
        $this->visit('assignment2/logout.php');
    }

    /**
     * @Given there is a user registered as :arg1
     */
    public function thereIsAUserRegisteredAs($email)
    {
        $this->iRegisterAndLogInAs($email);
        $this->iAmLoggedOut();
    }

    /**
     * @When I log in as :arg1
     */
    public function iLogInAs($email)
    {
        $this->visit('assignment2/login.php');
        $this->fillField('email', $email);
        $this->fillField('password', '1234');
        $this->pressButton('Submit');
    }

    /**
     * @When I log out
     */
    public function iLogOut()
    {
        $this->visit('assignment2/logout.php');
    }

    /**
     * @Given I register and log in as :arg1
     */
    public function iRegisterAndLogInAs($email)
    {
        $this->visit('assignment2/registration.php');
        $this->fillField('email', $email);
        $this->fillField('name', 'My Name');
        $this->fillField('password', '1234');
        $this->pressButton('Submit');
        
        $this->iLogInAs($email);
    }    
    
    /**
     * @When I click :arg1
     */
    public function iClick($link)
    {
        $this->clickLink($link);
    }
    
    /**
     * @Given I have properly set up my database :arg1
     */
    public function iHaveProperlySetUpMyDatabase($db)
    {
        $sql = 'SELECT * from items';
        
        $db = new mysqli('localhost', 'root', '', $db);
        
        $result = $db->query($sql);
        
        if (!empty($db->errors)) {
            throw new \Exception("The DB is not set up properly.");
        }
    }    
}
