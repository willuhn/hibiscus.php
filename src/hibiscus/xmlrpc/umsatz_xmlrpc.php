<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/xmlrpc/umsatz_xmlrpc.php,v $
 * $Revision: 1.1 $
 * $Date: 2011/06/21 15:23:51 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus\xmlrpc;

/**
 * XML-RPC-Implementierung eines Umsatzes.
 */
class umsatz_xmlrpc extends \hibiscus\umsatz
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