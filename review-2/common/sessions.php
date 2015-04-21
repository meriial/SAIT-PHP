<?php

function startSession()
{
  if( !isset($_SESSION) )
  {
    session_start();
  }
}

function getLoggedInUsername()
{
  startSession();
  return $_SESSION['username'];
}

function redirectIfNotLoggedIn()
{
  startSession();
  if( !isset( $_SESSION['username'] ) )
  {
    header('Location: login.php');
  }
}

function login($username)
{
  startSession();
  $_SESSION['username'] = $username;
}

function logout()
{
  startSession();
  setcookie(session_name(), '', time()-3000, '/');
  session_destroy();
  header('Location: login.php');
}
