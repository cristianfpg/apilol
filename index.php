<?php
  $matches = json_decode(file_get_contents("json/matchlist.json"));
  foreach($matches as $match){
    echo count($match);
    echo "<br>";
  }