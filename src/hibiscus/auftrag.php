<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/auftrag.php,v $
 * $Revision: 1.1 $
 * $Date: 2011/06/21 17:42:51 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus;

/**
 * Bean fuer einen Einzel-Auftrag.
 */
class auftrag
{
  /**
   * @var ID des Kontos in der Datenbank.
   */
  public $id               = null;
  
  /**
   * @var ID des zugeordneten Kontos.
   */
  public $konto            = null;

  /**
   * @var Bankleitzahl des Gegenkontos
   */
  public $blz              = null;
  
  /**
   * @var Kontonummer des Gegenkontos
   */
  public $kontonummer      = null;
  
  /**
   * @var Inhaber-Name des Gegenkontos
   */
  public $name             = null;
  
  /**
   * @var Betrag des Auftrages im Format "0,00"
   */
  public $betrag           = null;

  /**
   * @var Verwendungszweck (Array)
   * Verwenden Sie bitte die Funktion "addZweck($line)", um weitere
   * Zeilen Verwendungszweck hinzuzufuegen.
   */
  public $verwendungszweck = array();
  
  /**
   * @var Text-Schlüssel (Auftragsart)
   * 
   * Mögliche Werte:
   *   - 04    Lastschrift - Abbuchungsverfahren
   *   - 05    Lastschrift - Einzugsermächtigung
   *   - 51    Überweisung (muss nicht explizit angegeben werden)
   *   - 53    Überweisung - Lohn/Gehalt/Rente
   *   - 54    Überweisung - Vermögenswirksame Leistungen
   *   - 59    Überweisung Rücküberweisung
   */
  public $textschluessel 	 = null;

  /**
   * @var Auftragsstatus (true/false)
   */
  public $ausgefuehrt      = null;
  
  /**
   * Fuegt eine Zeile Verwendungszweck hinzu.
   * @param line die zusaetzliche Zeile Verwendungszweck.
   */
  public function addVerwendungszweck($line)
  {
    array_push($this->verwendungszweck,$line);
  }
  
  /**
   * Die optionale End2End-ID fuer SEPA.
   */
   public $endtoendid= null;
   
   /**
    * Die Mandats-ID.
    */
   public $mandateid= null;
   
   /**
    * Die Glaeubiger-ID.
    */
   public $creditorid= null;
   
   /**
    * Das Datum der Unterschrift des Mandats.
    */
   public $sigdate= null;
   

   /**
    * Sequenz-Typ: 
    * FRST fuer Erst-Einzug.
    * RCUR fuer Folge-Einzug.
    * OOFF fuer Einmal-Einzug.
    * FNAL fuer letztmaligen Einzug.
    */
   public $sequencetype= null;

   /**
    * Basis-Lastschrift
    *   CORE("LastSEPA","Basis-Lastschrift"),
    * Basis-Lastschrift mit verkuerztem Vorlauf.
    *   COR1("LastCOR1SEPA","Basis-Lastschrift (kurzer Vorlauf)"),     
    * B2B-Lastschrift
    *   B2B("LastB2BSEPA","B2B-Lastschrift")
    */
   public $sepatype= null;

   
   /**
    * Das Ziel-Ausfuehrungsdatum bei der Bank.
    */
   public $targetdate= null;
   
   
   public $termin=null;
   
   /**
    * 
    * @var $buchungen enthält die einzelBuchungen bei Sammelaufträgen
    */
   public $buchungen=null;
  

}

?>