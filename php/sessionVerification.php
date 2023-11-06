<?php

function exitWhenNotLoggedIn()
{ 
  if (!isset($_SESSION['loggedIn'])) {
    header("location: ./index.php");
    exit();  
  }
}