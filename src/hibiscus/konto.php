<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/konto.php,v $
 * $Revision: 1.1 $
 * $Date: 2011/06/21 13:18:09 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus;

/**
 * Bean mit den Konto-Eigenschaften.
 * @author willuhn
 */
class konto
{
  public $id               = null;
  public $bezeichnung      = null;
  public $bic              = null;
  public $blz              = null;
  public $iban             = null;
  public $kommentar        = null;
  public $kontonummer      = null;
  public $kundennummer     = null;
  public $name             = null;
  public $saldo            = null;
  public $saldo_available  = null;
  public $saldo_datum      = null;
  public $unterkonto       = null;
  public $waehrung         = null;
}

?>