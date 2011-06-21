<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/konto.php,v $
 * $Revision: 1.2 $
 * $Date: 2011/06/21 15:23:51 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus;

/**
 * Bean mit den Konto-Eigenschaften.
 */
class konto
{
  /**
   * @var ID des Kontos in der Datenbank.
   */
  public $id               = null;
  
  /**
   * @var Bezeichnung des Kontos.
   */
  public $bezeichnung      = null;

  /**
   * @var BIC-Nummer (EU-BLZ)
   */
  public $bic              = null;
  
  /**
   * @var Bankleitzahl
   */
  public $blz              = null;
  
  /**
   * @var IBAN-Nummer (EU-Kontonummer)
   */
  public $iban             = null;
  
  /**
   * @var Optionaler Kommentar (Freitext)
   */
  public $kommentar        = null;
  
  /**
   * @var Kontonummer
   */
  public $kontonummer      = null;
  
  /**
   * @var Kundennummer
   */
  public $kundennummer     = null;
  
  /**
   * @var Name des Konto-Inhabers
   */
  public $name             = null;
  
  /**
   * @var Aktueller Saldo des Kontos im Format "0,00" (deutsche Schreibweise)
   */
  public $saldo            = null;
  
  /**
   * @var Verfügbarer Saldo (incl. Dispo) im Format "0,00" oder "",
   *      falls die Bank das nicht unterstützt
   */
  public $saldo_available  = null;
  
  /**
   * @var Datum des Saldos im Format dd.mm.yyyy
   */
  public $saldo_datum      = null;
  
  /**
   * @var Unterkontonummer (i.d.R. leer)
   */
  public $unterkonto       = null;
  
  /**
   * @var Währungsbezeichnung
   */
  public $waehrung         = null;
}

?>