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

/*************************************************************************
* Todas as tentativas são criadas colocar define na Função e Seção
* na tela onde é usado como também na ordem de colocação em
* o esquerda-para-direito de leitura de tela e então topo-abaixo.  Em casos onde um
* defina é usado em telas de múltiplo, só pode ser definido uma vez, assim o
* primeiro Function/Section: terá o defina nisto.
************************************************************************/
/************************************************************************
* Function: Common Use Defines
************************************************************************/
define('_MSNL_COM_LAB_SQL', ' SQL');
define('_MSNL_COM_LAB_GOBACK', ' VOLTAR');
define('_MSNL_COM_LAB_ERRMSG', ' MSG DE ERRO');
define('_MSNL_COM_LAB_HELPLEGENDTXT', ' Coloque seu cursor em cima destes ícones para ver texto detalhado de ajuda ');
define('_MSNL_COM_LNK_GOBACK', ' Faça clique para voltar para página anterior');
define('_MSNL_COM_ERR_SQL', ' ENCONTROU ERRO EM SQL');
define('_MSNL_COM_ERR_MODULE', ' ERRO EM MODULE');
define('_MSNL_COM_ERR_VALMSG', ' VALIDAÇÃO DO CAMPO SEGUINTE FRACASSOU');
define('_MSNL_COM_ERR_VALWARNMSG', ' O CAMPO SEGUINTE TEVE ADVERTÊNCIAS');
define('_MSNL_COM_ERR_DBGETCFG', ' não Recebeu informação de configuração de módulo! ');
define('_MSNL_COM_HLP_HELPLEGENDTXT', 'Yes, that is how it is done!');

/************************************************************************
* Function: General Use Defines
************************************************************************/

define('_MSNL_COM_LAB_MODULENAME', 'HTML Newsletter');
define('_MSNL_LAB_ADMIN', 'Administração');

//Module Menu Labels and Link Titles

define('_MSNL_LAB_CREATENL', ' Criar Boletim Informativo ');
define('_MSNL_LAB_MAINCFG', ' Configuração Principal');
define('_MSNL_LAB_CATEGORYCFG', ' Configuração de categoria');
define('_MSNL_LAB_MAINTAINNLS', ' Manutenção de Newsletters');
define('_MSNL_LAB_SENDTESTED', ' Enviar Testados');
define('_MSNL_LAB_SITEADMIN', ' Administração do Site');
define('_MSNL_LAB_NLARCHIVES', ' Arquivos');
define('_MSNL_LAB_NLDOCS', ' Docmentação ON-LINE');

define('_MSNL_LNK_CREATENL', ' Criar um newsletter');
define('_MSNL_LNK_MAINCFG', ' Opções de Configuração de módulo');
define('_MSNL_LNK_CATEGORYCFG', ' Mantenha lista de categorias de relatório informativo');
define('_MSNL_LNK_MAINTAINNLS', ' Mantenha relatórios informativos existentes');
define('_MSNL_LNK_SENDTESTED', ' Enviar o último newsletter testado');
define('_MSNL_LNK_SITEADMIN', ' Vá para menu de administração global de site');
define('_MSNL_LNK_NLARCHIVES', ' Vá listar de arquivos de relatório informativo');
define('_MSNL_LNK_NLDOCS', ' Vá para HTML Relatório informativo documentation on-line');

define('_MSNL_ERR_NOTAUTHORIZED', ' Você não está autorizado a administrar este módulo');

//Common use Defines

define('_MSNL_COM_LAB_ACTIONS', ' Ações');
define('_MSNL_COM_LAB_ACTIVE', ' Ativo');
define('_MSNL_COM_LAB_ADD', ' ADICIONAR');
define('_MSNL_COM_LAB_ALL', ' TODOS');
define('_MSNL_COM_LAB_GO', ' AVANÇAR');
define('_MSNL_COM_LAB_INACTIVE', ' Inativo');
define('_MSNL_COM_LAB_LANG', ' Idioma');
define('_MSNL_COM_LAB_NO', ' Não');
define('_MSNL_COM_LAB_PREVIEW', ' Pré-visualizar');
define('_MSNL_COM_LAB_SAVE', ' SALVAR');
define('_MSNL_COM_LAB_SHOW_ALL', ' **Exibir Todos** ');
define('_MSNL_COM_LAB_SEND', ' Enviar');
define('_MSNL_COM_LAB_VERSION', ' Versão');
define('_MSNL_COM_LAB_YES', ' Sim');

define('_MSNL_COM_LNK_ADD', ' Faça clique para acrescentar o anterior data');
define('_MSNL_COM_LNK_CANCEL', ' Cancelar transação');
define('_MSNL_COM_LNK_CONTINUE', ' Continuar com transação');
define('_MSNL_COM_LNK_SAVE', ' Faça clique para salvar qualquer troca anterior data');
define('_MSNL_COM_LNK_SEND', ' Enviar newsletter');
define('_MSNL_COM_LNK_PREVIEW', ' Valide e Pré-veja newsletter');

define('_MSNL_COM_ERR_MSG', ' ERRO MSG');
define('_MSNL_COM_ERR_DBGETCATS', ' não Adquiriu categorias de relatório informativo');
define('_MSNL_COM_ERR_FILENOTEXIST', ' Arquivo não Eexist');
define('_MSNL_COM_ERR_FILENOTWRITEABLE', ' não Pôde escrever o arquivo de relatório informativo - Verifique se estão fixadas as permissões no diretório de arquivo igual a 777 ');
define('_MSNL_COM_ERR_DBGETPHPBB', ' Incapaz receber informação de configuração de phpBB');
define('_MSNL_COM_ERR_DBGETRECIPIENTS',	 ' Incapaz receber número de destinatários para: ');

define('_MSNL_COM_MSG_WARNING', ' Advertência! ');
define('_MSNL_COM_MSG_UPDSUCCESS', ' Atualizado com Sucesso! ');
define('_MSNL_COM_MSG_ADDSUCCESS', ' Adicionado com Sucesso! ');
define('_MSNL_COM_MSG_DELSUCCESS', ' Apagado com Sucesso! ');
define('_MSNL_COM_MSG_REQUIRED', ' campo Exigido deve ser dado um valor');
define('_MSNL_COM_MSG_POSNONZEROINT', ' Requer um valor inteiro positivo não-zero');
define('_MSNL_COM_HLP_ACTIONS', ' Coloque sobre o cursor em cima de cada ícone para ver que ação vai ser tomada se clicado.');
// For the visual copyright
define('_MSNL_CPY_LNK_VIEWCOPYRIGHT', 'View copyright and credits'); // Needs translation

/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/

//Section: Letter

define('_MSNL_ADM_LAB_LETTER', 	'Mensagem');
define('_MSNL_ADM_LAB_TOPIC',	'Tópico');
define('_MSNL_ADM_LAB_SENDER',	'Nome do Remetente');
define('_MSNL_ADM_LAB_NLSCAT',	'Categoria');
define('_MSNL_ADM_LAB_TEXTBODY','Texto da Notícia');
define('_MSNL_ADM_LAB_HTMLOK',	'(Tags HTML São permitidas)');

define('_MSNL_ADM_HLP_TOPIC', 'Este texto substitui a tag {EMAILTOPIC} no '
	. 'modelo escolhido.  Considerando que esta etiqueta normalmente está em uma linha com outras etiquetas, seria'
	. 'melhor manter isto curto e para o ponto - diga 40 caracteres ou menos.');

define('_MSNL_ADM_HLP_SENDER', 	'Este texto substitui a etiqueta {SENDER} no modelo escolhido '
. 'Considerando que esta etiqueta normalmente está em uma linha com outras etiquetas, seria '
. 'melhor manter isto curto e pessoal - diga-se, menos de 20 caracteres.');

define('_MSNL_ADM_HLP_NLSCAT', 	'Simplesmente escolha a categoria de relatório informativo para '
 . 'colocar este relatório informativo em.  Podem ser usadas categorias de relatório informativo '
 . ' para organizar relatórios informativos de site em áreas de tópico fundamentais específicas. '
 . ' Relatórios informativos podem ser listados abaixo da respectiva categorias deles que usam um'
 . ' interruptor de configuração abaixo da função de admin de Configuração Principal.');

define('_MSNL_ADM_HLP_TEXTBODY', 'Isto é onde o texto principal de seu relatório informativo '
	. ' irá. Faz sentido provavelmente para escrever seu conteúdo de HTML em outro lugar em um'
	. ' bom editor WYSIWYG até que você queira ser, e então cópiar-e-colar o HTML nesta área de texto. '
	. ' Este texto de HTML substituirá a etiqueta {TEXTBODY} no modelo escolhido. <br /> <br /> '
	. ' São permitidas etiquetas de HTML, mas seria sábio considerar  os leitores de e-mail de '
	. ' seus destinatário e navegadores destinados (para os arquivos) assegurar os melhores possíveis resultados para todos.  <br /> <br /> '
	. ' Para texto de relatório informativo longo, você pode desejar usar etiquetas de âncora para <span class="thick">marcar </span> '
	. ' certas seções.  Lhes dê nomes descritivos e então verifique o <span class="thick">Tabela de Include de '
	. ' Conteúdos </span> checkbox sob e estas âncoras se tornarão ligações dentro da Tabela de '
	. ' Conteúdos dentro de seu relatório informativo! <br /> <br /> exemplo de para a pessoa poder usar: '
	. ' <span class="thick">& lt;a name=\'Section One\'& gt;& lt;/a& gt;</span>. <span class="thick">NOTA:</span> deve ser EXATAMENTE como exibido '
	. ' com aspas E a etiqueta de âncora final! Este exemplo produziria uma ligação chamada '
	. ' <span class="thick">Section One </span> dentro do índice e ao clicar isto, tomaria '
	. ' o espectador para a âncora dentro do texto.');

//Section: Templates

define('_MSNL_ADM_LAB_TEMPLATES',	'Modelos');
define('_MSNL_ADM_LAB_CHOOSETMPLT',	'Escolha um Modelo');

define('_MSNL_ADM_LNK_SHOWTEMPLATE', 'Faça clique para exibir imagem de exemplos de modelo');

define('_MSNL_ADM_HLP_TEMPLATES',  ' A lista abaixo é derivada do atual '
	. ' fixe de diretórios de modelo debaixo de seu diretório modules/HTML_Newsletter/templates/. '
	. ' Se você elege para ir com <span class="thick">nenhum modelo</span>, o sistema simplesmente enviará a seus destinatários '
	. ' um e-mail com o texto que você inseriu acima dentro o Texto de <span class="thick">Boletim Informativo </span> na área de texto. <br /> <br /> '
	. ' Para Criar um relatório informativo de um modelo, selecione a pessoa da lista.  Veja um exemplos disso que '
	. ' seu relatório informativo como selecionado veja, clique no ícone <span class="thick">View </span> à direita do '
	. ' texto de nome de modelo. <br /> <br /> Você também pode criar seus próprios modelos e os colocque '
	. ' no diretório de modelos.  <span class="thick">Sugestão:</span> modelo externo de Fancy_Content como este é '
	. ' só um modelo de exemplos que o autor desta ferramenta estará atualizando continuamente com  um novo '
	. 'lançamento do módulo HTML Newsletter!');

//Section: Stats and Boletim Informativo Contents

define('_MSNL_ADM_LAB_STATS', 'Estatísticas e Conteúdos de Relatório informativo');
define('_MSNL_ADM_LAB_INCLSTATS', 'Inclue Estado do Site');
define('_MSNL_ADM_LAB_INCLTOC',	'Inclue Tabela de Conteúdos');

define('_MSNL_ADM_HLP_INCLSTATS', ' Conferindo esta opção incluirão em seu site  '
	. ' estatísticas fundamentais em modelos que têm a etiqueta {STATS} neles.  Veja o modelo de exemplo '
	. 'sobre para ter uma idéia que estatísticas serão exibidas. ');
define('_MSNL_ADM_HLP_INCLTOC',  ' Conferindo esta opção incluirão uma Tabela de '
	. ' Conteúdos \'bloco\' em modelos que têm a etiqueta {TOC} neles - por exemplo, veja exemplos de modelo '
	. ' para Fancy_Content.  O bloco de TOC terá ligações a cada dos blocos de <span class="thick">recente xxxxxx  </span> '
	. ' como também ligações para qualquer <span class="thick">ancora </span> incluida dentro da área de texto <span class="thick">Boletim Informativo Text</span>.');

//Section: Inclua mais Recentes Itens


define('_MSNL_ADM_LAB_INCLLATEST', ' Inclua mais Recentes Itens');
define('_MSNL_ADM_LAB_INCLLATESTDLS', ' mais Recente Baixa Itens');
define('_MSNL_ADM_LAB_INCLLATESTWLS', ' mais Recentes Itens de Web-ligação');
define('_MSNL_ADM_LAB_INCLLATESTFORS', ' mais Recentes Itens de Fóruns');
define('_MSNL_ADM_LAB_INCLLATESTNEWS', ' mais Recentes notícias');
define('_MSNL_ADM_LAB_INCLLATESTREVS', ' mais Recentes Itens de Revisão');

define('_MSNL_ADM_HLP_INCLLATESTNEWS', 	 ' Controla o número de mais recentes artigos para exibir dentro o '
	. ' relatório informativo. Os artigos estarão em ordem cronológica que começa com o mais recente '
	. ' primeiro. Use um valor de 0 (zero) não mostrar a mais Recente informação de Notícias no relatório informativo. '
	. ' São retidos valores inseridos aqui de relatório informativo para relatório informativo, mas você pode os trocar '
	. ' a qualquer hora para qualquer relatório informativo.');
define('_MSNL_ADM_HLP_INCLLATESTDLS',  ' Controla o número da mais recente baixa para exibir dentro do '
	. ' relatório informativo. A baixa estará em ordem cronológica que começa com o mais recente '
	. ' primeiro. Use um valor de 0 (zero) não mostrar o mais Recente Carrega informação no relatório informativo. '
	. ' São retidos valores inseridos aqui de relatório informativo para relatório informativo, mas você pode os trocar '
	. ' a qualquer hora para qualquer relatório informativo. ');

define('_MSNL_ADM_HLP_INCLLATESTWLS', ' Controla o número mais recente web unida para exibir no '
	. ' relatório informativo. As ligações de web estarão em ordem cronológica que começa com o mais recente '
	. ' primeiro. Use um valor de 0 (zero) para não mostrar a informação mais Recente Web Links no relatório informativo. '
	. ' São retidos valores inseridos aqui de relatório informativo para relatório informativo, mas você pode os trocar '
	. ' a qualquer hora para qualquer relatório informativo. '
	);

define('_MSNL_ADM_HLP_INCLLATESTFORS', ' Controla o número mais recente do fórum enviado para exibir mo '
	. ' relatório informativo. As mensagens de fórum estarão em ordem cronológica que começa com o mais recente '
	. ' primeiro. Use um valor de 0 (zero) para não mostrar a mais Recente informação de  Fórum Enviada no relatório informativo. '
	. ' São retidos valores inseridos aqui de relatório informativo para relatório informativo, mas você pode os trocar '
	. ' a qualquer hora para qualquer relatório informativo.  Além, só publicação disponível (leia) de fóruns das '
	. ' mensagens deles. '
	);

define('_MSNL_ADM_HLP_INCLLATESTREVS', ' Controla o número mais recentes das revisões para exibir no '
	. ' relatório informativo. As revisões estarão em ordem cronológica que começa com o mais recente '
	. ' primeiro. Use um valor de 0 (zero) para não mostrar a mais Recente informação de Revisão no relatório informativo. '
	. ' São retidos valores inseridos aqui de relatório informativo para relatório informativo, mas você pode os trocar '
	. ' a qualquer hora para qualquer relatório informativo. '
	);

//Section: Sponsors

define('_MSNL_ADM_LAB_SPONSORS',		'Patrocinadores');
define('_MSNL_ADM_LAB_CHOOSESPONSOR',	'Escolha um Patrocinador');
define('_MSNL_ADM_LAB_NOSPONSOR',		'Nenhum patrocinador');

define('_MSNL_ADM_HLP_CHOOSESPONSOR',	' Escolhendo um patrocinador substituirão a etiqueta {BANNER} '
	. ' no arquivo de modelo de relatório informativo com a imagem selecionada, ligação e texto alternado do '
	. ' sistema de banner'
	);

define('_MSNL_ADM_ERR_DBGETBANNERS',	'Não recebemos informação de banner de patrocinador');

//Section: Who to Send the Boletim Informativo To

define('_MSNL_ADM_LAB_WHOSNDTO',		'Para quem você quer enviar o Relatório informativo?');
define('_MSNL_ADM_LAB_CHOOSESENDTO',	'Escolha opção de destinatário');

define('_MSNL_ADM_LAB_WHOSNDTONLSUBS',	'Somente Subscritores de Newsletter');
define('_MSNL_ADM_LAB_WHOSNDTOALLREG',	'TODOS os usuários registrados');
define('_MSNL_ADM_LAB_WHOSNDTOPAID',	'Somente Subscritores já pagos');
define('_MSNL_ADM_LAB_WHOSNDTOANONY',	'TODAS as visitas de site - Nenhum e-mail é enviado, mas '
	. ' qualquer visita pode ver o relatório informativo');
define('_MSNL_ADM_LAB_WHOSNDTONSNGRPS',		'Um ou mais Grupos  NSN  - escolha o grupo abaixo');
define('_MSNL_ADM_LAB_WHOSNDTOADM',				'E-mail de Teste (só para Admin)');
define('_MSNL_ADM_LAB_SUBSCRIBEDUSRS',		'usuários subscritos');
define('_MSNL_ADM_LAB_USERS',							'Usuários');
define('_MSNL_ADM_LAB_PAIDUSRS',					'Usuários pagantes');
define('_MSNL_ADM_LAB_NSNGRPUSRS',				'Usuários do Grupo NSN');
define('_MSNL_ADM_LAB_WHOSNDTOADHOC',			'Lista Ad-Hoc de distribuição de e-mail ');
define('_MSNL_ADM_VAL_WHOSNDTOADHOC', 'Had invalid email address(es)'); // Needs translation
define('_MSNL_ADM_LAB_WHOSNDTOANONYV',		'TODAS as visitas de site');

define('_MSNL_ADM_HLP_WHOSNDTONLSUBS', ' Escolhendo esta opção enviarão o relatório informativo '
	. ' para todos seus usuários de nuke que subscreveram em seu site relatório informativo pelo deles '
	. ' preferências de conta. '
	);
define('_MSNL_ADM_HLP_WHOSNDTOALLREG', ' Escolhendo esta opção enviarão o relatório informativo '
	. ' para todos seus usuários registrados.  Tenha cuidado ao usa esta opção como seus usuários não pode '
	. ' apreciar tendo um relatório informativo enviado a eles pelos quais eles não pediram. '
	);
define('_MSNL_ADM_HLP_WHOSNDTOPAID', ' Escolhendo esta opção enviarão o relatório informativo '
	. ' para todos seu site pagou os subscritores - i.e., esses com subscrições ativas. '
	);
define('_MSNL_ADM_HLP_NSNGRPUSRS', ' Escolhendo esta opção lhe permitirão selecionar '
	. ' um ou mais NSN Groups para ter o relatório informativo enviado. '
	);
define('_MSNL_ADM_HLP_WHOSNDTOANONYV', ' Escolhendo esta opção não enviarão um relatório informativo '
	. ' mas, exibirá o relatório informativo dentro do arquivo de bloco. Porém, façam '
	. ' se lembrarem de que ainda os blocos devem ser ajustadas e as permissões de módulo como desejado. '
	);

define('_MSNL_ADM_HLP_WHOSNDTOADM', ' Escolhendo esta opção serão enviados um relatório informativo de teste '
	. ' para VOCÊ - SÓMENTE a um admin do site. Uma vez que você validou que o relatório informativo está pronto para '
	. ' ser enviado a seus destinatários planejados, use o <span class="thick">Send Testados</span> ligação no '
	. ' topo desta página. '
	);
define('_MSNL_ADM_HLP_WHOSNDTOADHOC', ' Escolhendo esta opção lhe permitirá enviar o '
	. ' relatório informativo para um ou mais endereços de e-mail de sua escolha.  Você simplesmente tem que separar '
	. ' cada endereço com uma vírgula e você tem que se assegurar que os endereços são válidos. '
	);

//Section: NSN Groups

define('_MSNL_ADM_LAB_CHOOSENSNGRP', 'Qual NSN Group(s) enviar?');
define('_MSNL_ADM_LAB_CHOOSENSNGRP1', ' (seleção será ignorada se opção a NSN Group acima '
	. ' não for escolhido) '
	);
define('_MSNL_ADM_LAB_WHONSNGRP',	' Escolha um ou mais grupos');

define('_MSNL_ADM_ERR_DBGETNSNGRPS',	' Incapaz receber informações de NSN Groups');

define('_MSNL_ADM_HLP_CHOOSENSNGRPUSRS', ' Escolha um ou mais grupos abaixo. O relatório informativo '
	. ' será enviado a todos os usuários de nuke que estão no group serão escolhidos.  Se um usuário estiver '
	. ' em mais de um grupo, o relatório informativo será enviado só uma vez a ele. '
	);

/************************************************************************
* Function: msnl_admin_preview  (Create Boletim Informativo --> Preview)
************************************************************************/

define('_MSNL_ADM_PREV_LAB_VALPREVNL',		'Criar Notícia - Validar e Pré-visualiar');
define('_MSNL_ADM_PREV_LAB_PREVNL',			'Pré-visualizar Notícia');

define('_MSNL_ADM_PREV_MSG_SUCCESS',		'Notícia passou por toda a validação e está pronto '
	.'para pré-visualizar abaixo');

/************************************************************************
* Function: msnl_admin  (Create Boletim Informativo --> admin_check_post.php)
************************************************************************/

define('_MSNL_ADM_LAB_NSNGRPS',				'NSN Groups');

define('_MSNL_ADM_VAL_NONSNGRP', ' Você escolheu enviar para um Grupo de NSN mas '
	. ' não selecionou um grupo para enviar para'
	);

define('_MSNL_ADM_ERR_NOTEMPLATE',	'Possível tentativa de golpe - nenhum modelo escolhido');
define('_MSNL_ADM_VAL_NOSENDTO', 'Possível tentativa de golpe - não Envie para opção escolhida');

define('_MSNL_ADM_ERR_DBUPDLATEST',	 'houve um erro ao atualizar \' mais Recente _____ \' informação de configuração');

/************************************************************************
* Function: msnl_admin (Create Boletim Informativo --> admin_send_mail.php)
************************************************************************/

define('_MSNL_ADM_SEND_LAB_SENDNL',		'Criar Notícias - Enviar Mail');
define('_MSNL_ADM_SEND_LAB_TESTNLFROM',	'Testar Boletim Informativo de');
define('_MSNL_ADM_SEND_LAB_NLFROM',		'Boletim Informativo de');

define('_MSNL_ADM_SEND_MSG_ANONYMOUS',	'Relatório informativo foi adicionado para TODAS as visitas visualizarem');
define('_MSNL_ADM_SEND_MSG_LOTSSENT',	'Mais de 500 usuários receberão o '
	. ' relatório informativo, isto pode demorar 10 minutos ou mais e pode ocorrer o limite de tempo do PHP.'
	);
define('_MSNL_ADM_SEND_MSG_TOTALSENT',		'Total de Emails Enviados');
define('_MSNL_ADM_SEND_MSG_VERBOSENOSEND', 'NOTE: Since in VERBOSE debug mode, no actual emails are sent.  The list of intended recipients are as follows:');
define('_MSNL_ADM_SEND_MSG_SENDSUCCESS',	'E-mails de relatório informativo enviados com sucesso');
define('_MSNL_ADM_SEND_MSG_SENDFAILURE',	'Envio de E-mail de relatório informativo falhou');

define('_MSNL_ADM_SEND_ERR_NOTESTEMAIL',	'Não possa encontrar o arquivo de testemail.php');
define('_MSNL_ADM_SEND_ERR_INVALIDVIEW',	'Opção de visão inválida fornecida');
define('_MSNL_ADM_SEND_ERR_CREATENL',		'Não possa copiar de testemail para o '
	. ' arquivo de relatório informativo'
	);
define('_MSNL_ADM_SEND_ERR_DBNLSINSERT',	'Não pode inserir o relatório informativo no '
	. ' banco de dados'
	);
define('_MSNL_ADM_SEND_ERR_DBNLSNID',		'Não pode receber o NID do justo '
	. ' relatório informativo inserido'
	);
define('_MSNL_ADM_SEND_ERR_MAIL',			'função PHP mail falhou - não pôde enviar '
	. ' relatório informativo para:'
	);
define('_MSNL_ADM_SEND_ERR_DELFILETEST',	'Apagar do arquivo testemail.php falhou');
define('_MSNL_ADM_SEND_ERR_DELFILETMP',		'Apagar do arquivo de tmp.php falhou');

/************************************************************************
* Function: msnl_admin (Create Boletim Informativo --> admin_make_nls.php)
************************************************************************/

define('_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR', ' Incapaz recuperar Estatísticas para número de usuários');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS', ' Incapaz recuperar Estatísticas para cliques de site totais');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS', ' Incapaz recuperar Estatísticas para número de artigos de notícias');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT', ' Incapaz recuperar Estatísticas para número de categorias de notícias');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS', ' Incapaz recuperar Estatísticas para número de downloads');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT', ' Incapaz recuperar Estatísticas para número de baixam categorias');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS', ' Incapaz recuperar Estatísticas para número de ligações de web');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT', ' Incapaz recuperar Estatísticas para número de categorias de ligação de web');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS', ' Incapaz recuperar Estatísticas para número de fóruns');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS', ' Incapaz recuperar Estatísticas para número de mensagens de fórum');
define('_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS', ' Incapaz recuperar Estatísticas para número de revisões');


define('_MSNL_ADM_SEND_ERR_DBGETNEWS', ' Incapaz recuperar mais recentes artigos de notícias');
define('_MSNL_ADM_MAKE_ERR_DBGETDLS', ' Incapaz recuperar mais recente downloads');
define('_MSNL_ADM_MAKE_ERR_DBGETWLS', ' Incapaz recuperar mais recentes ligações de web');
define('_MSNL_ADM_MAKE_ERR_DBGETPOSTS', ' Incapaz recuperar mais recentes mensagens de fórum');
define('_MSNL_ADM_MAKE_ERR_DBGETREVIEWS', ' Incapaz recuperar mais recentes revisões');
define('_MSNL_ADM_MAKE_ERR_DBGETBANNER', ' Incapaz recuperar banner');

/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/

define('_MSNL_ADM_TEST_LAB_PREVNL',	'Pré-visualizar Relatório informativo Testados para Enviar');

/************************************************************************
* Function: msnl_cfg	(Main Configuration Options)
************************************************************************/

define('_MSNL_CFG_LAB_MAINCFG',	'Configuração de Módulo principal');

//Module Options
define('_MSNL_CFG_LAB_MODULEOPT', ' Opções de Módulo');
define('_MSNL_CFG_LAB_DEBUGMODE', ' Modo de Depuração');
define('_MSNL_CFG_LAB_DEBUGMODE_OFF', ' DESLIGADO');
define('_MSNL_CFG_LAB_DEBUGMODE_ERR', ' ERRO');
define('_MSNL_CFG_LAB_DEBUGMODE_VER', ' VERBOSE');
define('_MSNL_CFG_LAB_DEBUGOUTPUT', ' Saida de Depuração');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_DIS', ' EXIBIR');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_LOG', ' ARQUIVO DE LOG');
define('_MSNL_CFG_LAB_DEBUGOUTPUT_BTH', ' AMBOS');
define('_MSNL_CFG_LAB_SHOWBLOCKS', ' Exibir Blocos Direitos');
define('_MSNL_CFG_LAB_NSNGRPS', ' Uso Grupos de NSN');
define('_MSNL_CFG_LAB_DLMODULE', ' Download de Nome de Módulo');
define('_MSNL_CFG_LAB_WYSIWYGON', ' Uso de Editor WYSIWYG');
define('_MSNL_CFG_LAB_WYSIWYGROWS', ' Linhas de Conteúdo');


define('_MSNL_CFG_HLP_DEBUGMODE', ' Isto permite o administrador de módulo fixar vários níveis de '
	. ' depuração de messagens como a seguir:<br /> <strong>DESLIGADO </strong> = Só aplicação erro nivelado '
	. ' mensagens, sem detalhes será exibido. <br /> <strong>ERRO </strong> = Aplicação '
	. ' serão exibidos erros, junto com útil depure texto de mensagem.  Erros de SQL também vão '
	. ' exibir uma mensagem de erro SQL atual e SQL gerado. <br /> <strong>VERBOSE </strong> '
	. ' = Serão exibidas mensagens muito detalhadas ao longo da aplicação, inclusive caminho '
	. ' nomes (tenha cuidado com não deixar este ajustes em para muito longo ou em um muito ativo '
	. ' site de web como pudesse prover de informação útil a um hacker!). <span class="thick">NOTA: e-mails '
	. ' não será enviado se usar esta opção </span> - muito útil para depurar propósitos. '
	);

define('_MSNL_CFG_HLP_DEBUGOUTPUT', ' Esta opção não é usada neste momento.  No futuro '
	. ' proverá habilidade para exibir as depurações anteriores de mensagens ao navegador, um arquivo Log, '
	. ' ou ambos. '
	);

define('_MSNL_CFG_HLP_SHOWBLOCKS', 'Isto estando <strong>marcado </strong> exibirá o '
	. ' blocos direito quando no módulo.  Isto estando <strong>desmarcado </strong> esconderá '
	. ' os blocos da direita.  O padrão para isto é <strong>desmarcado </strong>. '
	);
define('_MSNL_CFG_HLP_NSNGRPS', ' Esta opção só pode ser usada se você tiver '
	. ' NSN Groups adicionar-em instalou.  Se você gostasse de poder enviar relatórios informativos '
	. ' para um ou mais NSN Groups, confira esta opção. '
	);
define('_MSNL_CFG_HLP_DLMODULE', ' Substitua isto com o próprio módulo '
	. ' extensão, ex. o módulo padrão é \'downloads\' de nuke_'
	. ' <strong>downloads </strong>_downloads. Para NSN Grupos módulo, é \'nsngd\' '
	. ' de nuke_ <strong>nsngd </strong>_downloads. '
	);
define('_MSNL_CFG_HLP_WYSIWYGON', ' Confere isto se você desejar usar o editor WYSIWYG '
	. ' para editar o conteúdo de relatório informativo (textbody). <strong>NOTAS:</strong> esta '
	. ' opção requer que o nukeWYSIWYG esteja pre-instalado. '
	);
define('_MSNL_CFG_HLP_WYSIWYGROWS', ' Isto controla o número de linhas que são '
	. ' criadas disponível no Criar página de Relatório informativo dentro do Conteúdo de Relatório informativo '
	. ' (textbody). trabalha com WYSIWYG e sem. '
	);

//Show Options
define('_MSNL_CFG_LAB_SHOWOPT', 'Exibir Opções');
define('_MSNL_CFG_LAB_SHOWCATS', 'Exibir categorias ');
define('_MSNL_CFG_LAB_SHOWHITS', ' Exibir cliques');
define('_MSNL_CFG_LAB_SHOWDATES', ' Exibir data remessa');
define('_MSNL_CFG_LAB_SHOWSENDER', ' Exibir Remetente');


define('_MSNL_CFG_HLP_SHOWCATS', ' Se marcado, mostrará relatórios informativos abaixo '
	. ' das categorias respectivas no bloco deles.  Sempre serão exibidas categorias '
	. ' nos Arquivos (módulo). '
	);
define('_MSNL_CFG_HLP_SHOWHITS', ' Se marcado, exibirá o número '
	. ' de visualizações (cliques) que um relatório informativo recebe dentro do bloco e nos Arquivos (módulo). '
	);
define('_MSNL_CFG_HLP_SHOWDATES', ' Se marcado, exibirá a data que '
	. ' cada relatório informativo foi enviado no bloco e nos Arquivos (módulo). '
	);
define('_MSNL_CFG_HLP_SHOWSENDER', ' Se marcado,, exibirá o remetente que '
	. ' enviou cada relatório informativo no bloco e nos Arquivos (módulo). '
	);

//Block Options

define('_MSNL_CFG_LAB_BLKOPT', ' Opções de Bloco');
define('_MSNL_CFG_LAB_BLKLMT', ' Relatórios informativos para exibir no bloco');
define('_MSNL_CFG_LAB_SCROLL', ' Use Scrolling  code bloco');
define('_MSNL_CFG_LAB_SCROLLHEIGHT', ' Código Scrolling de Altura ');
define('_MSNL_CFG_LAB_SCROLLAMT', '  Código Scrolling da soma');
define('_MSNL_CFG_LAB_SCROLLDELAY', ' Código Scrolling  de demora ');

define('_MSNL_CFG_HLP_BLKLMT', ' Limita o número TOTAL de relatórios informativos '
	. ' exibidos no bloco.  Se categorias são viradas em, o número de relatórios informativos '
	. ' exibir em uma categoria particular é uma configuração separada de ajuste. '
	);
define('_MSNL_CFG_HLP_SCROLL', ' Esta característica dá para o bloco informação '
	. ' a habilidade para enrolar acima no block'
	);
define('_MSNL_CFG_HLP_SCROLLHEIGHT', ' Fixe a altura da área de rolagem em '
	. ' pixels, padrão é 180. Tenha cuidado, se você cria isto muito pequeno que você pode não ver nada. '
	);
define('_MSNL_CFG_HLP_SCROLLAMT', ' Fixe a quantia de rolagem no enrolar, '
	. ' isto em afete é a distância que a Informação moverá em-entre a demora de Rolagem. '
	. ' Padrão é 2. '
	);
define('_MSNL_CFG_HLP_SCROLLDELAY', ' Fixe a demora de rolagem no enrolar, '
	. ' isto é quanto tempo a informação espera antes de se mudasse para mil-segundo novamente. Padrão é 25. '
	);

/************************************************************************
* Function: msnl_cfg_apply	(Apply Changes to Main Configuration)
************************************************************************/


define('_MSNL_CFG_APPLY_ERR_DBFAILED', ' Atualização de informação de configuração falhou');
define('_MSNL_CFG_APPLY_VAL_DEBUGMODE', ' Inválido Modo de Depuração foi fornecido - poderia ter '
	. ' problema com instalação de módulo'
	);
define('_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT', ' Inválido Saída de Depuração foi fornecida - poderia ter '
	. ' problema com instalação de módulo'
	);
define('_MSNL_CFG_APPLY_MSG_BACK', ' Voltar para Configuração Principal');

/************************************************************************
* Function: msnl_cat	(Maintain Boletim Informativo Categories)
************************************************************************/

define('_MSNL_CAT_LAB_CATCFG',	'Configuração de Categorias de relatório informativo');
define('_MSNL_CAT_LAB_ADDCAT',		'ACRESCENTAR CATEGORIA');
define('_MSNL_CAT_LAB_CATTITLE',	'Título de Categoria');
define('_MSNL_CAT_LAB_CATDESC',		'Descrição de Categoria');
define('_MSNL_CAT_LAB_CATBLOCKLMT',	'Limite do Bloco');

define('_MSNL_CAT_LNK_ADDCAT', ' Acrescentar uma nova categoria de relatório informativo');
define('_MSNL_CAT_LNK_CATCHG', ' Editar categoria de relatório informativo');
define('_MSNL_CAT_LNK_CATDEL', ' Apagar categoria de relatório informativo');
define('_MSNL_CAT_MSG_CATBACK', ' Voltar para lista de Categorias de Relatório informativo');
define('_MSNL_CAT_ERR_DBGETCAT', ' não Recebeu informação de categoria de relatório informativo');
define('_MSNL_CAT_ERR_DBGETCATS', ' não Adquiriu categorias de relatório informativo');
define('_MSNL_CAT_ERR_NOCATS', ' Nenhuma categoria encontrada - problema Principal com instalação');
define('_MSNL_CAT_ERR_INVALIDCID', ' Categoria de Relatório informativo Inválida ID era provida');
define('_MSNL_CAT_ERR_DBGETCNT', ' Receba conta de falhas de relatórios informativos impresso');

define('_MSNL_CAT_HLP_CATTITLE', ' Este campo é o título da categoria que vai '
	. ' exibur em ambos os blocos (se habilitado pelas opções de configuração) e o arquivo do relatório informativo. '
	. ' Desde que isto é o que será usado no bloco para se agrupar relatórios informativos '
	. ' você deveria manter o título a 30 caracteres ou menos em tamanho assim o bloco fará '
	. ' corretamente. '
	);
define('_MSNL_CAT_HLP_CATDESC', ' Este é um campo muito grande. A única restrição '
	. ' é não embutir etiquetas de HTML nisto.  O permitirá fazer isto, mas eles serão tirados '
	. ' na saida posterior.  Dê uma descrição boa e completa desta categoria de relatório informativo. '
	);
define('_MSNL_CAT_HLP_CATBLOCKLMT', ' Este campo só é usado se a categorias <span class="thick">exibir </span> '
	. ' opção de configuração é verificada e deve ser maior que zero.  Insira aqui o número de '
	. ' relatórios informativos que deveriam ser exibidos abaixo desta categoria no bloco. <span class="thick">Se um valor não é '
	. ' fornecido, isto será padronizado '
	);

/************************************************************************
* Function: msnl_cat_add
************************************************************************/

define('_MSNL_CAT_ADD_LAB_CATADD',	' Configuração de Categorias de relatório informativo - Acrescentar Categoria');

/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/

define('_MSNL_CAT_ADD_APPLY_DBCATADD',		'Adicionar Categoria de Relatório informativo falhou');

/************************************************************************
* Function: msnl_cat_chg
************************************************************************/

define('_MSNL_CAT_CHG_LAB_CATCHG',				'Configuração de Categorias de Boletim Informativo - Troca de Categoria');

define('_MSNL_CAT_CHG_MSG_CHGIMPACT',			'Newsletter(s) será impresso por esta troca');

/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/

define('_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG','Atualização de categoria de Relatório informativo falhou');

/************************************************************************
* Function: msnl_cat_del
************************************************************************/

define('_MSNL_CAT_DEL_MSG_DELIMPACT', ' Newsletter(s) será impresso por isto apague. ');
define('_MSNL_CAT_DEL_MSG_DELIMPACT1', ' Imprensão do relatórios informativos serão re-nomeados o '
	. ' padrão da categoria relatório informativo.  Você deseja continuar com este apagar? '
	);

/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/

define('_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN',	'Re-nomear o relatórios informativos falhou');
define('_MSNL_CAT_DEL_APPLY_ERR_DBDELETE','Apagar categoria de relatório informativo falhou');

/************************************************************************
* Function: msnl_nls
************************************************************************/

define('_MSNL_NLS_LAB_NLSCFG',		'Manter Newsletters');
define('_MSNL_NLS_LAB_CURRENTCAT',	'Categoria Atual');
define('_MSNL_NLS_LAB_DATESENT',	'Data de Envio');
define('_MSNL_NLS_LAB_CATEGORY',	'Categoria');

define('_MSNL_NLS_LNK_GETNLS',		'Obter pedidos de relatórios informativos');
define('_MSNL_NLS_LNK_VIEWNL',		'Ver relatório informativo - pode abrir nova janela');
define('_MSNL_NLS_LNK_NLSCHG', ' Editar informação de relatório informativo');
define('_MSNL_NLS_LNK_NLSDEL', ' Apagar newsletter');

define('_MSNL_NLS_MSG_NONLSS', ' Nenhum relatório informativo encontrado para a categoria');
define('_MSNL_NLS_MSG_NLSBACK', ' Voltar para lista de Relatório informativo');

define('_MSNL_NLS_ERR_DBGETNLSS', ' não Adquiriu relatórios informativos');
define('_MSNL_NLS_ERR_DBGETNLS', ' não Recebeu informação de relatório informativo');

define('_MSNL_NLS_ERR_INVALIDNID', ' Relatório informativo Inválido ID era provided');
define('_MSNL_NLS_ERR_NONLSS', ' Nenhuma relatório informativo encontrado - problema Principal com instalação');

/************************************************************************
* Function: msnl_nls_chg
************************************************************************/

define('_MSNL_NLS_CHG_LAB_NLSCHG', ' Mantenha Relatórios informativos - Troca de Informação de Relatório informativo');
define('_MSNL_NLS_CHG_LAB_DATESENT', ' Data do Envio');
define('_MSNL_NLS_CHG_LAB_WHOVIEW', ' Quem pode Ver Newsletter');
define('_MSNL_NLS_CHG_LAB_NSNGRPS', ' Grupos de NSN podem Ver Newsletter');
define('_MSNL_NLS_CHG_LAB_NBRHITS', ' Número de Cliques');
define('_MSNL_NLS_CHG_LAB_FILENAME', ' Nome do Arquivo de Relatório informativo');
define('_MSNL_NLS_CHG_LAB_CAUTION', ' Troca sob valores SÓ se você sabe o que você esta fazendo');

define('_MSNL_NLS_CHG_HLP_DATESENT', 			'Currently, the date must be entered in format '
	.'YYYY-MM-DD as displayed in this field.  When a newsletter is first created and sent, '
	.'this field is populated with the current system date.  Newsletters are always listed '
	.'in date order sequence with the most recent one on the top of the list.'
	);
define('_MSNL_NLS_CHG_HLP_WHOVIEW', ' Este campo é nome de  sistema - tenha cuidado em '
	. ' trocar isto!  Valores válidos são: '
	. ' <br /> <strong>0 </strong> = anônimo - todos podem visualizar'
	. ' <br /> <strong>1 </strong> = todos os usuários registrados'
	. ' <br /> <strong>2 </strong> = somente subscritos no relatório informativo'
	. ' <br /> <strong>3 </strong> = somente membros pagantes do site'
	. ' <br /> <strong>4 </strong> = somente Grupos selecionados NSN Groups'
	. ' <br /> <strong>5 </strong> = lista de distribuição de adhoc'
	. ' <br /> <strong>99 </strong> = somente admin do site. '
	);
define('_MSNL_NLS_CHG_HLP_NSNGRPS',  ' Requer que a opção anterior <span class="thick">visualizar </span> '
	. ' só seja ajustado a 4 para Grupos de *NSN *. Cada Grupo de NSN tem um número de ID específico associado '
	. ' com isto.  A hora de criar/enviar o relatório informativo, a pessoa pode escolher um ou mais NSN Groups para '
	. ' enviar.  Para só um grupo, este campo deveria ter só o grupo associado ID. '
	. ' Para mais de um grupo, cada grupo que ID deveria ser separado por um sinal - , por exemplo <span class="thick">1-2-3 </span>. '
	);
define('_MSNL_NLS_CHG_HLP_NBRHITS', ' Quando um relatório informativo é visualizado do site de web que usa '
	. ' um bloco ligação ou uma ligação de arquivos, o relatório informativo o clique na conta é incrementada.  '
	. ' O cliques contra não é incrementado se o usuário estiver logado como admin. '
	);
define('_MSNL_NLS_CHG_HLP_FILENAME', ' Este campo é nome de sistema.  Se você trocar isto, '
	. ' tenha certeza que o nome de arquivo existe e está formatado corretamente para visualizar por este sistema. '
	);

/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/

define('_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW', ' Valor deve ser um de 0 - 4, ou 99 ');

define('_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG', ' Atualizar informação de Relatório informativo falhou');

/************************************************************************
* Function: msnl_nls_del
************************************************************************/


define('_MSNL_NLS_DEL_MSG_DELIMPACT',' Você está a ponto de apagar este relatório informativo permanentemente. ');
define('_MSNL_NLS_DEL_MSG_DELIMPACT1', ' Todas as informações relacionadas a este relatório informativo serão '
	. ' apagadas do banco de dados como também o arquivo de relatório informativo dentro do diretório de arquivo. '
	. ' Você deseja continuar com este apague? '
	);
/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/

define('_MSNL_NLS_DEL_APPLY_ERR_FILEDEL', 'Não pode abrir abrir para apagar arquivo de relatório informativo - checkDelete de informação de Relatório informativo falhou '
	.'permissão de arquivo'
	);

define('_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL','Apagar informação de Relatório informativo falhou');

