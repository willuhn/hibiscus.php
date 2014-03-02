<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/iconnector.php,v $
 * $Revision: 1.4 $
 * $Date: 2011/06/21 17:58:40 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus;

require_once("konto.php");
require_once("umsatz.php");
require_once("auftrag.php");

/**
 * Interface des Connectors.
 *
 */
interface iconnector
{
  /**
   * Liefert die Liste der verfuegbaren Konten.
   * @return Liste der gefundenen Konten als Objekte des Typs "konto".
   */
  public function getKonten();
  
  /**
   * Liefert eine Liste der gefundenen Umsaetze
   * @param query assoziatives Array mit Suchkriterien.
   * Das Array kann folgende Schluessel enthalten:
   * 
   *   - konto_id           ID des Kontos, dem der Umsatz zugeordnet ist
   *   - art                Buchungsart
   *   - empfaenger_name    Inhaber-Name des Gegenkontos
   *   - empfaenger_konto   Kontonummer des Gegenkontos
   *   - empfaenger_blz     Bankleitzahl des Gegenkontos
   *   - id                 ID des Umsatzes
   *   - id:min             niedrigste zulässige ID des Umsatzes
   *   - id:max             höchste zulässige ID des Umsatzes
   *   - saldo              Saldo des Kontos bei diesem Umsatz
   *   - saldo:min          niedrigster zulässiger Saldo des Kontos bei diesem Umsatz
   *   - saldo:max          höchster zulässiger Saldo des Kontos bei diesem Umsatz
   *   - valuta             Valuta-Datum im Format "dd.mm.yyyy" oder "yyyy-mm-dd"
   *   - valuta:min         niedrigstes Valuta-Datum im Format "dd.mm.yyyy" oder "yyyy-mm-dd"
   *   - valuta:max         höchstes Valuta-Datum im Format "dd.mm.yyyy" oder "yyyy-mm-dd"
   *   - datum              Buchungsdatum im Format "dd.mm.yyyy" oder "yyyy-mm-dd"
   *   - datum:min          niedrigstes Buchungsdatum im Format "dd.mm.yyyy" oder "yyyy-mm-dd"
   *   - datum:max          höchstes Buchungsdatum im Format "dd.mm.yyyy" oder "yyyy-mm-dd"
   *   - betrag             Betrag des Umsatzes
   *   - betrag:min         niedrigster zulässiger Betrag des Umsatz
   *   - betrag:max         höchster zulässiger Betrag des Umsatzes
   *   - primanota          Primanota-Kennzeichen
   *   - customer_ref       Kunden-Referenz
   *   - umsatz_typ         Name oder ID der Umsatz-Kategorie
   *   - zweck              Verwendungszweck
   *
   * @param Liste der gefundenen Umsaetze als Objekte des Typs "umsatz".
   */
  public function getUmsaetze($query = array());
  
  ///////////////////////////
  // TODO Factory zum Erzeugen von Beans
  // Dann haben die naemlich den korrekten Typ - also z.Bsp. den von xmlrpc
  // Dann geht auch das Ueberschreiben der Setter und Getter in createParams und createBean
  ///////////////////////////
  
  /**
   * Erzeugt eine neue Ueberweisung.
   * @param $auftrag der zu erstellende Auftrag.
   *        Objekt vom Typ "auftrag".
   * Die Funktion wirft eine Exception, wenn das Anlegen fehlschlug.
   */
  public function createUeberweisung(\hibiscus\auftrag $auftrag);
  
  /**
   * Erzeugt eine neue Auftrag.
   * 
   * @param $typ Art des Auftrages.
   * @param $auftrag der zu erstellende Auftrag.
   *        Objekt vom Typ "auftrag".
   * Die Funktion wirft eine Exception, wenn das Anlegen fehlschlug.
   */
  public function createAuftrag($typ,\hibiscus\auftrag $auftrag);
  
  
  

  /**
   * Erzeugt eine neuen Sammelauftrag.
   * 
   *
   * @param $typ Art des Auftrages.
   * @param $auftragname Name des Auftrages
   * @param $sammelauftrag Array mit Auftraegen vom Typ "auftrag".
   * 	aus dem ersten Auftrag werden die Daten:   konto,    sequencetype,    sepatype,    targetdate,    termin
   *  für den Sammelauftrag verwendet.
   * @return Id des Auftrages im Erfolgsfall 
   *        
   * Die Funktion wirft eine Exception, wenn das Anlegen fehlschlug.
   */
  public function createSammelAuftrag($typ, $auftragname, $sammelauftrag);
  
   
  /**
   * Fuehrt eine Pruefsummenberechnung fuer die Bankverbindung durch.
   * @param $blz die BLZ.
   * @param $kontonummer die Kontonummer.
   * @return true, wenn die Bankverbindung korrekt ist, falls wenn sie ungueltig ist.
   */
  public function checkCRC($blz,$kontonummer);
  
  /**
   * Liefert den Namen des Geldinstitutes fuer die BLZ.
   * @param $blz die BLZ.
   * @return Name des Geldinstitutes.
   */
  public function getBankname($blz);
  
  /**
  * Liefert eine Liste von Auftraegen.
  * @param text optionaler Suchbegriff. Gesucht wird in
  *  - allen Verwendungszweck-Zeilen
  *  - Name des Gegenkonto-Inhabers
  *  - Nummer des Gegenkontos
  * @param von optionale Angabe des Start-Datums.
  * @param bis optionale Angabe des End-Datums.
  * @return Liste der gefundenen Auftraege.
  * @throws RemoteException
  */
  public function find($typ,$text=null,$von=null,$bis=null);
  
  /**
   * Loescht den Auftrag mit der angegebenen ID.
   * @param id die ID des Auftrages.
   * @return siehe {@link BaseUeberweisungService#create(Map)}
   * @throws RemoteException
   */
  public function delete($typ,$id);
  
}

?>