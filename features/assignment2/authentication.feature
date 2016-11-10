Feature: Authentication
  
Background: 
  Given I have reset my database by visiting 'assignment2/reset.php'
  
Scenario: User password has only letters
  Given I visit 'assignment2/registration.php'
  And I enter 'user1@example.com' into the 'email' field
  And I enter 'My Name' into the 'name' field
  And I enter 'onlylowercase' into the 'password' field
  And I press "Submit"
  Then I should be on 'assignment2/registration.php'
  And I should see "Your password is not complex enough."

Scenario: User password has only numbers
  Given I visit 'assignment2/registration.php'
  And I enter 'user1@example.com' into the 'email' field
  And I enter 'My Name' into the 'name' field
  And I enter 'ONLYUPPERCASE' into the 'password' field
  And I press "Submit"
  Then I should be on 'assignment2/registration.php'
  And I should see "Your password is not complex enough."

Scenario: User password has only special characters
  Given I visit 'assignment2/registration.php'
  And I enter 'user1@example.com' into the 'email' field
  And I enter 'My Name' into the 'name' field
  And I enter '!@#$' into the 'password' field
  And I press "Submit"
  Then I should be on 'assignment2/registration.php'
  And I should see "Your password is not complex enough."

Scenario: User password is good
  Given I visit 'assignment2/registration.php'
  And I enter 'user1@example.com' into the 'email' field
  And I enter 'My Name' into the 'name' field
  And I enter 'aA1!' into the 'password' field
  And I press "Submit"
  Then I should be on 'assignment2/login.php'

Scenario: User registers and logs in
  Given I visit 'assignment2/registration.php'
  And I enter 'user1@example.com' into the 'email' field
  And I enter 'My Name' into the 'name' field
  And I enter 'aA1!' into the 'password' field
  And I press "Submit"
  Then I should be on 'assignment2/login.php'
  When I enter 'user1@example.com' into the 'email' field
  And I enter 'aA1!' into the 'password' field
  And I press "Submit"
  Then I should be on 'assignment2/main.php'
  And I should see "Hello, My Name"
  
Scenario: Logged out user cannot access content page
  Given I am logged out
  When I visit 'assignment2/main.php'
  Then I should be on 'assignment2/login.php'
  