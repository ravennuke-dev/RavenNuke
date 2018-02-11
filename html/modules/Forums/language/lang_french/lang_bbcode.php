<?php
/***************************************************************************
 *                         lang_bbcode.php [French]
 *                            -------------------
 *   begin                : Wednesday Oct 3, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_bbcode.php 3208 2002-12-18 15:40:21Z psotfx $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/***************************************************************************
 *                         Translation: Informations
 *
 *   Version: 1.0.2
 *   Date: 07/03/2008 19:07:18
 *   Author: Xaphos (Maël Soucaze)
 *   Website: http://www.phpbb.fr/
 *
 ***************************************************************************/

/* CONTRIBUTORS
	2002-12-15	Philip M. White (pwhite@mailhaven.com)
		Fixed many minor grammatical problems.
*/

//
// To add an entry to your BBCode guide simply add a line to this file in this format:
// $faq[] = array("question", "answer");
// If you want to separate a section enter $faq[] = array("--","Block heading goes here if wanted");
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put double quotes (") in your BBCode guide entries, if you absolutely must then escape them ie. \"something\"
//
// The BBCode guide items will appear on the BBCode guide page in the same order they are listed in this file
//
// If just translating this file please do not alter the actual HTML unless absolutely necessary, thanks :)
//
// In addition please do not translate the colours referenced in relation to BBCode any section, if you do
// users browsing in your language may be confused to find they're BBCode doesn't work :D You can change
// references which are 'in-line' within the text though.
//

$faq[] = array("--","Introduction");
$faq[] = array("Qu’est-ce que le BBCode ?", "Le BBCode est une implémentation spéciale de l’HTML. Vous pouvez l’insérer dans vos messages sur le forum si celui-ci a été autorisé par l’administrateur. De plus, vous pouvez désactiver le BBCode sur chacun de vos messages par l’intermédiaire du formulaire de rédaction. Le BBCode est similaire à l’architecture de l’HTML, les balises sont contenues entre des crochets [ et ] à la place de &lt; et &gt;, et il offre un meilleur contrôle sur la mise en forme. Selon le template que vous utilisez, vous pouvez trouver et ajouter du BBCode à vos messages très facilement par l’intermédiaire d’une interface cliquable située juste au-dessus du formulaire de rédaction. Si ces brèves explications ne vous conviennent pas, vous pouvez consulter le guide suivant qui s’avère très explicite.");

$faq[] = array("--","Mise en forme du texte");
$faq[] = array("Comment puis-je mettre du texte en gras, en italique et en souligné ?", "Le BBCode inclut des balises qui vous permettent de modifier rapidement le style de base de votre texte. Ceci est réalisé grâce aux méthodes suivantes : <ul><li>Pour mettre une partie d’un texte en gras, il faut l’enfermer entre les balises <span class='thick'>[b][/b]</span>. Par exemple : <br /><br /><span class='thick'>[b]</span>Bonjour<span class='thick'>[/b]</span><br /><br />Deviendra : <span class='thick'>Bonjour</span></li><li>Pour souligner une partie d’un texte, utilisez les balises <span class='thick'>[u][/u]</span>. Par exemple :<br /><br /><span class='thick'>[u]</span>Bon appétit !<span class='thick'>[/u]</span><br /><br />Deviendra : <span class='underline'>Bon appétit !</span></li><li>Pour mettre une partie d’un texte en italique, utilisez les balises <span class='thick'>[i][/i]</span>. Par exemple :<br /><br />C’est <span class='thick'>[i]</span>excellent !<span class='thick'>[/i]</span><br /><br />Deviendra : C’est <span class='italic'>excellent !</span></li></ul>");
$faq[] = array("Comment puis-je modifier la taille ou la couleur du texte ?", "Pour modifier la taille ou la couleur du texte, les balises qui vont suivre pourront être utilisées. Gardez cependant à l’esprit que le rendu visuel final dépendra du navigateur et du système de l’utilisateur : <ul><li>Pour insérer une couleur sur une partie d’un texte, il faut l’enfermer entre les balises <span class='thick'>[color=][/color]</span>. Vous pouvez saisir le nom d’une couleur reconnue, comme par exemple red, blue ou yellow, ou saisir directement son code hexadécimal, comme #FFFFFF ou #000000. Par exemple, pour mettre une partie d’un texte en rouge, vous pouvez utiliser :<br /><br /><span class='thick'>[color=red]</span>Bonsoir !<span class='thick'>[/color]</span><br /><br />Ou encore :<br /><br /><span class='thick'>[color=#FF0000]</span>Bonsoir !<span class='thick'>[/color]</span><br /><br />Ce qui, dans les deux cas, deviendra : <span style=\"color:red\">Bonsoir !</span></li><li>Pour modifier la taille de la police d’une partie d’un texte, utilisez les balises <span class='thick'>[size=][/size]</span>. Ces balises dépendent du style que l’utilisateur a sélectionné, mais le format recommandé est une valeur numérique représentant la taille du texte en pixel, commençant de 1 (minuscule) et allant jusqu’à 29 (énorme). Par exemple :<br /><br /><span class='thick'>[size=9]</span>PETIT<span class='thick'>[/size]</span><br /><br />Deviendra : <span style=\"font-size:9px\">PETIT</span><br /><br />Alors que :<br /><br /><span class='thick'>[size=24]</span>ÉNORME !<span class='thick'>[/size]</span><br /><br />Deviendra : <span style=\"font-size:24px\">ÉNORME !</span></li></ul>");
$faq[] = array("Puis-je combiner des balises de mise en forme ?", "Bien sûr ! Par exemple, afin d’obtenir l’attention de tout le monde, vous pouvez écrire :<br /><br /><span class='thick'>[size=18][color=red][b]</span>REGARDEZ MOI !<span class='thick'>[/b][/color][/size]</span><br /><br />Ce qui deviendra : <span style=\"color:red;font-size:18px\"><span class='thick'>REGARDEZ MOI !</span></span><br /><br />Cependant, nous vous déconseillons fortement d’utiliser fréquemment ce genre de mise en forme ! Gardez à l’esprit qu’il faut simplement fermer les balises correctement et dans le bon ordre. Par exemple, ce qui suit est incorrect :<br /><br /><span class='thick'>[b][u]</span>C’est incorrect<span class='thick'>[/b][/u]</span>");

$faq[] = array("--","Citation et texte de largeur fixe");
$faq[] = array("Citation de texte dans les réponses", "Il y a deux manières de citer un texte, avec ou sans référence.<ul><li>Lorsque vous utilisez la fonction de citation afin de répondre à un message sur le forum, vous devriez noter que le texte qui est ajouté à la fenêtre du message est inséré entre les balises <span class='thick'>[quote=\"\"][/quote]</span>. Cette méthode vous permet de citer avec, comme référence, une personne ou autre chose que vous choisissez de commenter ! Par exemple, pour citer une partie d’un texte rédigé par M. Blobby, vous devez saisir :<br /><br /><span class='thick'>[quote=\"M. Blobby\"]</span>Le texte que M. Blobby a rédigé devra être ici<span class='thick'>[/quote]</span><br /><br />Le rendu final, “M. Blobby a écrit :”, sera ajouté automatiquement avant le texte actuel. Gardez à l’esprit que vous devez <span class='thick'>obligatoirement</span> insérer les guillemets de citation \"\" autour du nom que vous citez.</li><li>La deuxième méthode vous permet de citer aveuglément quelque chose. Pour l’utiliser, enfermez le texte entre les balises <span class='thick'>[quote][/quote]</span>. Lorsque vous consulterez le message ultérieurement, il affichera simplement le texte dans un bloc de citation, et cela sans référence.</li></ul>");
$faq[] = array("Mise en forme de codes ou de données de largeur fixe", "Si vous souhaitez insérer un fragment de code ou quelque chose qui demande une largeur fixe, comme le type de police Courier, vous devez enfermer le texte entre les balises <span class='thick'>[code][/code]</span>, par exemple :<br /><br /><span class='thick'>[code]</span>echo \"Ceci est un fragment de code\";<span class='thick'>[/code]</span><br /><br />Toutes les balises de mise en forme présentes entre les balises <span class='thick'>[code][/code]</span> sont conservées comme telles lorsque vous consulterez le message ultérieurement.");

$faq[] = array("--","Insertion de listes");
$faq[] = array("Création d’une liste non-ordonnée", "Le BBCode supporte deux types de liste, la liste ordonnée et la liste non-ordonnée. Elles sont pratiquement identiques par rapport à leur équivalent en HTML. Une liste non-ordonnée publie chaque article l’un après l’autre, en utilisant le caractère étoile. Pour créer une liste non-ordonnée, vous devez utiliser les balises <span class='thick'>[list][/list]</span> et définir chaque article dans la liste en utilisant la balise <span class='thick'>[*]</span>. Par exemple, pour lister vos couleurs favorites, vous pouvez utiliser :<br /><br /><span class='thick'>[list]</span><br /><span class='thick'>[*]</span>Rouge<br /><span class='thick'>[*]</span>Bleu<br /><span class='thick'>[*]</span>Jaune<br /><span class='thick'>[/list]</span><br /><br />Ce qui deviendra :<ul><li>Rouge</li><li>Bleu</li><li>Jaune</li></ul>");
$faq[] = array("Création d’une liste ordonnée", "Le second type de liste, la liste ordonnée, vous donne le contrôle de ce qui est affiché devant chaque article. Vous devez utiliser les balises <span class='thick'>[list=1][/list]</span> afin de créer une liste numérotée, ou bien encore les balises <span class='thick'>[list=a][/list]</span> afin de créer une liste alphabétique. Comme pour la liste non-ordonnée, les articles doivent être définis en utilisant la balise <span class='thick'>[*]</span>. Par exemple :<br /><br /><span class='thick'>[list=1]</span><br /><span class='thick'>[*]</span>Faire les boutiques<br /><span class='thick'>[*]</span>Acheter un nouvel ordinateur<br /><span class='thick'>[*]</span>Insulter l’ordinateur quand il est bloqué<br /><span class='thick'>[/list]</span><br /><br />Deviendra :<ol type=\"1\"><li>Faire les boutiques</li><li>Acheter un nouvel ordinateur</li><li>Insulter l’ordinateur quand il est bloqué</li></ol>Pour créer une liste alphabétique, vous devez utiliser :<br /><br /><span class='thick'>[list=a]</span><br /><span class='thick'>[*]</span>La première réponse possible<br /><span class='thick'>[*]</span>La seconde réponse possible<br /><span class='thick'>[*]</span>La troisième réponse possible<br /><span class='thick'>[/list]</span><br /><br />Ce qui deviendra :<ol type=\"a\"><li>La première réponse possible</li><li>La seconde réponse possible</li><li>La troisième réponse possible</li></ol>");

$faq[] = array("--", "Création de liens");
$faq[] = array("Insérer un lien vers un site quelconque", "Le BBCode de phpBB propose un certain nombre de manières afin de créer des URI (Uniform Resource Indicators), plus connues sous le nom d’URL.<ul><li>La première de celles-ci emploie la balise <span class='thick'>[url=][/url]</span> et ce qui est inséré après le signe = fait agir le contenu de cette balise en tant que lien. Par exemple, pour insérer un lien vers phpBB.fr, vous devez utiliser :<br /><br /><span class='thick'>[url=http://www.phpbb.fr/]</span>Visitez phpBB.fr !<span class='thick'>[/url]</span><br /><br />Cela génèrera le lien suivant : <a href=\"http://www.phpbb.fr/\" target=\"_blank\">Visitez phpBB.fr !</a> Vous serez averti si le lien s’ouvre ou non dans une nouvelle fenêtre, ce qui vous permettra de continuer votre navigation sur le forum si vous le souhaitez.</li><li>Si vous souhaitez que le lien soit affichée comme un lien basique, vous pouvez employer simplement ceci :<br /><br /><span class='thick'>[url]</span>http://www.phpbb.fr/<span class='thick'>[/url]</span><br /><br />Cela générera le lien suivant : <a href=\"http://www.phpbb.fr/\" target=\"_blank\">http://www.phpbb.fr/</a></li><li>De plus, les fonctionnalités de phpBB permettent d’insérer une fonctionnalité appelée les <span class='italic'>liens magiques</span>. Cela transformera n’importe quel lien en lien syntaxiquement correct, sans que vous ayez besoin de l’indiquer devant toutes les balises ou même encore d’ajouter http://. Par exemple, en écrivant www.phpbb.fr dans votre message, cela se complètera automatiquement en <a href=\"http://www.phpbb.fr/\" target=\"_blank\">www.phpbb.fr</a> lorsque vous verrez votre message par la suite.</li><li>La même chose est valable pour les adresses e-mail, vous pouvez indiquer sur l’un ou sur l’autre une adresse explicite, par exemple :<br /><br /><span class='thick'>[email]</span>inconnu@domaine.adr<span class='thick'>[/email]</span><br /><br />Générera : <a href=\"emailto:inconnu@domaine.adr\">inconnu@domaine.adr</a>, ou vous pouvez simplement écrire inconnu@domaine.adr dans votre message et celui-ci sera automatiquement complété lors de la visualisation.</li></ul>Comme avec toutes les balises BBCode, vous pouvez insérer des liens autour d’autres balises comme <span class='thick'>[img][/img]</span> (voir la prochaine question), <span class='thick'>[b][/b]</span>, etc. Comme pour les balises de mise en forme, il vous appartient d’en assurer l’usage correct d’ouverture et de fermeture des balises, et cela dans le bon ordre. Par exemple :<br /><br /><span class='thick'>[url=http://www.google.fr/][img]</span>http://www.google.fr/intl/fr_fr/images/logo.gif<span class='thick'>[/url][/img]</span><br /><br />N’est <span class='underline'>pas</span> correct, ce qui peut mener à la suppression de votre message.");

$faq[] = array("--", "Visualisation d’images dans les messages");
$faq[] = array("Ajout d’une image dans un message", "Le BBCode de phpBB intègre une balise afin d’insérer des images dans vos messages. Les deux choses très importantes à garder à l’esprit lors de l’utilisation des balises d’images sont que beaucoup d’utilisateurs n’apprécient pas un excès d’images dans les messages et que l’image que vous souhaitez afficher doit être déjà disponible sur Internet (elle ne peut pas exister seulement sur votre ordinateur, à moins que vous travailliez directement depuis un serveur Internet !). Pour afficher une image, vous devez renseigner le lien se dirigeant directement à l’image avec les balises <span class='thick'>[img][/img]</span>. Par exemple :<br /><br /><span class='thick'>[img]</span>http://www.google.fr/intl/fr_fr/images/logo.gif<span class='thick'>[/img]</span><br /><br />Comme noté dans la section des liens ci-dessus, vous pouvez intégrer une image entre des balises <span class='thick'>[url][/url]</span>. Par exemple :<br /><br /><span class='thick'>[url=http://www.google.fr/][img]</span>http://www.google.fr/intl/fr_fr/images/logo.gif<span class='thick'>[/img][/url]</span><br /><br />Deviendra :<br /><br /><a href=\"http://www.google.fr/\" target=\"_blank\"><img src=\"http://www.google.fr/intl/fr_fr/images/logo.gif\" border=\"0\" alt=\"\" /></a><br />");

$faq[] = array("--", "Divers");
$faq[] = array("Puis-je ajouter mes propres balises ?", "Non, vous ne pouvez pas directement faire cela avec phpBB2. Cependant, la troisième version de notre logiciel inclue cette fonctionnalité. Vous pouvez télécharger phpBB3 sur <a href=\"http://www.phpbb.fr/\" target=\"_blank\">notre communauté francophone</a> et convertir votre forum actuel afin de bénéficier de tous ses avantages !");

//
// This ends the BBCode guide entries
//

?>
