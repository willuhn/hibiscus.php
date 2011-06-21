<?php

/**********************************************************************
 * $Source: /cvsroot/hibiscus/hibiscus.php/src/hibiscus/xmlrpc/connector.php,v $
 * $Revision: 1.2 $
 * $Date: 2011/06/21 15:23:51 $
 *
 * Copyright (c) by willuhn - software & services
 * All rights reserved
 *
 **********************************************************************/

namespace hibiscus\xmlrpc;

require_once("lib/xmlrpc.inc");
require_once("lib/xmlrpc_wrappers.inc");
require_once("konto_xmlrpc.php");
require_once("umsatz_xmlrpc.php");

/**
 * Implementierung des Connectors via XML-RPC.
 */
class connector implements \hibiscus\iconnector
{
  /**
   * Legt fest, ob Debug-Ausgaben erfolgen sollen.
   * Moegliche Werte:
   *  0 = keine Debug-Ausgaben
   *  1 = Debug-Ausgaben, Level 1
   *  2 = Debug-Ausgaben, Level 2
   */
  public static $DEBUG = 0;
  
  /**
   * Legt fest, ob das SSL-Zertifikate des Payment-Servers
   * geprueft werden soll. Wenn "1" angegeben ist, müssen Sie vorher das
   * SSL-Zertifikat des Payment-Servers exportieren in Curl (Curl wird von PHP intern für
   * HTTP-Kommunikation verwendet) importieren.
   *
   * Oeffnen Sie hierzu das Webfrontend des Payment-Servers ueber https://<server>:8080/webadmin
   * und loggen Sie sich mit Ihrem Master-Passwort ein. Je nach verwendetem Browser geschieht
   * der Export des SSL-Zertifikates unterschiedlich.
   *
   * Beispiel Firefox:
   *  Wenn Sie das Webfrontend noch nie im Browser geoeffnet haben, wird ein Warnhinweis
   *  angezeigt. Klicken Sie auf
   *  "Ich kenne das Risiko->Ausnahmen hinzufuegen...->Sicherheits-Ausnahmeregel bestätigen".
   *
   *  Geben Sie als Username "admin" und als Passwort Ihr Master-Passwort ein.
   *  Waehlen Sie im Menu "Extras->Seiteninformationen->Sicherheit->Zertifikat anzeigen->Details".
   *  Klicken Sie auf "Exportieren...", um das Zertifikat zu speichern.
   *  
   * Konvertieren Sie das Zertifikat in das Textformat:
   * "openssl x509 -inform PEM -in <datei> -out out.pem -text"
   *
   * Fuegen Sie den Inhalt der Datei out.pem anschliessend zu folgender Datei hinzu:
   * "/usr/share/curl/curl-ca-bundle.crt"
   *
   * Verwenden Sie alternativ "0", wenn das Zertifikat nicht geprüft werden soll.
   */
  public static $SSL_VERIFY  = 0;

  private $client            = null;

  /**
   * Konstruktor
   * @param server Hostname des Hibiscus Payment-Servers
   * @param password das Masterpasswort des Hibiscus Payment-Servers.
   * @param port optionale Angabe des TCP-Ports. Per Default 8080.
   */
  public function __construct($server="localhost",$password="jameica",$port=8080)
  {
    $this->client = new \xmlrpc_client("https://admin:".$password."@".$server.":".$port."/xmlrpc/");
    $this->client->setDebug(\hibiscus\xmlrpc\connector::$DEBUG);
    $this->client->setSSLVerifyHost(\hibiscus\xmlrpc\connector::$SSL_VERIFY);
    $this->client->setSSLVerifyPeer(\hibiscus\xmlrpc\connector::$SSL_VERIFY);
  }

  /**
   * @see hibiscus.iconnector::getKonten()
   */
  public function getKonten()
  {
    $value = $this->send("hibiscus.xmlrpc.konto.find");

    $result = array();
    for ($i=0;$i<$value->arraySize();$i++)
    {
      $bean = new konto_xmlrpc($value->arrayMem($i));
      array_push($result,$bean);
    }
    return $result;
  }

  /**
   * @see hibiscus.iconnector::getUmsaetze()
   */
  public function getUmsaetze($query = array())
  {
    $params = array();
    while (list($key,$value) = each($query))
    {
      $params[$key] = new \xmlrpcval($value,"string");
    }
    $value = $this->send("hibiscus.xmlrpc.umsatz.list",array(new \xmlrpcval($params,"struct")));

    $result = array();
    for ($i=0;$i<$value->arraySize();$i++)
    {
      $bean = new umsatz_xmlrpc($value->arrayMem($i));
      array_push($result,$bean);
    }
    return $result;
  }
  
  /**
   * @see hibiscus.iconnector::checkCRC()
   */
  public function checkCRC($blz,$kontonummer)
  {
    $value = $this->send("hibiscus.xmlrpc.konto.checkAccountCRC",array(new \xmlrpcval($blz,"string"),new \xmlrpcval($kontonummer,"string")));
    return $value->scalarVal();
  }
    
  /**
   * @see hibiscus.iconnector::getBankname()
   */
  public function getBankname($blz)
  {
    $value = $this->send("hibiscus.xmlrpc.konto.getBankname",array(new \xmlrpcval($blz,"string")));
    return $value->scalarVal();
  }
  
  /**
   * Fuehrt den XML-RPC-Aufruf aus.
   * @param $method Name der XML-RPC-Funktion.
   * @param $params optionale Angabe der Parameter.
   */
  private function send($method,$params=array())
  {
    $msg = new \xmlrpcmsg($method,$params);
    $response = $this->client->send($msg);
    if ($response->faultCode())
      throw new \Exception($response->faultString());
    
    return $response->value();
  }
}

?>