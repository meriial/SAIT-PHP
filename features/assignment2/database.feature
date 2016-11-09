Feature: Databases

Background: 
  Given I have reset my database by visiting 'assignment2/reset.php'

@assignment2
Scenario: Create and retrieve data
  Given I register and log in as "user1@example.com"
  And I visit 'assignment2/main.php'
  When I enter 'a unique message' into the 'item' field
  And I press "Submit"
  Then I should be on 'assignment2/main.php'
  And I should see "a unique message"
  When I enter 'another unique message' into the 'item' field
  And I press "Submit"
  Then I should be on 'assignment2/main.php'
  And I should see "a unique message"
  And I should see "another unique message"

@assignment2
Scenario: Only display logged in user's content
  Given there is a user registered as "user1@example.com"
  And there is a user registered as "user2@example.com"
  When I log in as "user1@example.com"
  And I visit 'assignment2/main.php'
  And I enter 'a unique message from user 1' into the 'item' field
  And I press "Submit"
  Then I should see "a unique message from user 1"
  When I log out
  And I log in as "user2@example.com"
  And I visit 'assignment2/main.php'
  Then I should not see "a unique message from user 1"
  When I enter 'a unique message from user 2' into the 'item' field
  And I press "Submit"
  Then I should see "a unique message from user 2"
  
  
