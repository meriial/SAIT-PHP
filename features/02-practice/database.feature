Feature: Databases

Background: 
  Given I have properly set up my database "sait"
  And I have reset my database by visiting "practice/db/reset.php"
  
Scenario: Create and retrieve data
  Given I am on "practice/db/create.php"
  When I enter 'something' into the 'item' field
  And I press "Submit"
  Then I should be on 'practice/db/index.php'
  And I should see "something"

Scenario: Delete data
  Given I am on "practice/db/create.php"
  When I enter 'something' into the 'item' field
  And I press "Submit"
  Then I should be on 'practice/db/index.php'
  And I should see "something"
  When I click "delete"
  Then I should be on 'practice/db/index.php'
  And I should not see "something"