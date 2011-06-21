<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/include.php,v $
 * $Revision: 1.1 $
 * $Date: 2011/06/21 13:18:09 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

require_once("iconnector.php");

/**
 * Basis-Klasse der API.
 * Hierueber kann eine Verbindung zum Payment-Server aufgebaut werden.
 */
class hibiscus
{
  /**
   * Baut eine Verbindung zum Payment-Server auf.
   * @param proto das zu verwendende Protokoll.
   * Derzeit wird nur "xmlrpc" unterstuetzt.
   * @param server Hostname des Hibiscus Payment-Servers
   * @param password das Masterpasswort des Hibiscus Payment-Servers.
   * @param port optionale Angabe des TCP-Ports. Per Default 8080.
   * @return Objekt vom Typ iconnector.
   */
  public static function connect($proto="xmlrpc",$server="localhost",$password="jameica",$port=8080)
  {
    require_once($proto."/"."connector.php");
    $class = "\\hibiscus\\".$proto."\\connector";
    return new $class($server,$password,$port);
  }
}

?>