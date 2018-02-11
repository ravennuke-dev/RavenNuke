<?php
/**
 * TegoNuke(tm): HTML Newsletter
 *
 * This module allows admins to create and send newsletters to their site users in
 * either plain text or full HTML.  It is a vastly improved Newsletter module over
 * the core module which came with the original PHP-Nuke CMS.  Has very flexible
 * templating system, with the ability to embed dynamic content at point of generation,
 * plus support for NSN Groups.
 *
 * On-going development of this module will be done on the RavenNuke(tm) CMS ONLY.
 * PHP-Nuke is a dead project.
 *
 * Original copyright statements are below these.
 *
 * PHP versions 5.2+ ONLY (PHP4 is "dead")
 *
 * LICENSE: GNU/GPL 2 (provided with the download of this script)
 *
 * @category    Module
 * @package     TegoNuke(tm)
 * @subpackage  Newsletter
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2006 - 2011 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.4.0_437
 * @link        http://montegoscripts.com
 */
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright (c) 2004 by NukeWorks                                      */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright (c) 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Function: Common Use Defines
************************************************************************/

define('_MSNL_COM_LAB_SQL', ' SQL');
define('_MSNL_COM_LAB_GOBACK', ' VOLTAR');
define('_MSNL_COM_LAB_ERRMSG', ' MSG DE ERRO');
define('_MSNL_COM_LAB_HELPLEGENDTXT', ' Coloque seu cursor em cima destes ícones para ver texto detalhado de ajuda ');

define('_MSNL_COM_LNK_GOBACK', ' Faça clique para voltar para página anterior');

define('_MSNL_COM_ERR_SQL', ' ENCONTRADO ERRO EM SQL');
define('_MSNL_COM_ERR_MODULE', ' ERRO EM MODULO');
define('_MSNL_COM_ERR_VALMSG', ' A VALIDAÇÃO DO CAMPO SEGUINTE FRACASSOU ');
define('_MSNL_COM_ERR_VALWARNMSG', ' O CAMPO SEGUINTE RECEBEU UMA ADVERTÊNCIAS');
define('_MSNL_COM_ERR_DBGETCFG', ' não Recebeu informação de configuração de módulo!');

define('_MSNL_COM_HLP_HELPLEGENDTXT', ' Sim, é como está divulgado! ');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Função: Uso comum define entre módulo e bloco
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

define('_MSNL_NLS_LAB_MORENLS', ' Mais Relatórios informativos... ');
define('_MSNL_NLS_LAB_HIT', ' clique');
define('_MSNL_NLS_LAB_HITS', ' cliques');
define('_MSNL_NLS_LAB_SENTON', ' enviado em');
define('_MSNL_NLS_LAB_SENDER', ' enviado por');

define('_MSNL_NLS_LNK_VIEWNL', ' visualizar relatório informativo - pode abrir nova janela');
define('_MSNL_NLS_LNK_VIEWNLARCHS', ' visualizar arquivos de relatório informativo');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Função: msnl_nls_list
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

define('_MSNL_NLS_LST_LAB_ARCHTITL', ' Arquivo de Relatórios informativos');
define('_MSNL_NLS_LST_LAB_ADMNLS', ' Administração de Newsletter');

define('_MSNL_NLS_LST_LNK_ADMNLS', ' Vá para administração de módulo');

define('_MSNL_NLS_LST_MSG_NONLS', ' Nenhum Relatório informativo para Visualizar');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Função: msnl_nls_view
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

define('_MSNL_NLS_VIEW_ERR_DBGETNL', ' não Recebeu informação sobre Relatório informativo');
define('_MSNL_NLS_VIEW_ERR_CANNOTFIND', ' não pode encontrar arquivo de Relatório informativo selecionado');
define('_MSNL_NLS_VIEW_ERR_NOTAUTH', ' Você não esta autorizado a ver este relatório informativo, ou este relatório informativo não existe! ');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Função: msnl_copyright_view
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

define('_MSNL_CPY_LAB_COPYTITLE', ' Módulo de &copy Direitos autorais; e Créditos');
define('_MSNL_CPY_LAB_MODULEFOR', ' para o módulo');
define('_MSNL_CPY_LAB_COPY', ' Informação de Direitos autorais');
define('_MSNL_CPY_LAB_CREDITS', ' Informação de Crédito');
define('_MSNL_CPY_LAB_MODNAME', ' Nome do Módulo');
define('_MSNL_CPY_LAB_MODVER', ' Versão do Módulo');
define('_MSNL_CPY_LAB_MODDESC', ' Descrição do Módulo');
define('_MSNL_CPY_LAB_LICENSE', ' Licença');
define('_MSNL_CPY_LAB_AUTHORNM', ' Nome do Autor');
define('_MSNL_CPY_LAB_AUTHOREMAIL', ' Email do Autor');
define('_MSNL_CPY_LAB_AUTHORWEB', ' Home Page do Autor');
define('_MSNL_CPY_LAB_MODDL', ' Módulo Download');
define('_MSNL_CPY_LAB_DOCS', '  Documentação de Apoio/Ajuda');
define('_MSNL_CPY_LAB_ORIGAUTHOR', ' Autor(s) Original ');
define('_MSNL_CPY_LAB_CURRENTAUTHOR', ' Autor(s) Atual ');
define('_MSNL_CPY_LAB_TRANSLATIONS', '  Autor(s) de Tradução');
define('_MSNL_CPY_LAB_OTHER', ' Obrigado Adicional');

define("_MSNL_CPY_LNK_VIEWCOPYRIGHT", "Visualizar direitos autorais e créditos ");
define("_MSNL_CPY_LNK_PHPNUKE", "Vá para website do PHP-Nuke - você deixará este site ");
define("_MSNL_CPY_LNK_AUTHORHOME", "Vá para o website do Autor - você deixará este site ");
define("_MSNL_CPY_LNK_DOWNLOAD", "Vá para Download do website - você deixará este site ");
define("_MSNL_CPY_LNK_DOCS", "Vá para Documentação do website - você deixará este site ");

