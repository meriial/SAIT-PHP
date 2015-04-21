<?php

include 'functions/validation.php';

function getRegistrationFormErrors()
{
  $errors = array();

  if( fieldWasEmpty('username') )
  {
    $errors[] = 'You must enter a username.';
  }

  if( fieldWasEmpty('email') )
  {
    $errors[] = 'You must enter an email.'
  }
  elseif( !emailWasValid() )
  {
    $errors[] = 'Email must be a valid email.'
  }

  return $errors;
}

function registerUser()
{

}
