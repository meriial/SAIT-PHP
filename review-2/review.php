<?php

include_once 'business/tweets.php';
include_once 'common/sessions.php';

login('cameron');

redirectIfNotLoggedIn();

if( formWasSubmitted() )
{
  $errors = getTweetFormErrors();
  if( empty($errors) )
  {
    saveTweet();
    redirectToTweetForm();
  }
}
else
{
  $errors = array();
}

displayTweetFormAndTweets($errors);
