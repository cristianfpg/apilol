<?php
  require_once "../includes/settings.php";
  require_once "../includes/functions.php";

  $ids = json_decode(file_get_contents("../json/summoners.json"));
  $ind = 0;

  if(isset($_GET["uno"])){
    unlink("../json/matchlist.json");
    handleWriteFile("[", "../json/matchlist.json");
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
    $accountId = $ids[$i + $ind]->{"accountId"};
    $callMatchlist = json_decode(apiCall("https://la1".$epMatchlist."$accountId?queue=420&endIndex=10&api_key=".$apiKey, "GET", null));
    handleWriteFile(json_encode($callMatchlist->{"matches"}), "../json/matchlist.json");
    if(($i + $ind) != 199){
      handleWriteFile(",", "../json/matchlist.json");
    }
    usleep(1250000);
  }

  if(isset($_GET["cinco"])){
    handleWriteFile("]", "../json/matchlist.json");
  }

