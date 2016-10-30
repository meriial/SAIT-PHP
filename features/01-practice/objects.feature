Feature: Objects

Background:
  Given your bootstrap file is readable
  And I require the file REPOSITORY_ROOT."practice/objects.php"
  
Scenario: Looping through an object
  Given I have a 'User' class
  And I have a 'printUsers' function
  And I have an array of User objects as input
  When I run 'printUsers' with my input
  Then I should see the expected output