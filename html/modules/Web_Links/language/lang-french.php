<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to the site and send to me        */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
global $anonwaitdays, $outsidewaitdays, $sitename;
define('_1WEEK','1 semaine');
define('_2WEEKS','2 semaines');
define('_30DAYS','30 jours');
define('_ADDALINK','Ajouter un nouveau Lien');
define('_ADDEDON','Ajout&eacute; le');
define('_ADDITIONALDET','D&eacute;tails additionnels');
define('_ADDLINK','Ajouter un lien');
define('_ADDURL','Ajouter cet URL');
define('_ALLOWTORATE','Autoriser les autres utilisateurs &agrave; voter depuis votre site Web !');
define('_AND','et');
define('_BESTRATED','Liens les mieux cot&eacute;s - Top');
define('_BREAKDOWNBYVAL','D&eacute;coupage des &eacute;valuations par valeur');
define('_BUTTONLINK','Lien \'bouton\'');
define('_CATEGORIES','cat&eacute;gories');
if (!defined('_CATEGORY')) define('_CATEGORY','Cat&eacute;gorie');
define('_CATLAST3DAYS','Nouveaux liens dans cette cat&eacute;gorie ajout&eacute;s ces 3 derniers jours');
define('_CATNEWTODAY','Nouveaux liens dans cette cat&eacute;gorie ajout&eacute;s aujourd\'hui');
define('_CATTHISWEEK','Nouveaux liens dans cette cat&eacute;gorie ajout&eacute;s cette semaine');
define('_CHECKFORIT','Vous n\'avez pas entr&eacute; votre adresse Email.  Nous v&eacute;rifierons cependant votre lien prochainement.');
define('_COMPLETEVOTE1','Votre vote est enregistré.');
define('_COMPLETEVOTE2','Vous avez déjà voté pour cette ressource dans le passé '."$anonwaitdays".' jour(s).');
define('_COMPLETEVOTE3','Votez pour une ressource seulement une fois<br />Tous les votes sont loggés');
define('_COMPLETEVOTE4','Vous ne pouvez pas voter sur un lien que vous avez proposez.<br />Tous les votes sont loggés.');
define('_COMPLETEVOTE5','Aucune note n\'a été choisie - Le vote n\'a pas été pri en compte');
define('_COMPLETEVOTE6','Seulement un vote par adresse IP est autorisé tous les '."$outsidewaitdays".' jour(s).');
if (!defined('_DATE')) { define('_DATE','Date'); }
define('_DATE1','Date (Les liens les plus anciens affich&eacute;s en premier)');
define('_DATE2','Date (Les nouveaux liens affich&eacute;s en premier)');
define('_DAYS','jours');
define('_DESCRIPTION','Description');
define('_DETAILS','D&eacute;tails');
define('_EDITORIAL','Editorial');
define('_EDITORIALBY','Compte rendu par');
define('_EDITORREVIEW','Compte-rendu de l\'&eacute;diteur');
define('_EDITTHISLINK','Editer ce Lien');
define('_EMAILWHENADD','Vous recevrez un E-mail quand il sera approuv&eacute;.');
define('_FEELFREE2ADD','Votre commentaire &agrave; propos de ce site est le bienvenu.');
define('_HIGHRATING','Cote la plus haute');
define('_HITS','Hits');
define('_HTMLCODE1','Le code HTML &agrave; utiliser dans ce cas est::');
define('_HTMLCODE2','Le code source pour l\'utilisation du bouton ci-dessus est:');
define('_HTMLCODE3','L\'utilisation de ce formulaire autorise vos visiteurs &agrave; voter pour votre site directement depuis vos pages Web, et l\'&eacute;valuation sera enregistr&eacute;e ici.  Le formulaire ci-dessus est inactif, mais le code source suivant fonctionnera si vous le copiez et le collez sur une de vos pages Web.  Voici le code source:');
define('_IDREFER','dans le source HTML r&eacute;f&eacute;rence l\'ID de votre site dans la base de donn&eacute;es de '."$sitename".'.  Assurez vous que ce nombre est pr&eacute;sent.');
define('_IFYOUWEREREG','Si vous &eacute;tiez enregistr&eacute;, vous pourriez commenter ce site.');
define('_INDB','dans notre base de donn&eacute;e');
define('_INOTHERSENGINES','dans d\'autres moteurs de recherche');
define('_INSTRUCTIONS','Instructions');
define('_ISTHISYOURSITE','S\'agit-il de votre site Web ? ');
define('_LAST30DAYS','Les 30 derniers jours');
define('_LASTWEEK','La semaine derni&egrave;re');
define('_LDESCRIPTION','Description: (255 caract&egrave;res max)');
define('_LETSDECIDE','Les contributions d\'utilisateurs tels que vous aideront d\'autres visiteurs &agrave; mieux choisir les liens sur lesquels cliquer.');
define('_LINKALREADYEXT','ERREUR: Cet URL est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;es!');
define('_LINKCOMMENTS','Commentaires sur le lien');
define('_LINKID','ID du lien');
define('_LINKNODESC','ERREUR: Vous devez saisir une DESCRIPTION pour votre URL!');
define('_LINKNOTITLE','ERREUR: Vous devez saisir un TITRE pour votre URL!');
define('_LINKNOURL','ERREUR: Vous devez saisir un URL pour votre URL!');
define('_LINKPROFILE','Profil du lien');
define('_LINKRATING','Evaluations des liens');
define('_LINKRATINGDET','D&eacute;tails de l\'&eacute;valuation du lien');
define('_LINKRECEIVED','Nous avons re&ccedil;us votre proposition. Merci!');
define('_LINKS','Liens');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LINKSMAIN','Liens principaux');
define('_LINKSMAINCAT','Cat&eacute;gories principales des liens');
define('_LINKSNOCATS1','There must be at least one link category created by'); //montego for RN0000571
define('_LINKSNOCATS2','the site admin before a link can be added.'); //montego for RN0000571
define('_LINKSNOTUSER1','Vous n\'&ecirc;tes pas un utilisateur enregistr&eacute;, ou vous ne vous &ecirc;tes pas connect&eacute;.');
define('_LINKSNOTUSER2','Si vous &eacute;tiez enregistr&eacute;, vous pourriez ajouter des liens sur ce site.');
define('_LINKSNOTUSER3','Devenir un membre enregistr&eacute; est un processus simple et rapide.');
define('_LINKSNOTUSER4','Pourquoi demandons-nous un enregistrement pour l\'acc&egrave;s &agrave; certaines options ?');
define('_LINKSNOTUSER5','De cette mani&egrave;re, nous pouvons vous offrir un contenu de qualit&eacute; &eacute;lev&eacute;,');
define('_LINKSNOTUSER6','chaque &eacute;l&eacute;ment est examin&eacute; individuellement et approuv&eacute; par notre &eacute;quipe.');
define('_LINKSNOTUSER7','Nous esp&eacute;rons vous offrir ainsi une information de valeur.');
define('_LINKSNOTUSER8','<a href="modules.php?name=Your_Account">Ouvrir un compte</a>');
define('_LINKTITLE','Titre du lien');
define('_LINKVOTE','Votez !');
define('_LOOKTOREQUEST','Nous examinerons votre requ&ecirc;te rapidement.');
define('_LOWRATING','Cote la plus basse');
define('_LTOTALVOTES','vote(s) au total');
define('_LVOTES','votes');
define('_MAIN','Principal');
if(!defined('_MODIFY')) define('_MODIFY','Modifier');
define('_MOSTPOPULAR','Les plus populaires - Top');
define('_NEW','Nouveaux');
define('_NEWLAST3DAYS','Nouveau ces 3 derniers jours');
define('_NEWLINKS','Nouveaux liens');
define('_NEWTHISWEEK','Nouveaux cette semaine');
define('_NEWTODAY','Nouveau aujourd\'hui');
define('_NEXT','Page Suivante');
define('_NOEDITORIAL','Il n\'y a pas de compte rendu disponible pour ce site.');
define('_NOMATCHES','Aucune correspondance trouv&eacute;e &agrave; votre requ&ecirc;te');
define('_NOOUTSIDEVOTES','Pas de votes d\'&eacute;lecteurs ext&eacute;rieurs');
define('_NOREGUSERSVOTES','Pas de votes d\'utilisateurs enregistr&eacute;s');
define('_NOUNREGUSERSVOTES','Pas de votes d\'utilisateurs non-enregistr&eacute;s');
define('_NUMBEROFRATINGS','Nombre d\'&eacute;valuations');
define('_NUMOFCOMMENTS','Nombre de commentaires');
define('_NUMRATINGS','Nbre d\'&eacute;valuations');
if (!defined('_OF')) { define('_OF','de'); }
define('_OFALL','de tous les');
define('_ONLYREGUSERSMODIFY','Seuls les utilisateurs enregistr&eacute;s peuvent sugg&eacute;rer des modifications pour les liens.  Veuillez <a href="modules.php?name=Your_Account">vous enregistrer ou vous connecter</a>.');
define('_OUTSIDEVOTERS','Electeurs ext&eacute;rieurs');
define('_OVERALLRATING','Evaluation g&eacute;n&eacute;rale');
define('_PAGETITLE','Titre de la page');
define('_PAGEURL','URL de la page');
define('_POPULAR','Populaires');
define('_POPULARITY','Popularit&eacute;');
define('_POPULARITY1','Popularit&eacute; (du plus petit au plus grand nombre de hits)');
define('_POPULARITY2','Popularit&eacute; (du plus grand au plus petit nombre de hits)');
define('_POSTPENDING','Tous les liens post&eacute;s sont susceptibles d\'&ecirc;tre v&eacute;rifi&eacute;s.');
define('_PREVIOUS','Page Pr&eacute;c&eacute;dente');
define('_PROMOTE01','Peut-&ecirc;tre serez-vous int&eacute;ress&eacute; par une de nos nombreuses options pour \'Evaluer un site\' &agrave; distance.  Celles-ci vous permettent de placer une image (ou un formulaire d\'&eacute;valuation) sur votre site pour augmenter le nombre de votes que votre site recevra.  Choisissez une des options pr&eacute;sent&eacute;es ci-dessous:');
define('_PROMOTE02','Un des moyens de mener vers le formulaire d\'&eacute;valuation est l\'utilisation d\'un lien textuel:');
define('_PROMOTE03','Si vous cherchez d\'autres solutions qu\'un simple lien textuel, vous choisirez peut-&ecirc;tre un lien par bouton:');
define('_PROMOTE04','Si vous tentez de tricher ici, nous enleverons votre lien. Ceci &eacute;tant dit, voici &agrave; quoi ressemble le formulaire d\'&eacute;valuation &agrave; distance.');
define('_PROMOTE05','Merci !  Et bonne chance pour l\'&eacute;valuation de votre site !');
define('_PROMOTEYOURSITE','Faites la promo de votre site Web');
define('_RANDOM','Al&eacute;atoires');
define('_RATEIT','Votez pour ce site !');
define('_RATENOTE1','Ne votez pas pour le m&ecirc;me site plus d\'une fois SVP.');
define('_RATENOTE2','L\'&eacute;chelle est de 1 &agrave; 10, 1 &eacute;tant <span class="italic"> faible </span> et 10 <span class="italic"> excellent </span>.');
define('_RATENOTE3','Soyez objectif dans votre vote, si chacun re&ccedil;oit un 1 ou un 10, le syst&egrave;me d\'&eacute;valuation n\'est plus tr&egrave;s utile.');
define('_RATENOTE4','Vous pouvez voir une liste des <a href="links.php?op=TopRated">sites les mieux cot&eacute;s</a>.');
define('_RATENOTE5','Ne votez pas pour votre propre site ou le site d\'un concurrent.');
define('_RATESITE','Evaluer ce site');
define('_RATETHISSITE','Evaluez ce site Web');
define('_RATING','Evaluation');
define('_RATING1','Evaluation (du plus petit au plus grand score)');
define('_RATING2','Evaluation (du plus grand au plus petit score)');
define('_REGISTEREDUSERS','Utilisateurs enregistr&eacute;s');
define('_REMOTEFORM','Formulaire d\'&eacute;valuation &agrave; distance');
define('_REPORTBROKEN','Signaler un lien mort');
define('_REQUESTLINKMOD','Requ&ecirc;te de modification d\'un lien');
define('_RETURNTO','Retour &agrave;');
define('_SCOMMENTS','Commentaires');
define('_SEARCHRESULTS4','R&eacute;sultats de la recherche pour');
define('_SELECTPAGE','Selectionnez la page');
define('_SENDREQUEST','Envoyer votre requ&ecirc;te');
define('_SHOW','Montrer');
define('_SHOWTOP','Montrer le Top');
define('_SITESSORTED','Sites actuellement class&eacute;s par');
define('_SORTLINKSBY','Trier les liens par');
define('_STAFF','Equipe');
define('_SUBMITONCE','Ne proposez qu\'une seule fois un lien unique');
define('_TEXTLINK','Lien textuel');
define('_THANKSBROKEN','Merci de votre aide pour maintenir l\'int&eacute;grit&eacute; de ce r&eacute;pertoire.');
define('_THANKSFORINFO','Merci pour cette information.');
define('_THANKSTOTAKETIME','Merci de prendre le temps d\'&eacute;valuer les sites sur');
define('_THENUMBER','Le nombre');
define('_THEREARE','Il y a');
define('_TITLE','Titre');
define('_TITLEAZ','Titre (de A &agrave; Z)');
define('_TITLEZA','Title (de Z &agrave; A)');
define('_TO','&agrave;');
define('_TOPRATED','Mieux cot&eacute;s');
define('_TOTALFORLAST','Total des nouveaux liens depuis');
define('_TOTALNEWLINKS','Total des nouveaux liens');
define('_TOTALOF','Total de');
define('_TOTALVOTES','Total des votes:');
define('_TRATEDLINKS','total des liens &eacute;valu&eacute;s');
define('_TRY2SEARCH','Essayez de rechercher');
define('_TVOTESREQ','minimum de votes requis');
define('_UNREGISTEREDUSERS','Utilisateurs non-enregistr&eacute;s');
define('_URL','URL');
define('_USER','Utilisateur');
define('_USERANDIP','L\'identifiant utilisateur et le num&eacute;ro IP sont enregistr&eacute;s, n\'abusez pas du syst&egrave;me svp.');
define('_USERAVGRATING','Moyenne des &eacute;valuations de l\'utilisateur');
define('_USUBCATEGORIES','Sous-cat&eacute;gories');
define('_VISITTHISSITE','Visitez ce site');
define('_VOTE4THISSITE','Votez pour ce site !');
define('_WEBLINKS','Liens Web');
define('_WEIGHNOTE','* Note: Le poid que donne ce site aux &eacute;valuations des utilisateurs enregistr&eacute;s par rapport &agrave; celles des utilisateurs anonymes est de');
define('_WEIGHOUTNOTE','* Note: Le poid que donne ce site aux &eacute;valuations des utilisateurs enregistr&eacute;s par rapport &agrave; celles des utilisateurs ext&eacute;rieurs est de');
define('_YOUARENOTREGGED','Vous n\'&ecirc;tes pas un utilisateur enregistr&eacute;, ou vous ne vous &ecirc;tes pas connect&eacute;.');
define('_YOUAREREGGED','Vous &ecirc;tes un utilisateur enregistr&eacute; et vous &ecirc;tes connect&eacute;.');
define('_YOUREMAIL','Votre Email');
define('_YOURNAME','Votre Nom');
?>