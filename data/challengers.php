<?php 
  require_once "../includes/settings.php";
  require_once "../includes/functions.php";

  $callChallengers = json_decode(apiCall("https://la1".$epChallengers, "GET", null));
  
  $profiles = $callChallengers->{"entries"};

  usort($profiles,function($first,$second){
    return $first->leaguePoints < $second->leaguePoints;
  });

  unlink("../json/challengers.json");
  
  handleWriteFile(json_encode($profiles), "../json/challengers.json");