Feature: Authentication
  
Scenario: User logs in
  Given I visit 'practice/auth/login.php'
  And I enter 'user1@example.com' into the 'email' field
  And I enter '1234' into the 'password' field
  And I press "Submit"
  Then I should be on 'practice/auth/main.php'
  And I should see "Hello, user1@example.com"
  When I visit 'practice/auth/main2.php'
  Then I should see "Hello, user1@example.com"
  
Scenario: Logged out user cannot access content page
  Given I am logged out
  When I visit 'practice/auth/main.php'
  Then I should be on 'practice/auth/login.php'
  