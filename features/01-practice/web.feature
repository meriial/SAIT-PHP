Feature: Practice

Background: 
  Given my website is up and running
  
@start
Scenario: Web
  When I visit "practice/start.php"
  Then I should see "Hi There"