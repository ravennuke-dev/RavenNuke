<?php
##############################################################################
#     XHTML and mimetype script for PHP                                      #
#     Copyright (C) 2005  Darrin Yeager                                      #
#     All rights reserved.                                                   #
#     http://www.dyeager.org                                                 #
#                                                                            #
# Redistribution and use in source and binary forms, with or without         #
# modification, are permitted provided that the following conditions         #
# are met:                                                                   #
#                                                                            #
#   1. Redistributions of source code must retain the above copyright        #
#      notice, this list of conditions and the following disclaimer.         #
#                                                                            #
#   2. Redistributions in binary form must reproduce the above copyright     #
#      notice, this list of conditions and the following disclaimer in the   #
#      documentation and/or other materials provided with the distribution.  #
#                                                                            #
#   3. Redistributions of modified versions must carry prominent notices     #
#      stating that you changed the files and the date of any change.        #
#                                                                            #
#   4. Neither the name of Darrin Yeager nor the names of any contributors   #
#      may be used to endorse or promote products derived from this software #
#      without specific prior written permission.                            #
#                                                                            #
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS        #
# "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT          #
# LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR      #
# A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT       #
# OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,      #
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED   #
# TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR     #
# PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF     #
# LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING       #
# NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS         #
# SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.               #
#                                                                            #
##############################################################################

$charset = defined('_CHARSET') ? _CHARSET : 'ISO-8859-1';
//$mime = 'application/xhtml+xml';
$mime = defined('_MIME') ? _MIME : 'text/html';
//$mime = 'text/html';
$doctype = 'transitional';
define('DOCTYPE', $doctype);
$is304 = false;

# NOTE: To allow for q-values with one space (text/html; q=0.5),
# use the following regex:
# "/text\/html;[\ ]{0,1}q=([0-1]{0,1}\.\d{0,4})/i"
if((isset($_SERVER["HTTP_ACCEPT"])) && (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")))  {
	if(preg_match("/application\/xhtml\+xml;q=([0-1]{0,1}\.\d{0,4})/i",$_SERVER["HTTP_ACCEPT"],$matches)) {
		$xhtml_q = $matches[1];
		if(preg_match("/text\/html;q=([0-1]{0,1}\.\d{0,4})/i",$_SERVER["HTTP_ACCEPT"],$matches)) {
			$html_q = $matches[1];
			if((float)$xhtml_q >= (float)$html_q)
				$mime = $mime; //"application/xhtml+xml";
		}
	}
	else
	  $mime = $mime; //"application/xhtml+xml";
}

# Get the file stats and compute last-modified time.
$filestats = @stat($_SERVER["SCRIPT_FILENAME"]);
$lastmod = $filestats[9] - date('Z');  #Convert Local time -> GMT

# ETag is "inode-lastmodtime-filesize" - See PHP stat function for more detail
$etag = '"' . dechex($filestats[1]) . "-" . dechex($lastmod) . "-" . dechex($filestats[7]) . '"';

# Check HTTP_IF_NONE_MATCH
# and report a 304 Not Modified header if they match.
if (isset ($_SERVER["HTTP_IF_NONE_MATCH"])) {
	if ($etag === stripslashes($_SERVER["HTTP_IF_NONE_MATCH"]))
		$is304 = true;
}

if ($is304) {
	if (isset($_SERVER["SERVER_PROTOCOL"]) && $_SERVER["SERVER_PROTOCOL"] == "HTTP/1.1")
		header("HTTP/1.1 304 Not Modified");
	else
		header("HTTP/1.0 304 Not Modified");
	header("ETag: " . $etag);
	header("Vary: Accept");
	header("Connection: close");
	exit;
}

header("Content-Type: $mime;charset=$charset");
//header("Cache-Control: max-age=86400, s-maxage=86400");
header("Vary: Accept");
# If for some reason we didn't get a valid file modification time
# from the stat function, or it errored out, DO NOT send the ETag
# header as it will not be valid. Valid in this since is defined
# as modified AFTER Dec 24, 1999.
//if ($lastmod > 946080000) {        # 946080000 = Dec 24, 1999 4PM
//	header("ETag: " . $etag);
//}

if (DOCTYPE == "strict") { ?>
<!DOCTYPE html
	  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php } else if (DOCTYPE == "frameset") { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php } else if (DOCTYPE == "math") { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN"
					"http://www.w3.org/TR/MathML2/dtd/xhtml-math11-f.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<?php } else { ?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php } ?>
<head>
<?php
if(!isset($dhMETA)) $dhMETA = array('title' => array(1 => ''));
if (strlen(trim($dhMETA['title'][1]))>0) {?>
	<title><?php echo $dhMETA['title'][1]; // nukeSEO(tm) Dynamic HEAD ?></title>
<?php } ?>
<meta http-equiv="Content-Type" content="<?php echo $mime ?>;charset=<?php echo $charset ?>" />
