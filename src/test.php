<?php

  include("hibiscus/include.php");

  try
  {
    $TEST_BLZ   = "10010010";
    $TEST_KONTO = null;
    
    $conn = hibiscus::connect("xmlrpc","localhost","test");

    ////////////////////////////////////////////////////////////////////////////
    //
    print("\nTest 1: Liste der Konten\n");
    $konten = $conn->getKonten();
    foreach ($konten as $konto)
    {
      print($konto->id.": ".$konto->bezeichnung."\n");
      $TEST_KONTO = $konto->id;
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

        ////////////////////////////////////////////////////////////////////////////
    //
    print("\nTest 5: Ueberweisung anlegen\n");
    
    $ueberweisung = new hibiscus\auftrag();
    $ueberweisung->konto       = $TEST_KONTO;
    $ueberweisung->betrag      = "10,99";
    $ueberweisung->blz         = "12345678";
    $ueberweisung->kontonummer = "123456790";
    $ueberweisung->name        = "Max Mustermann";
    $ueberweisung->addVerwendungszweck("Zeile 1");
    $ueberweisung->addVerwendungszweck("Zeile 2");
        
    $conn->createUeberweisung($ueberweisung);
    print("ID: ".$ueberweisung->id);
    //
    ////////////////////////////////////////////////////////////////////////////
    
    print("\n\n");
    
  }
  catch (Exception $e)
  {
    print("\n\nFehler: ".$e->getMessage()."\n");
  }
?>
