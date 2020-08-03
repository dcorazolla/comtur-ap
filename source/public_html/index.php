<?php
/**
* Publicare - O CMS Público Brasileiro
* @description index.php Inicia aplicação
* @copyright GPL © 2007
* @package /
*
* Presidência da República - www.presidencia.gov.br
*
* Este arquivo é parte do programa Publicare
* Publicare é um software livre; você pode redistribuí-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU 
* como publicada pela Fundação do Software Livre (FSF); na versão 3 da Licença, ou (na sua opinião) qualquer versão.
* Este programa é distribuído na esperança de que possa ser  útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita 
* de ADEQUAÇÃO a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU para maiores detalhes.
* Você deve ter recebido uma cópia da Licença Pública Geral GNU junto com este programa, se não, veja <http://www.gnu.org/licenses/>.
*/
global $_page, $PBLCONFIG;

error_reporting(E_ALL);
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors', 0);
ini_set('display_errors', 1);

// Forca correcao de path para local do index.php
$_SERVER['DOCUMENT_ROOT'] = __DIR__;
//chdir(dirname(__DIR__));

// Define configuracoes de BANCO DE DADOS e PHP.INI
require("../cfg/global.php");


//$PBLCONFIG["portal"]["url"] = (isset($_SERVER["HTTPS"])?"https://":"http://")."/".$_SERVER["SERVER_NAME"]."/".$PBLCONFIG["portal"]["pasta"];

// Faz inclusoes do publicare e instancia objetos
require("iniciar.php");


//xd(new DateTime());

// inicia portal
$_page->Executar($action);
