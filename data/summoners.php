<?php
  require_once "../includes/settings.php";
  require_once "../includes/functions.php";

  $profiles = json_decode(file_get_contents("../json/challengers.json"));
  $ind = 0;

  if(isset($_GET["uno"])){
    unlink("../json/summoners.json");
    handleWriteFile("[", "../json/summoners.json");
  }else if(isset($_GET["dos"])){
    $ind = 40;
  }else if(isset($_GET["tres"])){
    $ind = 80;
  }else if(isset($_GET["cuatro"])){
    $ind = 120;
  }else if(isset($_GET["cinco"])){
    $ind = 160;
  }else{
    die("Sin paginacion");
  }

  for($i = 0; $i < 40; $i++){
    $summonerID = $profiles[$i + $ind]->{"summonerId"};
    $callSummoner = json_decode(apiCall("https://la1".$epSummoner."$summonerID?api_key=".$apiKey, "GET", null));
    handleWriteFile(json_encode($callSummoner), "../json/summoners.json");
    if(($i + $ind) != 199){
      handleWriteFile(",", "../json/summoners.json");
    }
    usleep(1250000);
  }

  if(isset($_GET["cinco"])){
    handleWriteFile("]", "../json/summoners.json");
  }

