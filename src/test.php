<?php

  include("hibiscus/include.php");

  try
  {
    $TEST_BLZ = "10010010";
    
    $conn = hibiscus::connect("xmlrpc","localhost","test");

    ////////////////////////////////////////////////////////////////////////////
    //
    print("\nTest 1: Liste der Konten\n");
    $konten = $conn->getKonten();
    foreach ($konten as $konto)
    {
      print($konto->id.": ".$konto->bezeichnung."\n");
    }
    //
    ////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////
    //
    print("\nTest 2: Name des Institites ermitteln\n");
    print("BLZ ".$TEST_BLZ.": ".$conn->getBankname($TEST_BLZ)."\n");
    //
    ////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////
    //
    print("\nTest 3: Bankverbindung checken\n");
    print("Konto 1234567890 gueltig: ".($conn->checkCRC($TEST_BLZ,"1234567890") ? "ja" : "nein")."\n");
    print("Konto 1234567891 gueltig: ".($conn->checkCRC($TEST_BLZ,"1234567898") ? "ja" : "nein")."\n");
    //
    ////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////
    //
    print("\nTest 4: Liste der Umsaetze\n");
    $umsaetze = $conn->getUmsaetze(array("datum:min"  => "01.01.2011",
                                         "betrag:min" => "1"));
    foreach ($umsaetze as $umsatz)
    {
      print($umsatz->datum.": ".$umsatz->betrag." - ".$umsatz->zweck."\n");
    }
    //
    ////////////////////////////////////////////////////////////////////////////
  }
  catch (Exception $e)
  {
    print($e->getMessage()."\n");
  }
?>
