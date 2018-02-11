<?php
/***************************************************************************
 *                         lang_bbcode.php [italian]
 *                            -------------------
 *   begin                : Wednesday Oct 3, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_bbcode.php,v 1.3.2.2 2002/12/18 15:40:20 psotfx Exp $
 *
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

/* CONTRIBUTORS
	2005-03-15	phpBB.it (info@phpbb.it)
		Fixed many minor grammatical mistakes
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
  
$faq[] = array("--","Introduzione");
$faq[] = array("Cos'è il BBCode?", "BBCode è un ampliamento speciale del codice HTML. L'uso del BBCode nei tuoi messaggi è determinato dall'amministratore. Inoltre puoi disabilitare il BBCode in ogni messaggio attraverso il modulo di invio. Il BBCode ha uno stile simile all'HTML, i tag sono racchiusi in parentesi quadre [ e ] piuttosto che in &lt; e &gt; e offre grande controllo su cosa e come vogliamo mostrare il messaggio. La facilità di utilizzo del BBCode nei tuoi messaggi dipende dal modello che stai utilizzando. Per ogni problema puoi far riferimento a questa guida.");

$faq[] = array("--","Formattazione del Testo");
$faq[] = array("Come creare il testo in grassetto, sottolineato o corsivo", "Il BBCode include dei tag per permetterti di cambiare velocemente lo stile di base del tuo testo. Questo avviene nel seguente modo: <ul><li>Per il testo in grassetto usa <span class='thick'>[b][/b]</span>, es. <br /><br /><span class='thick'>[b]</span>Ciao<span class='thick'>[/b]</span><br /><br >diventerà <span class='thick'>Ciao</span></li><li>Per il testo sottolineato usa<span class='thick'>[u][/u]</span>, es.:<br /><br /><span class='thick'>[u]</span>Buon Giorno<span class='thick'>[/u]</span><br /><br />diventa <span class='underline'>Buon Giorno</span></li><li>Per il testo in corsivo usa<span class='thick'>[i][/i]</span>, es.<br /><br >Questo è <span class='thick'>[i]</span>Grande!<span class='thick'>[/i]</span><br /><br />diventa Questo è <span class='italic'>Grande!</span></li></ul>");
$faq[] = array("How to change the text colour or size", "To alter the color or size of your text the following tags can be used. Keep in mind that how the output appears will depend on the viewers browser and system: <ul><li>Changing the colour of text is achieved by wrapping it in <span class='thick'>[color=][/color]</span>. You can specify either a recognised colour name (eg. red, blue, yellow, etc.) or the hexadecimal triplet alternative, eg. #FFFFFF, #000000. For example, to create red text you could use:<br /><br /><span class='thick'>[color=red]</span>Hello!<span class='thick'>[/color]</span><br /><br />or<br /><br /><span class='thick'>[color=#FF0000]</span>Hello!<span class='thick'>[/color]</span><br /><br />will both output <span style=\"color:red\">Hello!</span></li><li>Changing the text size is achieved in a similar way using <span class='thick'>[size=][/size]</span>. This tag is dependent on the template you are using but the recommended format is a numerical value representing the text size in pixels, starting at 1 (so tiny you will not see it) through to 29 (very large). For example:<br /><br /><span class='thick'>[size=9]</span>SMALL<span class='thick'>[/size]</span><br /><br />will generally be <span style=\"font-size:9px\">SMALL</span><br /><br />whereas:<br /><br /><span class='thick'>[size=24]</span>HUGE!<span class='thick'>[/size]</span><br /><br />will be <span style=\"font-size:24px\">HUGE!</span></li></ul>");
$faq[] = array("Can I combine formatting tags?", "Yes, of course you can; for example to get someones attention you may write:<br /><br /><span class='thick'>[size=18][color=red][b]</span>LOOK AT ME!<span class='thick'>[/b][/color][/size]</span><br /><br />this would output <span style=\"color:red;font-size:18px\"><span class='thick'>LOOK AT ME!</span></span><br /><br />We don't recommend you output lots of text that looks like this, though! Remember that it is up to you, the poster, to ensure that tags are closed correctly. For example, the following is incorrect:<br /><br /><span class='thick'>[b][u]</span>This is wrong<span class='thick'>[/b][/u]</span>");

$faq[] = array("--","Citazioni e testo a larghezza fissa");
$faq[] = array("Citazioni di testo nelle risposte", "Ci sono due modi per fare una citazione, con un referente o senza.<ul><li>Quando utilizzi la funzione Citazione per rispondere ad un messaggio sul forum devi notare che il testo del messaggio viene incluso nella finestra del messaggio tra <span class='thick'>[quote=\"\"][/quote]</span>. Questo metodo ti permette di fare una citazione riferendoti ad una persona o qualsiasi altra cosa che hai deciso di inserire! Per esempio, per citare un pezzo di testo di Mr. Blobby devi inserire:<br /><br /><span class='thick'>[quote=\"Mr. Blobby\"]</span>Il testo di Mr. Blobby andrà qui<span class='thick'>[/quote]</span><br /><br />Nel messaggio verrà automaticamente aggiunto, Mr. Blobby ha scritto: prima del testo citato. Ricorda che tu <span class='thick'>devi</span> includere le parentesi \"\" attorno al nome che stai citando, non sono opzionali.</li><li>Il secondo metodo ti permette di citare qualcosa alla cieca. Per utilizzare questo metodo, racchiudi il testo tra i tags <span class='thick'>[quote][/quote]</span>. Quando vedrai il messaggio comparirà semplicemente, Citazione: prima del testo stesso.</li></ul>");
$faq[] = array("Mostrare il codice", "Se vuoi mostrare un pezzo di codice o qualcosa che ha bisogno di una larghezza fissa, es. Courier devi racchiudere il testo tra i tags <span class='thick'>[code][/code]</span>, es.<br /><br /><span class='thick'>[code]</span>echo \"Questo è un codice\";<span class='thick'>[/code]</span><br /><br />Tutta la formattazione utilizzata tra i tags <span class='thick'>[code][/code]</span> viene mantenuta quando viene visualizzata in seguito.");

$faq[] = array("--","Creazione di liste");
$faq[] = array("Creare una lista non ordinata", "BBCode supporta due tipi di liste, ordinate e non. Sono essenzialmente la stessa cosa del loro equivalente in HTML. Una lista non ordinata mostra ogni oggetto nella tua lista in modo sequenziale, uno dopo l'altro inserendo un punto per ogni riga. Per creare una lista non ordinata usa <span class='thick'>[list][/list]</span> e definisci ogni oggetto nella lista usando <span class='thick'>[*]</span>. Per esempio per fare una lista dei tuoi colori preferiti puoi usare:<br /><br /><span class='thick'>[list]</span><br /><span class='thick'>[*]</span>Rosso<br /><span class='thick'>[*]</span>Blu<br /><span class='thick'>[*]</span>Giallo<br /><span class='thick'>[/list]</span><br /><br />Questo mostrerà questa lista:<ul><li>Rosso</li><li>Blu</li><li>Giallo</li></ul>");
$faq[] = array("Creare una lista ordinata", "Una lista ordinata ti permette di controllare il modo in cui ogni oggetto della lista viene mostrato. Per creare una lista ordinata usa <span class='thick'>[list=1][/list]</span> per creare una lista numerata o alternativamente <span class='thick'>[list=a][/list]</span> per una lista alfabetica. Come per la lista non ordinata gli oggetti vengono specificati utilizzando <span class='thick'>[*]</span>. Per esempio:<br /><br /><span class='thick'>[list=1]</span><br /><span class='thick'>[*]</span>Vai al negozio<br /><span class='thick'>[*]</span>Compra un novo computer<br /><span class='thick'>[*]</span>Impreca sul computer quando si blocca<br /><span class='thick'>[/list]</span><br /><br />verrà mostrato così:<ol type=\"1\"><li>Vai al negozio</li><li>Compra un nuovo computer</li><li>Impreca sul computer quando si blocca</li></ol>mentre per una lista alfabetica devi usare:<br /><br /><span class='thick'>[list=a]</span><br /><span class='thick'>[*]</span>La prima risposta possibile<br /><span class='thick'>[*]</span>La seconda risposta possibile<br /><span class='thick'>[*]</span>La terza risposta possibile<br /><span class='thick'>[/list]</span><br /><br />sarà<ol type=\"a\"><li>La prima risposta possibile</li><li>La seconda risposta possibile</li><li>La terza risposta possibile</li></ol>");

$faq[] = array("--", "Creare Links");
$faq[] = array("Linkare un altro sito", "Il BBCode di phpBB supporta diversi modi per creare URI, Uniform Resource Indicators meglio conosciuti come URL.<ul><li>Il primo di questi utilizza il tag <span class='thick'>[url=][/url]</span>, qualunque cosa digiti dopo il segno = genererà il contenuto del tag che si comporterà come URL. Per esempio per linkarsi a phpBB.com devi usare:<br /><br /><span class='thick'>[url=http://www.phpbb.com/]</span>Visita phpBB!<span class='thick'>[/url]</span><br /><br />Questo genera il seguente link, <a href=\"http://www.phpbb.com/\" target=\"_blank\">Visita phpBB!</a> Come puoi vedere il link si apre in una nuova finestra così l'utente può continuare a navigare nei forum.</li><li>Se vuoi che l'URL stesso venga mostrato come link puoi fare questo semplicemente usando:<br /><br /><span class='thick'>[url]</span>http://www.phpbb.com/<span class='thick'>[/url]</span><br /><br />Questo genera il seguente link, <a href=\"http://www.phpbb.com/\" target=\"_blank\">http://www.phpbb.com/</a></li><li>Inoltre phpBB dispone di una cosa chiamata <span class='italic'>Magic Links</span>, questo cambierà ogni URL sintatticamente corretta in un link senza la necessità di specificare nessun tag o http://. Per esempio digitando www.phpbb.com nel tuo messaggio automaticamente verrà cambiato in <a href=\"http://www.phpbb.com/\" target=\"_blank\">www.phpbb.com</a> e verrà mostrato nel messaggio finale.</li><li>La stessa cosa accade per gli indirizzi email, puoi specificare un indirizzo esplicitamente, per esempio:<br /><br /><span class='thick'>[email]</span>no.one@domain.adr<span class='thick'>[/email]</span><br /><br />che mostrerà <a href=\"emailto:no.one@domain.adr\">no.one@domain.adr</a> o puoi digitare no.one@domain.adr nel tuo messaggio e verrà automaticamente convertito.</li></ul>Come per tutti i tag del BBCode puoi includere le URL in ogni altro tag come <span class='thick'>[img][/img]</span> (guarda il successivo punto), <span class='thick'>[b][/b]</span>, ecc. Come per i tag di formattazione dipende da te verificare che tutti i tag siano correttamente aperti e chiusi, per esempio:<br /><br /><span class='thick'>[url=http://www.phpbb.com/][img]</span>http://www.phpbb.com/images/phplogo.gif<span class='thick'>[/url][/img]</span><br /><br /> <span class='underline'>non</span> è corretto e potrebbe cancellare il tuo messaggio. Quindi presta attenzione. ");

$faq[] = array("--", "Mostrare immagini nei messaggi");
$faq[] = array("Aggiungere una immagine al messaggio", "Il BBCode di phpBB incorpora un tag per l'inclusione di immagini nei tuoi messaggi. Ci sono due cose importanti da ricordare nell'usare questo tag; a molti utenti non piacciono molte immagini nei messaggi e in secondo luogo l'immagine deve essere già disponibile su internet (non può esistere solo sul tuo computer per esempio, a meno che tu non abbia un webserver!). Non c'è modo di salvare le immagini localmente con phpBB (forse nella prossima release di phpBB). Per mostrare delle immagini devi inserire l'URL che rimanda all'immagine con il tag <span class='thick'>[img][/img]</span>. Per esempio:<br /><br /><span class='thick'>[img]</span>http://www.phpbb.com/images/phplogo.gif<span class='thick'>[/img]</span><br /><br />Puoi inserire un'immagine nel tag <span class='thick'>[url][/url]</span> se vuoi, es.<br /><br /><span class='thick'>[url=http://www.phpbb.com/][img]</span>http://www.phpbb.com/images/phplogo.gif<span class='thick'>[/img][/url]</span><br /><br />genera:<br /><br /><a href=\"http://www.phpbb.com/\" target=\"_blank\"><img src=\"templates/subSilver/images/logo_phpBB_med.gif\" border=\"0\" alt=\"\" /></a><br />");

$faq[] = array("--", "Altro");
$faq[] = array("Posso aggiungere i miei tag personali?", "No, non direttamente in phpBB 2.0. Stiamo cercando di rendere i tag del BBCode più versatili per la prossima versione");

//
// This ends the BBCode guide entries
//

?>