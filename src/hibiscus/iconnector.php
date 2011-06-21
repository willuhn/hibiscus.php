<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/iconnector.php,v $
 * $Revision: 1.2 $
 * $Date: 2011/06/21 15:23:51 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus;

require_once("konto.php");
require_once("umsatz.php");

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
}

?>