<?php

  include("hibiscus/include.php");

  try
  {
    $TEST_BLZ   = "10010010";
    $TEST_KONTO = null;
    
    $TEST_IBAN   = "DE000000000000";
    $TEST_NAME   = "Max Mustermann";
    $TEST_CREDITOR ="DE48ZZZ00000000000"
    
    $conn = hibiscus::connect("xmlrpc","localhost","test");

    ////////////////////////////////////////////////////////////////////////////
    //
    print("<pre>");
    print("\nTest 1: Liste der Konten\n");
    $konten = $conn->getKonten();
    foreach ($konten as $konto)
    {
      print($konto->id.": ".$konto->bezeichnung."\n");
      $TEST_KONTO = $konto->id;
    }
    print("\nTest 1: Liste der Konten\n");
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
    
    
    
    print("\nTest 6: SepaSammellastschrift zusammenstellen\n");
    
    $sepalastschrift = new hibiscus\auftrag();
    $sepalastschrift->konto       = $TEST_KONTO;
    $sepalastschrift->sequencetype= "FRST";
    $sepalastschrift->sepatype= "CORE";
    $sepalastschrift->targetdate= "03.03.2014";
    $sepalastschrift->termin= "03.03.2014";
    $sepalastschrift->kontonummer = $TEST_IBAN;
    $sepalastschrift->name        = $TEST_NAME;
    $sepalastschrift->blz         = "COBADEFFXXX";
    $sepalastschrift->betrag      = "1,00";
    $sepalastschrift->addVerwendungszweck("Testlastschrift");
    $sepalastschrift->endtoendid= "WUF-2";
    $sepalastschrift->creditorid= $TEST_CREDITOR ;
    $sepalastschrift->mandateid   = "lastschrifttest1";
    $sepalastschrift->sigdate= "08.02.2014";
    
    $sepalastschrift2 = new hibiscus\auftrag();
    $sepalastschrift2->kontonummer = $TEST_IBAN;
    $sepalastschrift2->name        = $TEST_NAME;
    $sepalastschrift2->blz         = "COBADEFFXXX";
    $sepalastschrift2->betrag      = "1,00";
    $sepalastschrift2->addVerwendungszweck("Testlastschrift");
    $sepalastschrift2->endtoendid= "WUF-1";
    $sepalastschrift2->creditorid= $TEST_CREDITOR ;
    $sepalastschrift2->mandateid   = "lastschrifttest1";
    $sepalastschrift2->sigdate= "08.02.2014";

    
    


    $auftraege[]=$sepalastschrift;
    $auftraege[]=$sepalastschrift2;
    
    print("\nTest 6.1: SepaSammellastschrift anlegen\n");  

    $auftragsid=$conn->createSammelAuftrag("sepasammellastschrift", "Sammellastschrift1",   $auftraege);
     
    print("sepalastschrift ID: ".$auftragsid);
    //
    ////////////////////////////////////////////////////////////////////////////
    
    print("\n\n");
    print("\n\n");
    print("\n\n");
    
    
    $auftraege=$conn->find("sepasammellastschrift");
    
    foreach ($auftraege as $auftrag)
    {
    	print_r($auftrag);
    	print("\n\n");
    	//print_r($conn->delete("sepasammellastschrift",$auftrag->id));
    	print("\n\n");
    	print("\n\n");
    }
    
  }
  catch (Exception $e)
  {
    print("\n\nFehler: ".$e->getMessage()."\n");
  }
?>
