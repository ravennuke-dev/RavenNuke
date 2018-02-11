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
define('_1WEEK','1 Week');
define('_2WEEKS','2 Weeks');
define('_30DAYS','30 Days');
define('_ADDALINK','Add a New Link');
define('_ADDEDON','Added on');
define('_ADDITIONALDET','Additional Details');
define('_ADDLINK','Add Link');
define('_ADDURL','Add this URL');
define('_ALLOWTORATE','Allow other users to rate it from your web site!');
define('_AND','and');
define('_BESTRATED','Best Rated Links - Top');
define('_BREAKDOWNBYVAL','Breakdown of Ratings by Value');
define('_BUTTONLINK','Button Link');
define('_CATEGORIES','Categories');
if (!defined('_CATEGORY')) define('_CATEGORY','Category');
define('_CATLAST3DAYS','New Links in this Category Added in the last 3 days');
define('_CATNEWTODAY','New Links in this Category Added Today');
define('_CATTHISWEEK','New Links in this Category Added this week');
define('_CHECKFORIT','You didn\'t provide an Email address but we will check your link soon.');
define('_COMPLETEVOTE1','Your vote is appreciated.');
define('_COMPLETEVOTE2','You have already voted for this resource in the past '."$anonwaitdays".' day(s).');
define('_COMPLETEVOTE3','Vote for a resource only once.<br />All votes are logged and reviewed.');
define('_COMPLETEVOTE4','You cannot vote on a link you submitted.<br />All votes are logged and reviewed.');
define('_COMPLETEVOTE5','No rating selected - no vote tallied');
define('_COMPLETEVOTE6','Only one vote per IP address allowed every '."$outsidewaitdays".' day(s).');
if (!defined('_DATE')) { define('_DATE','Date'); }
define('_DATE1','Date (Old Links Listed First)');
define('_DATE2','Date (New Links Listed First)');
define('_DAYS','days');
define('_DESCRIPTION','Description');
define('_DETAILS','Details');
define('_EDITORIAL','Editorial');
define('_EDITORIALBY','Editorial by');
define('_EDITORREVIEW','Editor Review');
define('_EDITTHISLINK','Edit This Link');
define('_EMAILWHENADD','You\'ll receive an E-mail when it\'s approved.');
define('_FEELFREE2ADD','Feel free to add a comment about this site.');
define('_HIGHRATING','High Rating');
define('_HITS','Hits');
define('_HTMLCODE1','The HTML code you should use in this case, is the following:');
define('_HTMLCODE2','The source code for the above button is:');
define('_HTMLCODE3','Using this form will allow users to rate your resource directly from your site and the rating will be recorded here. The above form is disabled, but the following source code will work if you simply cut and paste it into your web page. The source code is shown below:');
define('_IDREFER','in the HTML source references your site\'s ID number in '."$sitename".' database. Be sure this number is present.');
define('_IFYOUWEREREG','If you were registered you could make comments on this website.');
define('_INDB','in our database');
define('_INOTHERSENGINES','in others Search Engines');
define('_INSTRUCTIONS','Instructions');
define('_ISTHISYOURSITE','Is this your resource?');
define('_LAST30DAYS','Last 30 Days');
define('_LASTWEEK','Last Week');
define('_LDESCRIPTION','Description: (255 characters max)');
define('_LETSDECIDE','Input from users such as yourself will help other visitors better decide which links to click on.');
define('_LINKALREADYEXT','ERROR: This URL is already listed in the Database!');
define('_LINKCOMMENTS','Link Comments');
define('_LINKID','Link ID');
define('_LINKNODESC','ERROR: You need to type a DESCRIPTION for your URL!');
define('_LINKNOTITLE','ERROR: You need to type a TITLE for your URL!');
define('_LINKNOURL','ERROR: You need to type a URL for your URL!');
define('_LINKPROFILE','Link Profile');
define('_LINKRATING','Links Rating');
define('_LINKRATINGDET','Link Rating Details');
define('_LINKRECEIVED','We received your Link submission. Thanks!');
define('_LINKS','Links');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LINKSMAIN','Links Main');
define('_LINKSMAINCAT','Links Main Categories');
define('_LINKSNOCATS1','There must be at least one link category created by'); //montego for RN0000571
define('_LINKSNOCATS2','the site admin before a link can be added.'); //montego for RN0000571
define('_LINKSNOTUSER1','You are not a registered user or you have not logged in.');
define('_LINKSNOTUSER2','If you were registered you could add links on this website.');
define('_LINKSNOTUSER3','Becoming a registered user is a quick and easy process.');
define('_LINKSNOTUSER4','Why do we require registration for access to certain features?');
define('_LINKSNOTUSER5','So we can offer you only the highest quality content,');
define('_LINKSNOTUSER6','each item is individually reviewed and approved by our staff.');
define('_LINKSNOTUSER7','We hope to offer you only valuable information.');
define('_LINKSNOTUSER8','<a href="modules.php?name=Your_Account">Register for an Account</a>');
define('_LINKTITLE','Link Title');
define('_LINKVOTE','Vote!');
define('_LOOKTOREQUEST','We\'ll look into your request shortly.');
define('_LOWRATING','Low Rating');
define('_LTOTALVOTES','total votes');
define('_LVOTES','votes');
define('_MAIN','Main');
if(!defined('_MODIFY')) define('_MODIFY','Modify');
define('_MOSTPOPULAR','Most Popular - Top');
define('_NEW','New');
define('_NEWLAST3DAYS','New last 3 days');
define('_NEWLINKS','New Links');
define('_NEWTHISWEEK','New This Week');
define('_NEWTODAY','New Today');
define('_NEXT','Next Page');
define('_NOEDITORIAL','No editorial is currently available for this website.');
define('_NOMATCHES','No matches found to your query');
define('_NOOUTSIDEVOTES','No Outside Votes');
define('_NOREGUSERSVOTES','No Registered User Votes');
define('_NOUNREGUSERSVOTES','No Unregistered User Votes');
define('_NUMBEROFRATINGS','Number of Ratings');
define('_NUMOFCOMMENTS','Number of Comments');
define('_NUMRATINGS','# of Ratings');
if (!defined('_OF')) { define('_OF','of'); }
define('_OFALL','of all');
define('_ONLYREGUSERSMODIFY','Only registered users can suggest links modifications. Please <a href="modules.php?name=Your_Account">register or login</a>.');
define('_OUTSIDEVOTERS','Outside Voters');
define('_OVERALLRATING','Overall Rating');
define('_PAGETITLE','Page Title');
define('_PAGEURL','Page URL');
define('_POPULAR','Popular');
define('_POPULARITY','Popularity');
define('_POPULARITY1','Popularity (Least to Most Hits)');
define('_POPULARITY2','Popularity (Most to Least Hits)');
define('_POSTPENDING','All links are posted pending verification.');
define('_PREVIOUS','Previous Page');
define('_PROMOTE01','Maybe you can be interested in several of the remote \'Rate a Website\' options we have available. These allow you to place an image (or even a rating form) on your web site in order to increase the number of votes your resource receive. Please choose from one of the options listed below:');
define('_PROMOTE02','One way to link to the rating form is through a simple text link:');
define('_PROMOTE03','If you\'re looking for a little more than a basic text link, you may wish to use a small button link:');
define('_PROMOTE04','If you cheat on this, we\'ll remove your link. Having said that, here is what the current remote rating form looks like.');
define('_PROMOTE05','Thanks! and good luck with your ratings!');
define('_PROMOTEYOURSITE','Promote Your Website');
define('_RANDOM','Random');
define('_RATEIT','Rate this Site!');
define('_RATENOTE1','Please do not vote for the same resource more than once.');
define('_RATENOTE2','The scale is 1 - 10, with 1 being poor and 10 being excellent.');
define('_RATENOTE3','Please be objective in your vote, if everyone receives a 1 or a 10, the ratings aren\'t very useful.');
define('_RATENOTE4','You can view a list of the <a href="modules.php?name=Web_Links&amp;l_op=TopRated">Top Rated Resources</a>.');
define('_RATENOTE5','Do not vote for your own resource or a competitor\'s.');
define('_RATESITE','Rate this Site');
define('_RATETHISSITE','Rate this Resource');
define('_RATING','Rating');
define('_RATING1','Rating (Lowest Scores to Highest Scores)');
define('_RATING2','Rating (Highest Scores to Lowest Scores)');
define('_REGISTEREDUSERS','Registered Users');
define('_REMOTEFORM','Remote Rating Form');
define('_REPORTBROKEN','Report Broken Link');
define('_REQUESTLINKMOD','Request Link Modification');
define('_RETURNTO','Return to');
define('_SCOMMENTS','Comments');
define('_SEARCHRESULTS4','Search Results for');
define('_SELECTPAGE','Select Page');
define('_SENDREQUEST','Send Request');
define('_SHOW','Show');
define('_SHOWTOP','Show Top');
define('_SITESSORTED','Sites currently sorted by');
define('_SORTLINKSBY','Sort Links by');
define('_STAFF','Staff');
define('_SUBMITONCE','Submit a unique link only once.');
define('_TEXTLINK','Text Link');
define('_THANKSBROKEN','Thank you for helping to maintain this directory\'s integrity.');
define('_THANKSFORINFO','Thanks for the information.');
define('_THANKSTOTAKETIME','Thank you for taking the time to rate a site here at');
define('_THENUMBER','The Number');
define('_THEREARE','There are');
define('_TITLE','Title');
define('_TITLEAZ','Title (A to Z)');
define('_TITLEZA','Title (Z to A)');
define('_TO','To');
define('_TOPRATED','Top Rated');
define('_TOTALFORLAST','Total new links for last');
define('_TOTALNEWLINKS','Total New Links');
define('_TOTALOF','Total of');
define('_TOTALVOTES','Total Votes:');
define('_TRATEDLINKS','total rated links');
define('_TRY2SEARCH','Try to search');
define('_TVOTESREQ','minimum votes required');
define('_UNREGISTEREDUSERS','Unregistered Users');
define('_URL','URL');
define('_USER','User');
define('_USERANDIP','Username and IP are recorded, so please don\'t abuse the system.');
define('_USERAVGRATING','User\'s Average Rating');
define('_USUBCATEGORIES','Sub-Categories');
define('_VISITTHISSITE','Visit this Website');
define('_VOTE4THISSITE','Vote for this Site!');
define('_WEBLINKS','Web Links');
define('_WEIGHNOTE','* Note: This Resource weighs Registered vs. Unregistered users ratings');
define('_WEIGHOUTNOTE','* Note: This Resource weighs Registered vs. Outside voters ratings');
define('_YOUARENOTREGGED','You are not a registered user or you have not logged in.');
define('_YOUAREREGGED','You are a registered user and are logged in.');
define('_YOUREMAIL','Your Email');
define('_YOURNAME','Your Name');
?>