Feature: Arrays

Background:
  Given your bootstrap file is readable
  And I load the file REPOSITORY_ROOT."practice/arrays.php"

Scenario: Basic array
  Given the function 'arrayDoubler' exists
  When I call arrayDoubler() and give it an array of numbers
  Then it should return an array of double those numbers
 
  
