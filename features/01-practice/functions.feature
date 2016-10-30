Feature: Functions

Background:
  Given your bootstrap file is readable
  And I load the file REPOSITORY_ROOT."practice/functions.php"

@start
Scenario: Basic function
  And the function 'doSomething' exists
  When I call 'doSomething'
  Then it should return the output 'Hi There'
  
