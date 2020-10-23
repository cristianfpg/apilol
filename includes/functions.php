<?php
  function apiCall($ep,$request,$payload){
    $curl = curl_init($ep);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($payload)));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $request);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
  
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response;
  }

  function handleWriteFile($msg,$filename){
    $file = fopen($filename, "a+");
    fwrite($file, $msg);
    fclose($file);
  }