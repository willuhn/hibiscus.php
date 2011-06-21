<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/iconnector.php,v $
 * $Revision: 1.1 $
 * $Date: 2011/06/21 13:18:09 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus;

require_once("konto.php");

/**
 * Interface des Connectors.
 * @author willuhn
 *
 */
interface iconnector
{
  /**
   * Liefert die Liste der verfuegbaren Konten auf dem Server.
   * @return Liste der gefundenen Konten als Objekte des Typs Konto.
   */
  public function getKonten();
  
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