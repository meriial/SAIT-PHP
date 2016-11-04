Feature: Forms

Background: 
  Given your bootstrap file is readable
  And my assignment website is up and running
  
@assignment1
Scenario: Registration page
  Given I visit 'assignment/forms/registration.php'
  Then I should see 3 'input' elements on the page
  
@assignment1
Scenario: Login page
  Given I visit 'assignment/forms/login.php'
  Then I should see 2 'input' elements on the page
  
@assignment1
Scenario: Failing login with incorrect password should re-populate the form
  Given I visit 'assignment/forms/login.php'
  When I enter 'correct@email.com' into the 'email' field
  And I enter 'theincorrectpassword' into the 'password' field
  And I press "Submit"
  Then I should still be on 'assignment/forms/login.php'
  And I should see 'correct@email.com' in the 'email' field
  And I should see "ERROR! Incorrect password."
  
@assignment1
Scenario: Failing login with incorrect email should re-populate the form
  Given I visit 'assignment/forms/login.php'
  When I enter 'incorrect@email.com' into the 'email' field
  And I enter 'correct-password' into the 'password' field
  And I press "Submit"
  Then I should still be on 'assignment/forms/login.php'
  And I should see 'incorrect@email.com' in the 'email' field
  And I should see "ERROR! Incorrect email."
  
@assignment1
Scenario: Successful login should redirect me to the main page
  Given I visit 'assignment/forms/login.php'
  When I enter 'correct@email.com' into the 'email' field
  And I enter 'correct-password' into the 'password' field
  And I press "Submit"
  Then I should be on 'assignment/forms/main.php'
  And I should not see "ERROR! Incorrect password."
  
@assignment1
Scenario: Completing the main page should redirect to a success page with information
  Given I visit 'assignment/forms/main.php'
  When I enter 'a unique message' into the 'item' field
  And I press "Submit"
  Then I should be on 'assignment/forms/success.php'
  And I should see "a unique message"