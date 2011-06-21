<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/xmlrpc/konto_xmlrpc.php,v $
 * $Revision: 1.1 $
 * $Date: 2011/06/21 13:18:09 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus\xmlrpc;

/**
 * XML-RPC-Implementierung der Konto-Bean.
 */
class konto_xmlrpc extends \hibiscus\konto
{
  /**
   * Konstruktor.
   * @param xmlrpc die XMLRPC-Roh-Daten.
   */
  public function __construct($xmlrpc)
  {
    while (list($key, $v) = $xmlrpc->structEach())
    {
      $this->{$key} = $v->scalarVal();
    }
  }
}

?>