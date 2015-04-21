<?php

function emailWasValid($email)
{
  return preg_match('/[a-zA-Z0-9]+@[a-zA-Z0-9]+\.\w/');

  return filter_var( $email, FILTER_VALIDATE_EMAIL );
}

function fieldWasEmpty($fieldName)
{
  return empty($_POST[$fieldName]);
}

function fieldWasTooLong($fieldName, $maxLength)
{
  return strlen($_POST[$fieldName]) > $maxLength;
}

function formWasSubmitted()
{
  return isset($_POST['submit']);
}

function formatErrors($errors)
{
  return join(',', $errors);
}

function repopulate($fieldName)
{
  if( isset($_POST[$fieldName]) )
  {
    return $_POST[$fieldName];
  }
  else
  {
    return '';
  }
}
