<?php

//#####################################################################
// PHP-NUKE: Web Portal System
// ===========================
//
// Copyright (c) 2000 by Francisco Burzi (fbc@mandrakesoft.com)
// http://phpnuke.org
//
// This module is to configure the main options for your site
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License.
//#####################################################################

//#####################################################################
// Web Links Preferences (Some variables are valid also for Downloads)
//
// $allowlinksadd:              Allow new links to be added by users (other than admin) (1=Yes 0=No)
// $allowlinksmodify:           Allow existing links to be modified by users (other than admin) (1=Yes 0=No)
// $anonwaitdays:               Number of days anonymous users need to wait to vote on a link
// $anonweight:                 How many Unregistered User vote per 1 Registered User Vote?
// $blockunregmodify:           Block unregistered users from suggesting links changes? (1=Yes 0=No)
// $detailvotedecimal:          Let Detailed Vote Summary Decimal out to N places. (no max)
// $featurebox:                 1 to Show Feature Link Box on links Main Page? (1=Yes 0=No)
// $links_anonaddlinklock:      Allow Unregistered users to Suggest New Links? (1=Yes 0=No)
// $linksresults:               How many links to display on each search result page?
// $linkvotemin:                Number votes needed to make the 'top 10' list
// $mainvotedecimal:            Let Main Vote Summary Decimal show out to N places. (max 4)
// $mostpoplinks:               Either # of links OR percentage to show (percentage as whole number. #/100)
// $mostpoplinkspercentrigger:  1 to Show Most Popular Links as a Percentage (else # of links)
// $newlinks:                   How many links to display in the New Links Page?
// $outsidewaitdays:            Number of days outside users need to wait to vote on a link (checks IP)
// $outsideweight:              How many Outside User vote per 1 Registered User Vote?
// $perpage:                    How many links to show on each page?
// $popular:                    How many hits need a link to be listed as popular?
// $toplinks:                   Either # of links OR percentage to show (percentage as whole number. #/100)
// $toplinkspercentrigger:      1 to Show Top Links as a Percentage (else # of links)
// $useoutsidevoting:           Allow Webmasters to put vote links on their site (1=Yes 0=No)
//#####################################################################

$allowlinksadd = 1;
$allowlinksmodify = 1;
$anonwaitdays = 1;
$anonweight = 10;
$blockunregmodify = 0;
$detailvotedecimal = 2;
$featurebox = 1;
$links_anonaddlinklock = 0;
$linksresults = 10;
$linkvotemin = 5;
$mainvotedecimal = 1;
$mostpoplinks = 25;
$mostpoplinkspercentrigger = 0;
$newlinks = 10;
$outsidewaitdays = 1;
$outsideweight = 20;
$perpage = 10;
$popular = 5000;
$toplinks = 25;
$toplinkspercentrigger = 0;
$useoutsidevoting = 1;

?>