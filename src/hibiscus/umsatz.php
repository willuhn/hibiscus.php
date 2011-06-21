<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/umsatz.php,v $
 * $Revision: 1.1 $
 * $Date: 2011/06/21 15:23:51 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus;

/**
 * Bean mit die Eigenschaften einer Umsatzbuchung.
 */
class umsatz
{
  /**
   * @var ID des Umsatzes in der Datenbank.
   */
  public $id               = null;
  
  /**
   * @var ID des zugeordneten Kontos.
   */
  public $konto_id         = null;
  
  /**
   * @var Inhaber-Name des Gegenkontos
   */
  public $empfaenger_name  = null;

  /**
   * @var Kontonummer des Gegenkontos
   */
  public $empfaenger_konto = null;
  
  /**
   * @var Bankleitzahl des Gegenkontos
   */
  public $empfaenger_blz   = null;
  
  /**
   * @var Buchungsart
   */
  public $art              = null;
  
  /**
   * @var Betrag im Format "0,00"
   */
  public $betrag           = null;
  
  /**
   * @var Valuta-Datum im Format dd.mm.yyyy
   */
  public $valuta           = null;
  
  /**
   * @var Buchungsdatum im Format dd.mm.yyyy
   */
  public $datum            = null;
  
  /**
   * @var Verwendungszweck, alle Zeilen in einem String
   */
  public $zweck            = null;
  
  /**
   * @var Saldo des Kontos zu diesem Zeitpunkt im Format "0,00"
   */
  public $saldo            = null;
  
  /**
   * @var Primanota-Kennzeichen
   */
  public $primanota        = null;
  
  /**
   * @var Kundenreferenz
   */
  public $customer_ref     = null;
  
  /**
   * @var Name der Umsatzkategorie (falls zugeordnet)
   */
  public $umsatz_typ       = null;
  
  /**
   * @var Kommentar (Freitext)
   */
  public $kommentar        = null;
   
}

?>