/*
 * -------------------------------------------------------------------
 * Utility/Miscellaneous scripts for Ravenstaller(tm)
 * -------------------------------------------------------------------
 */
 
/**
 * Used in function popElements(for testing ajax capability
 */
function createRequest() {
   //var request = null;
   try {
      request = new XMLHttpRequest();
   } 
   catch (trymicrosoft) {
      try {
         request = new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch (othermicrosoft) {
         try {
            request = new ActiveXObject("Microsoft.XMLHTTP");
         }
         catch (failed) {
            request = null;
         }
      }
   }
   return request;
}   

/**
 * Used for populating the Configuration Settings For Browser section of the Ravenstaller™ Server Environment Check ajax window
 */
function popElements() {
   if (document.getElementById("step01")) {
      var testTrue  = '<span style="color:green;font-weight:bold;">Yes</span>';
      var testFalse = '<span style="color:red;font-weight:bold;">No</span>';
      var browserEngine       = navigator.appCodeName;
      var browserMinorVersion = navigator.appMinorVersion;
      var browserName         = navigator.appName;
      var browserVersion      = navigator.appVersion;
      var browserPlatform     = navigator.platform;
      var browserUserAgent    = navigator.userAgent;
      document.getElementById("brUserAgent").innerHTML = browserUserAgent;

      var getById = document.getElementById("getElementByIdFunc");
      if (document.getElementById) { getById.innerHTML = testTrue; }
      else { getById.innerHTML = testFalse; }

      var cookies = document.getElementById("cookieEnabledId");
      if (navigator.cookieEnabled) { cookies.innerHTML = testTrue; }
      else { cookies.innerHTML = testFalse; }

      var js = document.getElementById("jsEnabledId");
      if (document.getElementById('jsEnabledId') !== null && document.forms) { js.innerHTML = testTrue; }
      else { js.innerHTML = testFalse; }

      var ajax = document.getElementById("ajaxEnabledId");
      var request = null;
      var request = createRequest();
      if (request) { ajax.innerHTML = testTrue; }
      else { ajax.innerHTML = testFalse; }
   }
}

/**
 * Used for resizing ajax window
 */
function browserWindowSize(w2hRatio,reduceScreenBy) {
   bwW = 0, bwH = 0;
   if( typeof( window.innerWidth ) == 'number' ) {
   //Non-IE
      bwW = window.innerWidth;
      bwH = window.innerHeight;
   } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
   //IE 6+ in 'standards compliant mode'
      bwW = document.documentElement.clientWidth;
      bwH = document.documentElement.clientHeight;
   } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
   //IE 4 compatible
      bwW = document.body.clientWidth;
      bwH = document.body.clientHeight;
   }
   if (w2hRatio==null) w2hRatio=1.2; //Default width to height ratio
   if (reduceScreenBy==null) reduceScreenBy=.9; //Default percentage of inner screen dimensions to use - .9=90%
   bwH=bwH*reduceScreenBy;
   bwW=bwH*w2hRatio*reduceScreenBy;
   //alert( 'Browser Window Width = ' + bwW +' Browser Window Height = '+bwH);
}

function nameCheck (varPseudoName,varValue,varMatch) {
   re = new RegExp(varMatch);
   if (!varValue.match(re) || varValue.match(re)==null) {
      alert('Please enter correct name format for => '+varPseudoName);
      return false;
   }
   return true;
}

function lengthCheck (varPseudoName,varName,varLength,minmax) {
   if (minmax=='min') {
      if (varName.length<varLength) {
         alert('The length of '+varPseudoName+' must be at least '+varLength+' bytes long');
         return false;
      }
   }
   else if (minmax=='max') {
      if (varName.length>varLength) {
         alert('The length of '+varPseudoName+' must be less than '+varLength+' bytes long');
         return false;
      }
   }
   return true;
}

function emptyCheck (formName) {
   for(i=0; i<formName.elements.length; i++) {
      if (formName.elements[i].value.length < 1) {
         alert('All fields must be filled in. ');
         return false;
      }
   }
   return true;
}

function emailCheck (emailStr) {
/* This script and many more are available free online at 
  * The JavaScript Source!! http://javascript.internet.com 
  * V1.1.3: Sandeep V. Tamhankar (stamhankar@hotmail.com)
  * Original:  Sandeep V. Tamhankar (stamhankar@hotmail.com)
  * Changes:
  * 1.1.4: Fixed a bug where upper ASCII characters (i.e. accented letters
international characters) were allowed.
  * The following variable tells the rest of the function whether or not
to verify that the address ends in a two-letter country or well-known
TLD.  1 means check it, 0 means don't. */
   var checkTLD=1;
   /* The following is the list of known TLDs that an e-mail address must end with. */
   var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
   /* The following pattern is used to check if the entered e-mail address
         fits the user@domain format.  It also is used to separate the username
         from the domain. */
   var emailPat=/^(.+)@(.+)$/;
   /* The following string represents the pattern for matching all special
         characters.  We don't want to allow special characters in the address.
         These characters include ( ) < > @ , ; : \ " . [ ] */
   var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
   /* The following string represents the range of characters allowed in a
         username or domainname.  It really states which chars aren't allowed.*/
   var validChars="\[^\\s" + specialChars + "\]";
   /* The following pattern applies if the "user" is a quoted string (in
         which case, there are no rules about which characters are allowed
         and which aren't; anything goes).  E.g. "jiminy cricket"@disney.com
         is a legal e-mail address. */
   var quotedUser="(\"[^\"]*\")";
   /* The following pattern applies for domains that are IP addresses,
         rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal
         e-mail address. NOTE: The square brackets are required. */
   var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
   /* The following string represents an atom (basically a series of non-special characters.) */
   var atom=validChars + '+';
   /* The following string represents one word in the typical username.
         For example, in john.doe@somewhere.com, john and doe are words.
         Basically, a word is either an atom or quoted string. */
   var word="(" + atom + "|" + quotedUser + ")";
   /* The following pattern describes the structure of the user */
   var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
   /* The following pattern describes the structure of a normal symbolic
         domain, as opposed to ipDomainPat, shown above. */
   var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
   /* Finally, let's start trying to figure out if the supplied address is valid. */
   /* Begin with the coarse pattern to simply break up user@domain into
         different pieces that are easy to analyze. */
   var matchArray=emailStr.match(emailPat);
   if (matchArray==null) {
   /* Too many/few @'s or something; basically, this address doesn't
         even fit the general mould of a valid e-mail address. */
      alert("Email address seems incorrect (check @ and .'s)");
      return false;
   }
   var user=matchArray[1];
   var domain=matchArray[2];
   /* Start by checking that only basic ASCII characters are in the strings (0-127). */
   for (i=0; i<user.length; i++) {
      if (user.charCodeAt(i)>127) {
         alert("Ths username contains invalid characters.");
         return false;
      }
   }
   for (i=0; i<domain.length; i++) {
      if (domain.charCodeAt(i)>127) {
         alert("Ths domain name contains invalid characters.");
         return false;
      }
   }
   /* See if "user" is valid */
   if (user.match(userPat)==null) {
   /* user is not valid */
      alert("The username doesn't seem to be valid.");
      return false;
   }
   /* if the e-mail address is at an IP address (as opposed to a symbolic
         host name) make sure the IP address is valid. */
   var IPArray=domain.match(ipDomainPat);
   if (IPArray!=null) {
   /* this is an IP address */
      for (var i=1;i<=4;i++) {
         if (IPArray[i]>255) {
            alert("Destination IP address is invalid!");
            return false;
         }
      }
      return true;
   }
   /* Domain is symbolic name.  Check if it's valid. */
   var atomPat=new RegExp("^" + atom + "$");
   var domArr=domain.split(".");
   var len=domArr.length;
   for (i=0;i<len;i++) {
      if (domArr[i].search(atomPat)==-1) {
         alert("The domain name does not seem to be valid.");
         return false;
      }
   }
   /* domain name seems valid, but now make sure that it ends in a
         known top-level domain (like com, edu, gov) or a two-letter word,
         representing country (uk, nl), and that there's a hostname preceding
         the domain or country. */
   if (checkTLD && domArr[domArr.length-1].length!=2 && domArr[domArr.length-1].search(knownDomsPat)==-1) {
      alert("The address must end in a well-known domain or two letter " + "country.");
      return false;
   }
   /* Make sure there's a host name preceding the domain. */
   if (len<2) {
      alert("This address is missing a hostname!");
      return false;
   }

   /* If we've gotten this far, everything's valid! */
   return true;
}