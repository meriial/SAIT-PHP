<?php
/*
 * This file contains the tweet business logic
 * @author Cameron Falkenhagen
 * @date   2015-04-10
 */

require_once "common/sessions.php";
require_once "common/validation.php";

function getTweetFormErrors()
{
  $errors = array();

  if( fieldWasEmpty('tweet') )
  {
    $errors[] = 'You must enter a tweet.';
  }
  else if ( fieldWasTooLong('tweet', 140) )
  {
    $errors[] = 'You must tweet in less than 140 characters.';
  }

  return $errors;
}

function saveTweet()
{
  $username = getLoggedInUsername();
  $tweet    = $_POST['tweet'];

  $file = fopen('files/tweets.txt', 'a');
  fwrite( $file, $username.'|'.$tweet."\n" );
  fclose($file);
}

function getTweetsForUser($username)
{
  $tweets = array();
  if( file_exists('files/tweets.txt') )
  {
    $lines = file('files/tweets.txt');
    foreach( $lines as $line )
    {
      $tweet = explode('|',$line);
      if( $tweet[0] == $username )
      {
        $tweets[] = $tweet;
      }
    }
  }
  return $tweets;
}

function displayTweetFormAndTweets($errors)
{
  $username = getLoggedInUsername();
  $tweets = getTweetsForUser($username);
  include 'html/tweetForm.php';
}

function redirectToTweetForm()
{
  header('Location: review.php');
}
