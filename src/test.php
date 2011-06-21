<?php

  include("hibiscus/include.php");

  $conn = hibiscus::connect("xmlrpc","localhost","test");
  $konten = $conn->getKonten();
  
  foreach ($konten as $konto)
  {
    print_r($konto);
  }
  
  print($conn->getBankname("86050200")."\n");
  print($conn->checkCRC("86050200","1210322521")."\n");
?>
