<?php
// **************************************************************
// File: functions.php
// Purpose: Contains functions used by Spambot Search Tool
// Author: MysteryFCM
//	   Contains modifications and bug fixes with thanks to  Dan McCormick.
//
//		http://www.cedit.biz/joomla-extensions/18-registration-validator/22-block-disposable-email-addresses
//
// Support: http://mysteryfcm.co.uk/?mode=Contact
//	    http://forum.hosts-file.net/viewforum.php?f=68
//	    http://www.temerc.com/forums/viewforum.php?f=71
// Last modified: 22-02-2011
// nukeSPAM modifications: 04-Dec-2011
//  - moved function checkSpambots from check_spammers.php to functions.php
//  - moved config.php to functions, modified to retrieve from nuke_seo_config table
//  - moved language definitions to modules/nukeSPAM/language/lang-xxxxx.php, where xxxxx = language (e.g. English)
//  - renamed $name variable to $username
//  - changed SQL database interaction to use standard RavenNuke functions
//  - added batchMatch option 2|3 to check identify as spam if either IP or email address is listed
// **************************************************************

function checkSpambots($mail,$ip,$username){
	global $db, $prefix, $name, $nukeSPAMrequest;
	if ($name != 'nukeSPAM') seoGetLang('nukeSPAM');
	$seo_config = seoGetConfigs('nukeSPAM');
	// Check which databases?

	// fSpamlist API Key (Required if you wish to submit data to fspamlist.com)
	$bCheckFSL = true;
	if($seo_config['usefSpamList'] == '0') $bCheckFSL = FALSE;
	$sFSLAPI = $seo_config['keyfSpamList'];
	$blnSubmitToFSL = FALSE; // Not currently permitted for public use, here as a place holder for when it returns.

	// StopForumSpam API Key (Required if you wish to submit data to stopforumspam.com)
	$sSFSAPI = $seo_config['keyStopForumSpam'];
	$bCheckSFS = true;
	if($seo_config['useStopForumSpam'] == '0') $bCheckSFS = FALSE;

	// BotScout API Key (Required if you wish to query botscout.com - they allow limited queries without it)
	$sBSAPI = $seo_config['keyBotScout'];
	if($seo_config['useBotScout'] == '0') $sBSAPI = '';

	// Do we want to check the DNS blacklists?
	$sCheckDNSBL = '';
	if($seo_config['useDNSBL'] == '0') $sCheckDNSBL = '0';

	// Drone.abuse.ch
	$sNoCheckDroneACH = '';
	if($seo_config['useDroneACH'] == '0') $sNoCheckDroneACH = '0';

	// HTTPBL.abuse.ch
	$sNoCheckHTTPBLACH = '';
	if($seo_config['useHTTPBLACH'] == '0') $sNoCheckHTTPBLACH = '0';

	// spam.abuse.ch
	$sNoCheckSpamACH = '';
	if($seo_config['useSpamACH'] == '0') $sNoCheckSpamACH = '0';

	// ZeusTracker.abuse.ch
	$sNoCheckZeusACH = '';
	if($seo_config['useZeusACH'] == '0') $sNoCheckZeusACH = '0';

	// AHBL
	$sNoCheckAHBL = '';
	if($seo_config['useAHBL'] == '0') $sNoCheckAHBL = '0';
	
	// Blocklist.de
	$sNoCheckBLDE = '';
	if($seo_config['useBLDE'] == '0') $sNoCheckBLDE = '0';

	// Project Honey Pot API Key (Required if you wish to query Projecthoneypot.org)
	$sPHPAPI = $seo_config['keyProjectHoneyPot'];
	$sNoCheckPHP = '';
	if($seo_config['useProjectHoneyPot'] == '0') $sNoCheckPHP = '0';

	// Sorbs
	$sNoCheckSorbs = '';
	if($seo_config['useSorbs'] == '0') $sNoCheckSorbs = '0';

	// SpamHaus
	$sNoCheckSpamHaus = ''; 
	if($seo_config['useSpamHaus'] == '0') $sNoCheckSpamHaus = '0';

	// SpamCop
	$sNoCheckSpamCop = '';
	if($seo_config['useSpamCop'] == '0') $sNoCheckSpamCop = '0';

	// DroneBL
	$sNoCheckDrone = '';
	if($seo_config['useDroneBL'] == '0') $sNoCheckDrone = '0';

	// Tornevall.org
	$sNoCheckTVO = '';
	if($seo_config['useTornevall'] == '0') $sNoCheckTVO = '0';

	// EFNet
	$sNoCheckEFN = ''; // 
	if($seo_config['useEFNet'] == '0') $sNoCheckEFN = '0';

	// Tor
	$sNoCheckTor = '';
	if($seo_config['useTor'] == '0') $sNoCheckTor = '0';

	// Should we fail and return true, if an invalid e-mail address is detected? No: already done by RN
	$bFailOnInvalidEmail = FALSE;

	// Do you want it to create a text file with the results?
	$bln_SaveToFile = FALSE;
	$sSaveTo = dirname(__FILE__).'/spambots/';
	$savetofolder=$sSaveTo;

	// Do you want it to log results to a database?
	$bln_SaveToDB	= $seo_config['logToDB'];
	// Insert database/host details here  Note: The default MySQLport is 3306. If your MySQL server is NOT running on this port, you will need to change it.
	$dbShost	= 'localhost:3306';
	$dbSname	= 'sbst';
	$dbSusername	= '';
	$dbSpassword	= '';

	// What should we base a match on? (APPLIES TO CHECK_SPAMMERS_PLAIN.PHP ONLY)
	//
	//	1 = Name
	//	2 = IP
	//	3 = Email
	//
	//	****************
	//	SUPPORTED VALUES
	//	****************
	//  '' = Return true if any one of the 3 variables are listed 
	//	2,3 = Only return true if both IP and e-mail are listed
	//	1,2 = Only return true if both Username and IP are listed
	//	1,3 = Only return true if both Username and e-mail are listed
	//	1,2|1,3 = Only return true if both Username and IP are listed OR username and Email are listed
	//	1,2|1,3|2,3 = Only return true if both Username and IP are listed OR username and Email are listed OR IP and Email are listed
	//	1,2|2,3 = Only return true if both Username and IP are listed OR IP and Email are listed
	//	1,3|2,3 = Only return true if both Username and Email are listed OR IP and Email are listed
	//	1,2,3 = Only return true if all 3 are listed
	//
	//	IMPORTANT: This should NEVER be set to match based on username only as this leaves it wide open to false positives.
	//
	//	You can of course, ask it to match on multiple cases, for example;
	//	$BaseMatch = "1,2|2,3";
	//
	//	If doing this, you MUST ensure they are listed in order of the case switches (see check_spammers_plain.php), for example;
	//	$BaseMatch = "1,2|1,3"; (match Username and IP OR username and Email)
	//
	$BaseMatch = $seo_config['baseMatch'];
	$spamDebug = $seo_config['debug'];
	if (defined('_OVERRIDE_DEBUG_ON')) $spamDebug = '1';

	// E-mail (If you want to view reports sent to you via e-mail)
	$sMail='';
	$sMailPW='';
	$sMailServer='{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';

	// Some vars used ..... we need to set these to false to begin with
	$ahblspambot =			false; // AHBL (Abusive Hosts Blacklist)
	$sdronespambot =		false; // DroneBL
	$scopspambot =			false; // Spamcop
	$sphpspambot =			false; $sVisitorType = ''; // Project Honey Pot
	$sorbsspambot =			false; // Sorbs
	$spamhausspambot =		false; $sSHDB = ''; // Spamhaus
	$sfsspambot =			false; // StopForumSpam
	$fslspambot =			false; // fSpamlist
	$bsspambot =			false; // BotScout
	$stvospambot = 			false; // dnsbl.tornevall.org
	$sefnetspambot =		false; // efnetrbl.org
	$sTorspambot = 			false; // Tor
	$httpblachspambot =		false; // HTTPBL.abuse.ch
	$droneachspambot =		false; // Drone.abuse.ch
	$spamachspambot =		false; // spam.abuse.ch
	$zeusachspambot =		false; // ZeusTracker (abuse.ch)
	$sBLDEspambot =			false; // Blocklist.de

	$spambot = false;

	// Ensure there are no spaces in the vars
	$username = str_replace(" ","%20",$username);
	$mail = str_replace(" ","%20",$mail);

	// Lowercase it
	$username=strtolower($username);
	$mail=strtolower($mail);

	$bXMLAvailable = false;
	if(phpversion() > "5"){
		if(class_exists('SimpleXMLElement') == true){
			$bXMLAvailable = true;
		}
	}

	$bFoundMatch = false;

	// Are we saving to database?
	if($bln_SaveToDB==true){
		// If it's already in our database, no need to check further .....
		$sSDBRet = IsSpammerInDB($dbShost, $dbSname, $dbSusername, $dbSpassword, $username, $ip, $mail);
		if($sSDBRet==true){
			if ($spamDebug) echo _SPAM_DBMATCH;
			// added for nukeSPAM to increase count
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'N/A', $username, $ip, $mail);}  
			$spambot=true;
			$bFoundMatch=true;
		} // End if($sSDBRet==true)
	} // End if($bln_SaveToDB==true)

	// *********************************************************************************
	// BEGIN CHECK FSPAMLIST
	// *********************************************************************************
	//
	// No point checking if the user has told us not to, or a match has already been found
	$fspamcheck='';
	if(!$sFSLAPI==''){
		if($bCheckFSL ==true && $bFoundMatch==false){
			//if($mail==''){$mail='nobody@example.com';}
			//if($username==''){$username='no_name_given';}
			//if($ip==''){$ip='1.2.3.4';}

			$sFSLURL='http://www.fspamlist.com/xml.php?key='.$sFSLAPI.'&spammer='.$mail.','.$ip.','.$username;
			if ($spamDebug) echo $sFSLURL . '<br />';

			$fspamcheck = getURL($sFSLURL); $fspamcheck = strtolower($fspamcheck);
			if($spamDebug){echo 'DEBUG: '.htmlentities($fspamcheck, ENT_QUOTES).'<br />';}
			$fspamcheck = str_replace('\r', '', str_replace('\n', '', $fspamcheck)); $fspamcheck = str_replace(chr(10), '', str_replace(chr(13), '', $fspamcheck));
			if($fspamcheck=='unable to connect to server' && $spamDebug){echo _SPAM_ERR_FSL_CONNECT.'[ '.$sFSLURL.' ]<br />';}

			// Let's see if we can figure out where those sporadic empty results and Bad Request errors are coming from
			if(substr_count($fspamcheck, "Bad Request") > 0 || $fspamcheck==''){
				if ($spamDebug) echo _SPAM_ERR_FSL_EMPTY.'<br />';
			}

			if (substr_count($fspamcheck, 'true') > 0) {
				// Needs to be handled a little differently so we can determine which one's have matched
				// due to the new FSL API.
				$bUsername = $bIP = $bMail = 'False';
				$email = str_replace('%40', '@', $mail);
				if($bXMLAvailable){
					$sfsxml = new SimpleXMLElement($fspamcheck);
					for ($i = 0; $i <= 2; $i++) {
						echo $i.' '. $sfsxml->spammercheck[$i]->spammer. ' '. $sfsxml->spammercheck[$i]->isspammer . '<br />';
						if (($sfsxml->spammercheck[$i]->spammer == $email) and ($sfsxml->spammercheck[$i]->isspammer == 'true')) $bMail='True';
						if ($sfsxml->spammercheck[$i]->spammer == $ip and $sfsxml->spammercheck[$i]->isspammer == 'true') $bIP='True';
						if ($sfsxml->spammercheck[$i]->spammer == $username and $sfsxml->spammercheck[$i]->isspammer === 'true') $bUsername='True';
					}
				} else {
					if(strpos($fspamcheck, $email.'</spammer><isspammer>true')==true) $bMail = 'True';
					if(strpos($fspamcheck, $ip.'</spammer><isspammer>true')==true) $bIP = 'True';
					if(strpos($fspamcheck, $username.'</spammer><isspammer>true')==true) $bUsername = 'True';
				}
				switch($BaseMatch){
					case "2|3": // Match IP or E-mail
						if($bIP == 'True' || $bMail == 'True'){$bFoundMatch = true;}
						break;
					case "1,2": // Match username and IP
						if($bUsername == 'True' && $bIP == 'True'){$bFoundMatch = true;}
						break;
					case "1,3": // Match username and E-mail
						if($bUsername == 'True' && $bMail == 'True'){$bFoundMatch = true;}
						break;
					case "2,3": // Match IP and E-mail
						if($bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
						break;
					case "1,2|1,3": // Match username and IP OR username + E-mail
						if($bUsername == 'True' && $bIP == 'True' || $bUsername == 'True' && $bMail == 'True'){$bFoundMatch = true;}
						break;
					case "1,2|1,3|2,3": // Match username and IP OR username + E-mail OR IP + E-mail
						if($bUsername == 'True' && $bIP == 'True' || $bUsername == 'True' && $bMail == 'True' || $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
						break;
					case "1,2|2,3": // Match username and IP OR IP + E-mail
						if($bUsername == 'True' && $bIP == 'True' || $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
						break;
					case "1,3|2,3": // Match username and Email OR IP + E-mail
						if($bUsername == 'True' && $bMail == 'True' || $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
						break;
					case "1,2,3": // Match Username, IP and E-mail
						if($bUsername == 'True' && $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
						break;
					default:
						// We don't match based solely on usernames alone
						if($bMail=='True' || $bIP=='True' || ($bUsername=='True' && $bMail=='True') || ($bUsername=='True' && $bIP=='True') || ($bIP=='True') || ($bMail=='True')){$bFoundMatch = true; break;}
				}
			} // End if(strpos($fspamcheck
			if($bFoundMatch==true){
				$fslspambot = true;
				$spambot = true; // Required seperately now that dumping to a text file is optional
				if ($spamDebug) echo _SPAM_FSL.'<br />';
			}else{
				$fslspambot = false;
			} // End if($bFoundMatch==true)

		} // End if($bCheckFSL ...

	} // End if(!$sFSLAPI .....
	// *********************************************************************************
	// END CHECK FSPAMLIST
	// *********************************************************************************

	// *********************************************************************************
	// BEGIN CHECK STOPFORUMSPAM
	// *********************************************************************************
	//
	// Reset vars to default
	$fspamcheck =''; $bSFSLimit=false;
	// No point checking if the user has told us not to, or a match has already been found
	if($bCheckSFS && !$bFoundMatch){
		$fspamcheck = getURL('http://www.stopforumspam.com/api?email='.$mail.'&ip='.$ip.'&username='.$username);
		if ($spamDebug) echo $fspamcheck.'<br />';

		// Let's see if we can figure out where those sporadic empty results and Bad Request errors are coming from
		if(substr_count($fspamcheck, "Bad Request") > 0 || $fspamcheck==''){
			if ($spamDebug) echo _SPAMSFS_EMPTY . '<br />';
		}

		$bSFSLimit = strpos($fspamcheck, 'rate limit exceeded');
		if($bSFSLimit == true){
			// Added due to SFS introducing a query limit
			//
			// http://www.stopforumspam.com/forum/t573-Rate-Limiting
			//
			$bSFSLimit=true;
		}else{
			if($bXMLAvailable && substr_count($fspamcheck, '<') > 0){
				$sfsxml = new SimpleXMLElement($fspamcheck);
				$bUsername = $bIP = $bMail = 'False';
				for ($i = 0; $i <= 3; $i++) {
					if($sfsxml->type[$i] == 'username' and $sfsxml->appears[$i] == 'yes') $bUsername='True';
					if($sfsxml->type[$i] == 'ip' and $sfsxml->appears[$i] == 'yes') $bIP='True';
					if($sfsxml->type[$i] == 'email' and $sfsxml->appears[$i] == 'yes') $bMail='True';
				}
			}else{
				if (substr_count($fspamcheck, 'yes') > 0) {
					if (strpos($fspamcheck, 'username yes') === true){$bUsername='True';}else{$bUsername='False';}
					if (strpos($fspamcheck, 'ip yes')=== true){$bIP='True';}else{$bIP='False';}
					if (strpos($fspamcheck, 'email yes') === true ){$bMail='True';}else{$bMail='False';}
				} // END if (strpos($fspamcheck, 'yes') !=False)
			} // END if($bXMLAvailable == True && strpos($fspamcheck, '<') == True)
			if ($spamDebug) {
				echo 'SFS username: '.$bUsername.'<br />';
				echo 'SFS email: '.$bMail.'<br />';
				echo 'SFS ip: '.$bIP.'<br />';
			}
			switch($BaseMatch){
				case "1,2": // Match username and IP
					if($bUsername == 'True' && $bIP == 'True'){$bFoundMatch = true;}
					break;
				case "1,3": // Match username and E-mail
					if($bUsername == 'True' && $bMail == 'True'){$bFoundMatch = true;}
					break;
				case "2,3": // Match IP and E-mail
					if($bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
					break;
				case "1,2|1,3": // Match username and IP OR username + E-mail
					if($bUsername == 'True' && $bIP == 'True' || $bUsername == 'True' && $bMail == 'True'){$bFoundMatch = true;}
					break;
				case "1,2|1,3|2,3": // Match username and IP OR username + E-mail OR IP + E-mail
					if($bUsername == 'True' && $bIP == 'True' || $bUsername == 'True' && $bMail == 'True' || $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
					break;
				case "1,2|2,3": // Match username and IP OR IP + E-mail
					if($bUsername == 'True' && $bIP == 'True' || $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
					break;
				case "1,3|2,3": // Match username and Email OR IP + E-mail
					if($bUsername == 'True' && $bMail == 'True' || $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
					break;
				case "1,2,3": // Match Username, IP and E-mail
					if($bUsername == 'True' && $bIP == 'True' && $bMail == 'True'){$bFoundMatch = true;}
					break;
				default:
					// We don't match based solely on username alone.
					if($bMail=='True' || $bIP=='True' || ($bUsername=='True' && $bMail=='True') || ($bUsername=='True' && $bIP=='True') || ($bIP=='True') || ($bMail=='True')){$bFoundMatch = true;}
					break;
			}

		} // END if(strpos($fspamcheck, 'rate limit exceeded') ==True )

		if($bFoundMatch==true){
			$sfsspambot = true;
			$spambot = true; // Required seperately now that dumping to a text file is optional
			if ($spamDebug) echo _SPAM_SFS . '<br />';
		}else{
			$sfsspambot = false;
			if($bSFSLimit==true){
				if ($spamDebug) echo _SPAM_SFS_LIMITEXCEEDED . '<br />';
			}
		} // End if($bFoundMatch==true)
	}
	// *********************************************************************************
	// END CHECK STOPFORUMSPAM
	// *********************************************************************************

	// *********************************************************************************
	// BEGIN CHECK BOTSCOUT
	// *********************************************************************************
	//
	// Check the username etc against BotScout. Done using a single query for efficiency
	// as we don't need multiple queries for the plain version.
	//
	// If any of the values are missing, BotScout will ignore them (better for us as it
	// prevents us having to deal with them, which thus prevents spammers potentially
	// abusing it)
	//
	// No point checking if the user has told us not to, or a match has already been found
	if($sBSAPI !='' && $bFoundMatch==false){
		$sBSMail = $mail;
		$sBSIP = $ip;
		$sBSName = $username;
		$sBSURL = 'http://botscout.com/test/?multi&key='.$sBSAPI.'&mail='.$sBSMail.'&ip='.$sBSIP.'&name='.$sBSName;
		if ($spamDebug) echo $sBSURL.'<br />';
		$fspamcheck = getURL($sBSURL);

		// Let's see if we can figure out where those sporadic empty results and Bad Request errors are coming from
		if(substr_count($fspamcheck, "Bad Request") > 0 || $fspamcheck==''){
			if ($spamDebug) echo _SPAM_BS_EMPTY . '<br />';
		}

		// BotScout error codes begin with an apostrophe, so we'll check for those first
		if (substr_count($fspamcheck, '! ') > 0) {
			if ($spamDebug) echo _SPAM_ERROR.$fspamcheck . '<br />';
		}else{

			// $sSpamData[3] = IP
			// $sSpamData[5] = Email
			// $sSpamData[7] = Username
			if($spamDebug){echo _SPAM_SENT.htmlentities($sBSURL, ENT_QUOTES)._SPAM_RECEIVED.htmlentities($fspamcheck, ENT_QUOTES).'<br />';}
			$sSpamData = explode('|',$fspamcheck);
			if($sSpamData[0] == 'Y'){
				switch($BaseMatch){
					case "1,2": // Match username and IP
						if($sSpamData[7] > 0 && $sSpamData[3] > 0){$bFoundMatch = true;}
						break;
					case "1,3": // Match username and E-mail
						if($sSpamData[7] > 0 && $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
					case "2,3": // Match IP and E-mail
						if($sSpamData[3] > 0 && $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
					case "1,2|1,3": // Match username and IP OR username + E-mail
						if($sSpamData[7] > 0 && $sSpamData[3] > 0 || $sSpamData[7] > 0 && $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
					case "1,2|1,3|2,3": // Match username and IP OR username + E-mail OR IP + E-mail
						if($sSpamData[7] > 0 && $sSpamData[3] > 0 || $sSpamData[7] > 0 && $sSpamData[5] > 0 || $sSpamData[3] > 0 && $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
					case "1,2|2,3": // Match username and IP OR IP + E-mail
						if($sSpamData[7] > 0 && $sSpamData[3] > 0 || $sSpamData[3] > 0 && $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
					case "1,3|2,3": // Match username and Email OR IP + E-mail
						if($sSpamData[7] > 0 && $sSpamData[5] > 0 || $sSpamData[3] > 0 && $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
					case "1,2,3": // Match Username, IP and E-mail
						if($sSpamData[7] > 0 && $sSpamData[3] > 0 && $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
					default:
						if($sSpamData[3] > 0 || $sSpamData[5] > 0){$bFoundMatch = true;}
						break;
				}
			}

		} // End if (strpos($fspamcheck, '! ') !=False)

		if($bFoundMatch==true){
			$bsspambot = true;
			$spambot = true; // Required seperately now that dumping to a text file is optional
			if ($spamDebug) echo ' ' . _SPAM_BS . '<br />';
		}else{
			$bsspambot = false;
		} // End if($bFoundMatch==true)

	} // End If ($sBSAPI !='')

	// *********************************************************************************
	// END CHECK BOTSCOUT
	// *********************************************************************************

	// *********************************************************************************
	// BEGIN CHECK DNSBL
	// *********************************************************************************
	// No point checking if the user has told us not to, the IP isn't present, or a match has already been found
	if ($ip !='' && $sCheckDNSBL =='' && $bFoundMatch==false){
		$address = $ip;
		$rev = implode('.',array_reverse(explode('.', $address)));

		//
		// Check the IP against drone.abuse.ch
		//
		// Response 127.0.0.2: "Spam related FastFlux Bot"
		// IP addresses with this response code are part of a spam related FastFlux botnet (e.g My Canadian Pharmacy, HerbalKing, etc).
		//
		// Response 127.0.0.3: "Malware related FastFlux Bot"
		// IP addresses with this response code are part of a malware related FastFlux botnet (e.g. Warezov, Storm, etc).
		//
		// Response 127.0.0.4: "Phish related FastFlux Bot"
		// IP addresses with this response code are part of a phish related FastFlux botnet (mostly Rock phish botnet).
		//
		// Response 127.0.0.5: "Scam related FastFlux Bot"
		// IP addresses with this response code are part of a scam related FastFlux botnet (e.g. Money-Mule).

		if($sNoCheckDroneACH ==''){
			$lookup = $rev.'.drone.abuse.ch.';
			$sDACH = gethostbyname($lookup);
			if ($spamDebug) echo $lookup.'<br />';
			switch ($sDACH)
			{
				case "127.0.0.2":
					$droneachspambot = true;
					if ($spamDebug) echo 'DRONE (SPAM) abuse.ch<br />';
					break;
				case "127.0.0.3":
					$droneachspambot = true;
					if ($spamDebug) echo 'DRONE (MALWARE) abuse.ch<br />';
					break;
				case "127.0.0.4":
					$droneachspambot = true;
					if ($spamDebug) echo 'DRONE (PHISH) abuse.ch<br />';
					break;
				case "127.0.0.5":
					$droneachspambot = true;
					if ($spamDebug) echo 'DRONE (SCAM) abuse.ch<br />';
					break;
				default:
					$droneachspambot = false;
					break;
       			} // End if ($lookup != gethostbyname($lookup))
		}

		//
		// Check the IP against httpbl.abuse.ch
		//
		// Response 127.0.0.2: "Source of hacking activities"
		// IP addresses with this response code are source of hacking activities (mostly Script-Kiddies). They tried to access one or more PHPShells (eg. r57Shell, C99Shell or similar) which are installed on my honeypots (mostly they find these scripts thru a search engine like google). These PHPShells give an attacker the posibility to deface your webserver or install further malicious code.
		//
		// Response 127.0.0.3: "Hjacked webserver (source of RFI attacks)"
		// IP addresses with this response code are mostly hijacked systems or webservers. They are scanning the web for vulnerable webservers and try to inject malicious code using Remote File Inclusion (RFI attack). This scripts are often used for mass defacements or install further malicious scripts (eg. Shellbots for DDoS etc.)
		//
		// Response 127.0.0.4: "Referer Spam"
		// IP addresses with this response code are using referer spam to give websites a better ranking on search engines. They are just bothersome because they flood your webserver log and your webstatistic with crap.
		//
		// Response 127.0.0.5: "Automated scanning drone"
		// IP addresses with this response code are automated scanning drones (eg. drones which scanning the web for vulnerable web servers, open proxy scanners etc.)

		if($sNoCheckHTTPBLACH ==''){
			$lookup = $rev.'.httpbl.abuse.ch.';
			$sDACH = gethostbyname($lookup);
			if ($spamDebug) echo $lookup.'<br />';
			switch ($sDACH)
			{
				case "127.0.0.2":
					$httpblachspambot = true;
					if ($spamDebug) echo 'HTTPBL (HACKING) abuse.ch<br />';
					break;
				case "127.0.0.3":
					$httpblachspambot = true;
					if ($spamDebug) echo 'HTTPBL (HIJACKED_SERVER) abuse.ch<br />';
					break;
				case "127.0.0.4":
					$httpblachspambot = true;
					if ($spamDebug) echo 'HTTPBL (REFERER_SPAM) abuse.ch<br />';
					break;
				case "127.0.0.5":
					$httpblachspambot = true;
					if ($spamDebug) echo 'HTTPBL (AUTO_SCAN_DRONE) abuse.ch<br />';
					break;
				default:
					$httpblachspambot = false;
					break;
       			} // End if ($lookup != gethostbyname($lookup))
		}


		//
		// Check the IP against spam.abuse.ch
		//
		// Response 127.0.0.2: "Sends spam to spamtrap"
		//
		// Response 127.0.0.3: "Pushdo Spambot"
		//
		// Response 127.0.0.4: "Ozdok Spambot"

		if($sNoCheckSpamACH ==''){
			$lookup = $rev.'.spam.abuse.ch.';
			$sDACH = gethostbyname($lookup);
			if ($spamDebug) echo $lookup.'<br />';
			switch ($sDACH)
			{
				case "127.0.0.2":
					$spamachspambot = true;
					if ($spamDebug) echo 'SPAM abuse.ch ';
					break;
				case "127.0.0.3":
					$spamachspambot = true;
					if ($spamDebug) echo 'SPAM (Pushdo) abuse.ch ';
					break;
				case "127.0.0.4":
					$spamachspambot = true;
					if ($spamDebug) echo 'SPAM (Ozdok) abuse.ch ';
					break;
				default:
					$spamachspambot = false;
					break;
			} // End if ($lookup != gethostbyname($lookup))
		}

		//
		// Check the IP against zeustracker.abuse.ch
		//
		if($sNoCheckZeusACH ==''){
			$lookup = $rev.'.ipbl.zeustracker.abuse.ch.';
			$lookup = gethostbyname($lookup);
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup =='127.0.0.2')
			{
				$zeusachspambot = true;
				if ($spamDebug) echo 'ZEUS abuse.ch ';
			}else{
				$zeusachspambot = false;
			} // End if ($lookup != gethostbyname($lookup))
		}

		// ahbl returns codes based on which blacklist the IP is in;
		//
		// 127.0.0.2 - Open Relay
		// 127.0.0.3 - Open Proxy
		// 127.0.0.4 - Spam Source
		// 127.0.0.5 - Provisional Spam Source Listing block (will be removed if spam stops)
		// 127.0.0.6 - Formmail Spam
		// 127.0.0.7 - Spam Supporter
		// 127.0.0.8 - Spam Supporter (indirect)
		// 127.0.0.9 - End User (non mail system)
		// 127.0.0.10 - Shoot On Sight
		// 127.0.0.11 - Non-RFC Compliant (missing postmaster or abuse)
		// 127.0.0.12 - Does not properly handle 5xx errors
		// 127.0.0.13 - Other Non-RFC Compliant
		// 127.0.0.14 - Compromised System - DDoS
		// 127.0.0.15 - Compromised System - Relay
		// 127.0.0.16 - Compromised System - Autorooter/Scanner
		// 127.0.0.17 - Compromised System - Worm or mass mailing virus
		// 127.0.0.18 - Compromised System - Other virus
		// 127.0.0.19 - Open Proxy
		// 127.0.0.20 - Blog/Wiki/Comment Spammer
		// 127.0.0.127 - Other
		//
		if($sNoCheckAHBL==''){
			$lookup = $rev.'.dnsbl.ahbl.org.';
			$ahbltemp = gethostbyname($lookup);
			if ($spamDebug) echo $lookup.'<br />';
			switch ($ahbltemp) {
				case "127.0.0.2":
					$sVisitorType = "Open Relay"; $ahblspambot = true; break;
				case "127.0.0.3":
					$sVisitorType = "Open Proxy"; $ahblspambot = true; break;
				case "127.0.0.4":
					$sVisitorType = "Spam Source"; $ahblspambot = true; break;
				case "127.0.0.5":
					$sVisitorType = "Provisional Spam Source Listing block (will be removed if spam stops)"; $ahblspambot = true; break;
				case "127.0.0.6":
					$sVisitorType = "Formmail Spam"; $ahblspambot = true; break;
				case "127.0.0.7":
					$sVisitorType = "Spam Supporter"; $ahblspambot = true; break;
				case "127.0.0.8":
					$sVisitorType = "Spam Supporter (indirect)"; $ahblspambot = true; break;
				case "127.0.0.9": // We don't flag end user systems unless they're spammers or match one of the other criteria
					$sVisitorType = "End User (non mail system)"; $ahblspambot = false; break;
				case "127.0.0.10":
					$sVisitorType = "Shoot On Sight"; $ahblspambot = true; break;
				case "127.0.0.11": // I'd love to match these and force RFC compliance, but that's just me, so we don't flag these either
					$sVisitorType = "Non-RFC Compliant (missing postmaster or abuse)"; $ahblspambot = false; break;
				case "127.0.0.12": // Not handling errors properly does not a spammer/attacker make
					$sVisitorType = "Does not properly handle 5xx errors"; $ahblspambot = false; break;
				case "127.0.0.13": // Again, we don't flag those just because they aren't RFC compliant
					$sVisitorType = "Other Non-RFC Compliant"; $ahblspambot = false; break;
				case "127.0.0.14":
					$sVisitorType = "Compromised System - DDoS"; $ahblspambot = true; break;
				case "127.0.0.15":
					$sVisitorType = "Compromised System - Relay"; $ahblspambot = true; break;
				case "127.0.0.16":
					$sVisitorType = "Compromised System - Autorooter/Scanner"; $ahblspambot = true; break;
				case "127.0.0.17":
					$sVisitorType = "Compromised System - Worm or mass mailing virus"; $ahblspambot = true; break;
				case "127.0.0.18":
					$sVisitorType = "Compromised System - Other virus"; $ahblspambot = true; break;
				case "127.0.0.19":
					$sVisitorType = "Open Proxy"; $ahblspambot = true; break;
				case "127.0.0.20":
					$sVisitorType = "Blog/Wiki/Comment Spammer"; $ahblspambot = true; break;
				case "127.0.0.127":
					$sVisitorType = "Other"; $ahblspambot = true; break;
				default:
					$ahblspambot = false; break;
			} // End Switch
			// Do an echo if $ahblpambot = true
			if($ahblspambot == true){
				if ($spamDebug) echo 'AHBL ('.$ahbltemp.' - '.$sVisitorType.')<br />';
			} // End if($ahblspambot ....

		} // End if($sNoCheckAHBL ....

		//
		// Check the IP against blocklist.de
		//
		//	https://www.blocklist.de/en/api.html#dns
		//
		if($sNoCheckBLDE==''){
			$lookup = $rev.'.all.bl.blocklist.de';
			$sBLDETemp = gethostbyname($lookup);
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup !=$sBLDETemp)
			{
				switch($sBLDETemp){
					case "127.0.0.2":
						$sBLDE = "Amavis"; $sBLDEspambot = true;
						break;
					case "127.0.0.3":
						$sBLDE = "Apache ddos"; $sBLDEspambot = true;
						break;
					case "127.0.0.4":
						$sBLDE = "Asterisk"; $sBLDEspambot = true;
						break;
					case "127.0.0.5":
						$sBLDE = "Bad bots"; $sBLDEspambot = true;
						break;
					case "127.0.0.6":
						$sBLDE = "FTP attacks"; $sBLDEspambot = true;
						break;
					case "127.0.0.7":
						$sBLDE = "IMAP attacks"; $sBLDEspambot = true;
						break;
					case "127.0.0.8":
						$sBLDE = "IRC Bot"; $sBLDEspambot = true;
						break;
					case "127.0.0.9":
						$sBLDE = "Mail attacks"; $sBLDEspambot = true;
						break;
					case "127.0.0.10":
						$sBLDE = "POP3 attacks"; $sBLDEspambot = true;
						break;
					case "127.0.0.11":
						$sBLDE = "Regbot"; $sBLDEspambot = true;
						break;
					case "127.0.0.12":
						$sBLDE = "RFI attacks"; $sBLDEspambot = true;
						break;
					case "127.0.0.13":
						$sBLDE = "SASL"; $sBLDEspambot = true;
						break;
					case "127.0.0.14":
						$sBLDE = "SSH attacks"; $sBLDEspambot = true;
						break;
					case "127.0.0.15":
						$sBLDE = "w00tw00t"; $sBLDEspambot = true;
						break;
					case "127.0.0.16":
						$sBLDE = "Known portscanner"; $sBLDEspambot = true;
						break;
					default: $sBLDEspambot = false;
				}
				if($sBLDEspambot == true and $spamDebug) echo 'Blocklist.de (' . $sBLDE . ')<br />';
			}
		}

		//
		// Check the IP against DroneBL
		//
		if($sNoCheckDrone ==''){
			$lookup = $rev.'.dnsbl.dronebl.org.';
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup != gethostbyname($lookup))
			{
				$sdronespambot = true;
				if ($spamDebug) echo 'DroneBL<br />';
			} // End if ($lookup != gethostbyname($lookup))
		}

		//
		// Check the IP against efnetrbl.org
		//
		if($sNoCheckEFN==''){
			$lookup = $rev.'.rbl.efnetrbl.org.';
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup != gethostbyname($lookup))
			{
				$sefnetspambot = true;
				if ($spamDebug) echo 'EFNet< br />';
			}
		}

		//
		// Check the IP against projecthoneypot.org
		//
		if($sPHPAPI !='' && $sNoCheckPHP ==''){
			$lookup = $sPHPAPI.'.'.$rev.'.dnsbl.httpbl.org.';
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup != gethostbyname($lookup))
			{

				$sphpspambot = true;
				$sTempArr = explode('.',gethostbyname($lookup));
				if($sTempArr[0]=='127'){
					$sDays = $sTempArr[1];
					$sThreatScore = $sTempArr[2];
					$sVisitorType = $sTempArr[3]; // Let's see what PHP says about this IP
					switch ($sVisitorType) {
						case "0":
							$sVisitorType = "Search Engine";
							$sphpspambot = false;
							break;
						case "1":
							$sVisitorType = "Suspicious";
							$sphpspambot = false;
							break;
						case "2":
							$sVisitorType = "Harvester";
							$sphpspambot = true;
							break;
						case "3":
							$sVisitorType = "Suspicious &amp; Harvester";
							$sphpspambot = true;
							break;
						case "4":
							$sVisitorType = "Comment Spammer";
							$sphpspambot = true;
							break;
						case "5":
							$sVisitorType = "Suspicious &amp; Comment Spammer";
							$sphpspambot = true;
							break;
						case "6":
							$sVisitorType = "Harvester &amp; Comment Spammer";
							$sphpspambot = true;
							break;
						case "7":
							$sVisitorType = "Suspicious &amp; Harvester &amp; Comment Spammer";
							$sphpspambot = true;
							break;
					}
					// Do an echo if $sphpspambot = true
					if($sphpspambot == true){
						if ($spamDebug) echo 'ProjectHoneyPot ('.gethostbyname($lookup).' - '.$sVisitorType.')<br />';
					}
				}else{
					if ($spamDebug) echo _SPAM_ERROR.gethostbyname($lookup); $sphpspambot=false;
				}
			} // End if ($lookup != gethostbyname($lookup))
		} // End If

		//
		// Check the IP against Sorbs
		//
		//	http://www.au.sorbs.net/using.shtml
		//
		if($sNoCheckSorbs ==''){
			$lookup = $rev.'.l2.spews.dnsbl.sorbs.net.';
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup != gethostbyname($lookup))
			{
				$sorbsspambot = true;
				if ($spamDebug) echo 'Sorbs<br />';
			} // End if ($lookup != gethostbyname($lookup))
		}

		//
		// Check the IP against Sorbs
		//
		if($sNoCheckSorbs ==''){
			$lookup = $rev.'.problems.dnsbl.sorbs.net.';
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup != gethostbyname($lookup))
			{
				$sorbsspambot = true;
				if ($spamDebug) echo 'Sorbs<br />';
			} // End if ($lookup != gethostbyname($lookup))
		}

		//
		// Check the IP against Spamhaus
		//
		if($sNoCheckSpamHaus ==''){
			$spamhausspambot = false;
			$lookup = $rev.'.zen.spamhaus.org.';
			if ($spamDebug) echo $lookup.'<br />';

			// Spamhaus returns codes based on which blacklist the IP is in;
			//
			// 127.0.0.2		= SBL (Direct UBE sources, verified spam services and ROKSO spammers)
			// 127.0.0.3		= Not used
			// 127.0.0.4-8		= XBL (Illegal 3rd party exploits, including proxies, worms and trojan exploits)
			//	- 4		= CBL
			//	- 5		= NJABL Proxies (customized)
			// 127.0.0.9		= Not used
			// 127.0.0.10-11	= PBL (IP ranges which should not be delivering unauthenticated SMTP email)
			//	- 10		= ISP Maintained
			//	- 11		= Spamhaus Maintained
			//
			// We don't flag the CBL or PBL here.

			$spamhaustemp = gethostbyname($lookup);
			switch ($spamhaustemp){
				case "127.0.0.2":
					$sSHDB = "(SBL) ";
					$spamhausspambot = true;
					break;
				case "127.0.0.4": // We don't flag those in the CBL
					$sSHDB = "(CBL) ";
					$spamhausspambot = false;
					break;
				case "127.0.0.5":
					$sSHDB = "(NJABL) ";
					$spamhausspambot = true;
					break;
				case "127.0.0.6":
					$sSHDB = "(XBL) ";
					$spamhausspambot = true;
					break;
				case "127.0.0.7":
					$sSHDB = "(XBL) ";
					$spamhausspambot = true;
					break;
				case "127.0.0.8":
					$sSHDB = "(XBL) ";
					$spamhausspambot = true;
					break;
				case "127.0.0.10": // We don't flag those in the PBL
					$sSHDB = "(PBL - ISP Maintained) ";
					$spamhausspambot = false;
					break;
				case "127.0.0.11": // We don't flag those in the PBL
					$sSHDB = "(PBL - Spamhaus Maintained) ";
					$spamhausspambot = false;
					break;
				default: // We only flag valid responses
					$sSHDB = "";
					$spamhausspambot = false;
					break;
			} // End switch

			if($spamhausspambot == true){
				if ($spamDebug) echo 'Spamhaus '.$sSHDB . '<br />';
			} // End if

		} // End $sNoCheckSpamHaus

		//
		// Check the IP against SpamCop.net
		//
		if($sNoCheckSpamCop ==''){
			$lookup = $rev.'.bl.spamcop.net.';
			if ($spamDebug) echo $lookup.'<br />';
			if (gethostbyname($lookup) == '127.0.0.2')
			{
				$scopspambot = true;
				if ($spamDebug) echo 'SpamCop<br />';
			} // End if ($lookup != gethostbyname($lookup))
		}

		//
		// Check the IP against dnsbl.tornevall.org
		//
		if($sNoCheckTVO==''){
			$lookup = $rev.'.opm.tornevall.org.';
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup != gethostbyname($lookup))
			{
				$stvospambot = true;
				if ($spamDebug) echo 'Tornevall<br />';
			}
		}

		//
		// Check the IP against torproject.org
		//
		//	Special thanks (albeit a little late - my fault for forgetting the first time ;o)) to Zaphod (spambotsecurity.com)
		//	for the URI for this one ...
		//
		if($sNoCheckTor==''){
			$lookup = gethostbyname($rev.'.80.104.161.233.64.ip-port.exitlist.torproject.org.');
			if ($spamDebug) echo $lookup.'<br />';
			if ($lookup == "127.0.0.2")
			{
				$sTorspambot = true;
				if ($spamDebug) echo 'Tor Exit Node<br />';
			}
		}

		if($sBLDEspambot == true || $sTorspambot == true || $sefnetspambot == true || $stvospambot == true || $sphpspambot ==true || $sorbsspambot ==true || $spamhausspambot ==true || $scopspambot || $sdronespambot==true || $ahblspambot == true || $httpblachspambot == true || $droneachspambot == true || $spamachspambot == true || $zeusachspambot == true){
			$spambot = true; // Required seperately now that dumping to a text file is optional
		}
	} // End if ($ip !='')
	// *********************************************************************************
	// END CHECK DNSBL
	// *********************************************************************************

	// *********************************************************************************
	// We've let the user know the database, all we need to do now is let the user know the status
	// *********************************************************************************

	if($spambot == true){
		if ($spamDebug) echo 'TRUE';
	}else{
		if ($spamDebug) echo 'FALSE';
	}

	// *********************************************************************************
	// BEGIN SUBMIT TO FSPAMLIST
	// *********************************************************************************
	// Do we want to submit this to fSpamlist?
	if($sFSLAPI !='' && $spambot ==true && $fslspambot ==false && $blnSubmitToFSL==true){
		// Only submit it if it's not PBL/CBL (Spamhaus)
		if($spamhaustemp !=' (PBL - ISP Maintained)' && $spamhaustemp !=' (PBL - Spamhaus Maintained)' && $spamhaustemp !=' (CBL)'){
			$bSubmitted = false;
			// Is there an e-mail address?
			if($mail !=''){
				$sFSLM = 'http://www.fspamlist.com/apiadd.php?spammer='.$mail.'&type=email&key='.$sFSLAPI.'&from='.$_SERVER['SERVER_NAME'];
				$fspamsubmit = getURL($sFSLM);
				if (substr_count($fspamsubmit, 'Added successfully!') > 0) {
					$bSubmitted = true;
				}else{
					$bSubmitted = false;
				}
			}

			// Is there a username?
			if($username !=''){
				$sFSLU = 'http://www.fspamlist.com/apiadd.php?spammer='.$username.'&type=username&key='.$sFSLAPI.'&from='.$_SERVER['SERVER_NAME'];
				$fspamsubmit = getURL($sFSLU);
				if (substr_count($fspamsubmit, 'Added successfully!') > 0) {
					$bSubmitted = true;
				}else{
					$bSubmitted = false;
				}
			}

			// Is there an IP address?
			if($ip !=''){
				$sFSLI = 'http://www.fspamlist.com/apiadd.php?spammer='.$ip.'&type=ip&key='.$sFSLAPI.'&from='.$_SERVER['SERVER_NAME'];
				$fspamsubmit = getURL($sFSLI);
				if (substr_count($fspamsubmit, 'Added successfully!') > 0) {
					$bSubmitted = true;
				}else{
					$bSubmitted = false;
				}
			}

		} // End if($spamhaustemp ....
	} // End if($sFSLAPI ...
	// *********************************************************************************
	// END SUBMIT TO FSPAMLIST
	// *********************************************************************************

	// *********************************************************************************
	// Create a .txt file with the info of the spambot, if this one already exists, increase its amount of try's
	// *********************************************************************************
	if($spambot ==true){
		if($bsspambot == true){
			$spambot = true;
			if($bln_SaveToFile == true){$lRet = LogSpammerToFile($savetofolder, 'BotScout',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'BotScout', $username, $ip, $mail);}
		} // End BotScout

		if($fslspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'fSpamlist',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'fSpamList', $username, $ip, $mail);}
		} // End fSpamList

		if($sfsspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'StopForumSpam',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'StopForumSpam', $username, $ip, $mail);}
		} // End StopForumSpam

		// *********************************************************************************************************************************************
		// abuse.ch
		// *********************************************************************************************************************************************
		if($droneachspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'Abuse.ch (Drone)',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Abuse.ch (Drone)', $username, $ip, $mail);}
		} // End Drone
		if($httpblachspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'Abuse.ch (HTTPBL)',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Abuse.ch (HTTPBL)', $username, $ip, $mail);}
		} // End HTTPBL
		if($spamachspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'Abuse.ch (SPAM)',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Abuse.ch (SPAM)', $username, $ip, $mail);}
		} // End Spam
		if($zeusachspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'Abuse.ch (Zeus)',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Abuse.ch (Zeus)', $username, $ip, $mail);}
		} // End Zeus
		// *********************************************************************************************************************************************
		// END abuse.ch
		// *********************************************************************************************************************************************

		if($ahblspambot == true){
			$spambot = true;
			if($bln_SaveToFile == true){$lRet = LogSpammerToFile($savetofolder, 'AHBL',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'AHBL', $username, $ip, $mail);}
		} // End AHBL (Abusive Hosts Black List)

		if($sBLDEspambot == true){
			$spambot = true;
			if($bln_SaveToFile == true){$lRet = LogSpammerToFile($savetofolder, 'Blocklist.de',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Blocklist.de', $username, $ip, $mail);}
		} // End Blocklist.de (blocklist.de)

		if($sdronespambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'DroneBL',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'DroneBL', $username, $ip, $mail);}
		} // End DroneBL

		if($sefnetspambot == true){
			$spambot = true;
			if($bln_SaveToFile == true){$lRet = LogSpammerToFile($savetofolder, 'EFNet',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'EFNet', $username, $ip, $mail);}
		} // End EFNet (rbl.efnetrbl.org)

		if($sphpspambot == true && $sPHPAPI !=''){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'ProjectHoneyPot',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'ProjectHoneyPot', $username, $ip, $mail);}
		} // End ProjectHoneyPot

		if($sorbsspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'Sorbs',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Sorbs', $username, $ip, $mail);}
		} // End Sorbs

		if($scopspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'SpamCop',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'SpamCop', $username, $ip, $mail);}
		} // End SpamCop

		if($spamhausspambot == true){
			$spambot = true;
			if($bln_SaveToFile ==true){$lRet = LogSpammerToFile($savetofolder, 'SpamHaus',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'SpamHaus', $username, $ip, $mail);}
		} // End Spamhaus

		if($sTorspambot == true){
			$spambot = true;
			if($bln_SaveToFile == true){$lRet = LogSpammerToFile($savetofolder, 'Tor',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Tor', $username, $ip, $mail);}
		} // End Tor (dnsbl.torproject.org)

		if($stvospambot == true){
			$spambot = true;
			if($bln_SaveToFile == true){$lRet = LogSpammerToFile($savetofolder, 'Tornevall',$username, $ip, $mail);}
			if($bln_SaveToDB == true){$lRet = LogSpammerToDB($dbShost, $dbSname, $dbSusername, $dbSpassword, 'Tornevall', $username, $ip, $mail);}
		} // End Tornevall (dnsbl.tornevall.org)

	} // End if file_exists($savetofolder)
	// *********************************************************************************
	// END CREATE TEXT FILES
	// *********************************************************************************

	return $spambot;

} // End function checkSpambots

// Determine whether curl is available or not
function isCUrlAvailable() {
	$extension = 'curl';
	if (extension_loaded($extension)) {
		return true;
	}
	else {
		return false;
	}
}

// Determine if a URL is online or not

function isURLOnline($sSiteToCheck) {
	// check, if curl is available
	if (isCUrlAvailable()) {
		// check if url is online
		$curl = @curl_init($sSiteToCheck);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_FAILONERROR, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		@curl_exec($curl);
		if (curl_errno($curl) != 0) {
			return false;
		}
		else {
				return true;
			}
		curl_close($curl);
	}
	else {
		//curl is not loaded, this won't work
		return false;
	}
}


// Gets a URL's content
//
//	If file_get_contents() is available, use that, otherwise use cURL
//
function getURL($sURL)
{
	if(isURLOnline($sURL) == false)
	{
		$sURLTemp = 'Unable to connect to server';
		return $sURLTemp;
	}
	else
	{
		if(function_exists('file_get_contents') && ini_get('allow_url_fopen') == true)
		{
			// Use file_get_contents
			$sURLTemp = @file_get_contents($sURL);
		}
		else
		{
			// Use cURL (if available)
			if (isCUrlAvailable()) {
				$curl = @curl_init();
				curl_setopt($curl, CURLOPT_URL, $sURL);
				curl_setopt($curl, CURLOPT_VERBOSE, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HEADER, 0);
				$sURLTemp = @curl_exec($curl);
				curl_close($curl);
			}
			else {
				$sURLTemp = 'Unable to connect to server';
				return $sURLTemp;
			}
		}
		return $sURLTemp;
	}
	//echo 'DEBUG: $sURLTemp: '.$sURLTemp.'<br/>';
}

// Resolve a hostname
function resolve_host($sRHHost){
	if($sRHHost !=''){
		$sRHHosts = gethostbynamel($sRHHost);
		$irh=0;
		if (is_array($sRHHosts)) {
			foreach ($sRHHosts as $sRHHip) {
				if($sRHret==''){$sRHret=$sRHHip;}else{$sRHret = $sRHHip.",".$sRHret;}
				$irh++;
			}
			return $sRHret;
		}else{
			$sRHret = gethostbyname($sRHhost);
			if($sRHret==''){$sRHret=$sRHHost;}
			return $sRHret;
		}
	}else{
		die('ERROR: resolve_host requires a var be passed .....');
	}
}

// Determines if e-mail passed, is valid
//
//	Returns false if no @ is present
//	Returns false if domain does not resolve to an IP
//

function IsValidEmail($sMailToCheck){
	// Check it's an e-mail address
	if(substr_count($sMailToCheck, '@') == 1){
		// Check the domain part has at least one period, and it resolves to an IP (it's invalid if it doesn't)

		if(substr_count($sMailToCheck, '.') > 0){
			$sMailDomain = explode('@', $sMailToCheck); $sMailDomain=$sMailDomain[1];
			//echo 'Mail DOM: '.$sMailDomain.'<br />';
			$sMailDomainIP = resolve_host($sMailDomain);
			//echo 'Mail DOM IP: '.$sMailDomainIP.'<br />';
			//echo 'DOM: '.$sMailDomainIP.'<br />SERVER_ADDR: '.gethostbyname($_SERVER['SERVER_NAME']).'<br />';

			$sMyServerIP = gethostbyname($_SERVER['SERVER_NAME']);

			// If the IP = the domain then it's invalid
			switch($sMailDomainIP){
				case $sMailDomain:
					//echo 'NOT VALID<br />';
					$sIVE = FALSE;
					break;
				// If the IP = our servers IP, it's invalid
				case $sMyServerIP:
					//echo 'NOT VALID<br />';
					$sIVE = FALSE;
					break;

				default:
					// If the IP is an NRIP (non-routable IP) it's invalid					
					if(substr_count($sMailDomainIP, "192.168.0") > 0){
						//echo 'NOT VALID<br />';
						$sIVE = FALSE;

					}else{
						//echo 'VALID<br />';
						$i=0;
						// If there's commas in the return, we need to process them
						If(substr_count($sMailDomainIP, ',') > 0){
							$arrMDIP = explode(',', $sMailDomainIP);
							foreach($arrMDIP as $sMIP => $sMDIP){

								$barrIP = IsValidIP($sMDIP);
								//echo "barrIP: ".$barrIP.'<br />';
								If($barrIP==true){
									$bIVEIP = true; break;
								}else{
									$bIVEIP = FALSE; break;
								}
							}

							if($bIVEIP==true){$sIVE = true;}else{$sIVE = FALSE;}
						}else{

							$bIVEIP = IsValidIP($sMailDomainIP);

							if($bIVEIP==true){$sIVE = true;}else{$sIVE = FALSE;}
						}
					} // END if($sMailDomainIP == $_SERVER['SERVER_ADDR']){

					//$sIVE = settype($sIVE, "boolean");
					//echo "sIVE: ".$sIVE.'<br />';

					return $sIVE;
			}
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}
}

// Determines if passed IP is valid
//
//	Thanks to Mike @ BotScout (botscout.com) for this function
//
//	http://botscout.com/forum/index.php/topic,2.msg128.html#msg128
//

function IsValidIP($ip){
	if(preg_match("'\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b'", $ip)){
		return true;
	}else{
		return FALSE;
	}
}

// Is spammer to database (if enabled)
//
//	Requires:
//
//		$host		= MySQL server (e.g. localhost, 192.168.0.10 etc)
//		$dbname		= Database to use (e.g. Spambots)
//		$username	= Your MySQL username
//		$password	= Your MySQL password
//		$spammername	= Spammers username
//		$spammerip	= Spammers IP
//		$spammeremail	= Spammers email address
//
//	Usage:
//
//		$lRet = IsSpammerInDB('localhost', 'sbst', 'root', '12345password', 'volter', '123.123.123.123', 'spammer@email.com')
//
function IsSpammerInDB($host, $dbname, $username, $password, $spammername, $spammerip, $spammeremail){

		global $db, $prefix;
		// Change empty vars to "NULL"
		if($spammername==''){$spammername='nothing';}
		if($spammerip==''){$spammerip='1.2.3.4';}
		if($spammeremail==''){$spammeremail='noone@nothing.com';}
		// Trim anything that could screw with the SQL
		$spammeremail=str_replace('%40', '@', $spammeremail);
		$spammername=str_replace(array("0x", ",", "%", "'","\r\n", "\r", "\n"), "", $spammername);
		$spammerip=str_replace(array("0x", ",", "%", "'","\r\n", "\r", "\n"), "", $spammerip);
		$spammeremail=str_replace(array("0x", ",", "%", "'","\r\n", "\r", "\n"), "", $spammeremail);
	if (method_exists($db, 'sql_escape_string')) {
		$spammername=$db->sql_escape_string($spammername);
		$spammerip=$db->sql_escape_string($spammerip);
		$spammeremail=$db->sql_escape_string($spammeremail);
	} else {
		$spammername = addslashes($spammername);
		$spammerip = addslashes($spammerip);
		$spammeremail = addslashes($spammeremail);
	}

	// Check to see if our spammer already exists (compares username/IP/E-mail AND the database they are listed in, returns false if only one matches)
	$sSQL = 'SELECT count FROM ' . $prefix . '_spam_log WHERE username=\''.$spammername.'\' OR ip=\''.$spammerip.'\' OR email=\''.$spammeremail.'\'';
	$sQuery = $db->sql_query($sSQL);
	$num = $db->sql_numrows($sQuery);
	if($num==0){return false;}else{return true;}
}

// Log spammer to database (if enabled)
//
//	Requires:
//
//		$host		= MySQL server (e.g. localhost, 192.168.0.10 etc)
//		$dbname		= Database to use (e.g. Spambots)
//		$username	= Your MySQL username
//		$password	= Your MySQL password
//		$spamdb		= Database the spammer is listed in (e.g. fSpamlist)
//		$spammername	= Spammers username
//		$spammerip	= Spammers IP
//		$spammeremail	= Spammers email address
//
//	Usage:
//
//		$lRet = LogSpammerToDB('localhost', 'SBST', 'root', '12345password', 'fSpamlist', 'volter', '123.123.123.123', 'spammer@email.com')
//
function LogSpammerToDB($host, $dbname, $username, $password, $spamdb, $spammername, $spammerip, $spammeremail){

	global $db, $prefix, $nukeSPAMrequest;
	// Change empty vars to "NULL"
	if($spammername==''){$spammername='NULL';}
	if($spammerip==''){$spammerip='NULL';}
	if($spammeremail==''){$spammeremail='NULL';}

	// Trim anything that could screw with the SQL
	$spammername=str_replace(array("0x", ",", "%", "'","\r\n", "\r", "\n"), "", $spammername);
	$spammerip=str_replace(array("0x", ",", "%", "'","\r\n", "\r", "\n"), "", $spammerip);
	$spammeremail=str_replace('%40', '@', $spammeremail);
	$spammeremail=str_replace(array("0x", ",", "%", "'","\r\n", "\r", "\n"), "", $spammeremail);

	if (method_exists($db, 'sql_escape_string')) {
		$spammername=$db->sql_escape_string($spammername);
		$spammerip=$db->sql_escape_string($spammerip);
		$spammeremail=$db->sql_escape_string($spammeremail);
	} else {
		$spammername=addslashes($spammername);
		$spammerip=addslashes($spammerip);
		$spammeremail=addslashes($spammeremail);
	}

	$bAddNewSpammer='ADD';
		// Check to see if our spammer already exists (compares username/IP/E-mail AND the database they are listed in, returns false if only one matches)
		$sSQL = "SELECT * FROM " . $prefix . "_spam_log WHERE username='$spammername' OR ip='$spammerip' OR email='$spammeremail' AND matched='$spamdb' AND request='$nukeSPAMrequest'";
		$sQuery = $db->sql_query($sSQL);
		if(!$sQuery){
		}else{
			$num = $db->sql_numrows($sQuery);
			while ($row = $db->sql_fetchrow($sQuery)) {
				$bAddNewSpammer=$row['slid'];
				$lSpammerCount=$row['count'];
			}
		}

		if($bAddNewSpammer=='ADD'){
			// ADD SPAMMER
			$sDate = time();
			$sSQL = 'INSERT INTO ' . $prefix . '_spam_log (username, ip, email, matched, count, added, request) VALUES(\''.$spammername.'\', INET_ATON(\''.$spammerip.'\'), \''.$spammeremail.'\', \''.$spamdb.'\', \'1\', \''.$sDate.'\', \''. $nukeSPAMrequest.'\')';
		}else{
			// UPDATE SPAMMER
			$lSpammerCount = $lSpammerCount+1;
			$sSQL = 'UPDATE ' . $prefix . '_spam_log SET count=\'' . $lSpammerCount . '\' WHERE slid=\'' . $bAddNewSpammer . '\'';
		}
		$result = $db->sql_query($sSQL);
		return true;
}

?>