<?php
// Simple Set of SEO Related Functions
// seo_fns.php
// Courtesy jjwdesign
// http://www.webmasterworld.com/forum88/12930.htm

// strip html and Truncate to create a title, Google truncates Titles to 40 characters.
function seo_create_title($str, $length = 70) {
  $title = truncate_string(seo_simple_strip_tags($str), $length);
  if (strlen($str) > strlen($title)) {
    $title .= "...";
  }
  return $title;
}

// strip html and Truncate to create a meta description, Google doesn't care about meta tags.
function seo_create_meta_description($str, $length = 120) {
  $meta_description = truncate_string(seo_simple_strip_tags($str), $length);
  if (strlen($str) > strlen($meta_description)) {
    $meta_description .= "...";
  }
    return $meta_description;
  }

// strip html and Truncate to create a meta keywords, Google doesn't care about meta tags.
function seo_create_meta_keywords($str, $length = 200) {
  $exclude = array('description','save','$ave','month!','year!','hundreds','dollars','per','month','year',
  'and','or','but','at','in','on','to','from','is','a','an','am','for','of','the');
  $splitstr = @explode(" ", truncate_string(seo_simple_strip_tags(str_replace(array(",",".")," ", $str)), $length));
  $new_splitstr = array();
  foreach ($splitstr as $spstr) {
    if (strlen($spstr) > 2 &&!(in_array(strtolower($spstr), $new_splitstr)) &&!(in_array(strtolower($spstr), $exclude))) {
      $new_splitstr[] = strtolower($spstr);
    }
  }
  return @implode(", ", $new_splitstr);
}

// Simple strip html Tags function for seo functions above.
function seo_simple_strip_tags($str) {
  $untagged = '';
  $skippingtag = false;
  for ($i = 0; $i < strlen($str); $i++) {
    if (!$skippingtag) {
      if ($str[$i] == '<') {
        $skippingtag = true;
      } else {
        if ($str[$i]==' ' or $str[$i]=="\n" or $str[$i]=="\r" or $str[$i]=="\t") {
          $untagged .= ' ';
        } else {
          $untagged .= $str[$i];
        }
      }
    } else {
      if ($str[$i] == ">") {
        $untagged .= " ";
        $skippingtag = false;
      }
    }
  }
  $untagged = preg_replace("/[\n\r\t\s ]+/i", " ", $untagged); // remove multiple spaces, returns, tabs, etc.
  if (substr($untagged,-1) == ' ') { $untagged = substr($untagged,0,strlen($untagged)-1); } // remove space from end of string
  if (substr($untagged,0,1) == ' ') { $untagged = substr($untagged,1,strlen($untagged)-1); } // remove space from start of string
  if (substr($untagged,0,12) == 'description ') { $untagged = substr($untagged,12,strlen($untagged)-1); } // remove 'description ' from start of string
  return $untagged;
}

// This function will truncate a string to a specified length.
function truncate_string($string, $length = 70) {
  if (strlen($string) > $length) {
    $split = preg_split("/\n/", wordwrap($string, $length));
    return ($split[0]);
  }
  return ($string);
}

// Split the words (\W) by delimiters, ucfirst and then recombine with delimiters.
function ucfirst_title($string) {
  $temp = preg_split('/(\W)/', $string, -1, PREG_SPLIT_DELIM_CAPTURE );
  foreach ($temp as $key=>$word) {
    $temp[$key] = ucfirst(strtolower($word));
  }
  $new_string = join ('', $temp);
  // Do the Search and Replacements on the $new_string.
  $search = array (' And ',' Or ',' But ',' At ',' In ',' On ',' To ',' From ',' Is ',' A ',' An ',' Am ',' For ',' Of ',' The ',"'S", 'Ac/');
  $replace = array (' and ',' or ',' but ',' at ',' in ',' on ',' to ',' from ',' is ',' a ',' an ',' am ',' for ',' of ',' the ',"'s", 'AC/');
  $new_string = str_replace($search, $replace, $new_string);
  // Several special Replacements ('s, McPherson, McBain, etc.) on the $new_string.
  $new_string = preg_replace("/Mc([a-z]{3,})/e", "\"Mc\".ucfirst(\"$1\")", $new_string);
  // Another Strange Replacement (example: "Pure-Breed Dogs: the Breeds and Standards") on the $new_string.
  $new_string = preg_replace("/([:;])\s+([a-zA-Z]+)/e", "\"$1\".\" \".ucfirst(\"$2\")", $new_string);
  // If this is a very low string ( > 60 char) then do some more replacements.
  if (strlen($new_string > 60)) {
    $search = array (" With "," That ");
    $replace = array (" with "," that ");
    $new_string = str_replace($search, $replace, $new_string);
  }
  return ($new_string);
}

// This is a simple html-excluding, max-column/character, word wrap function!
// This function will split a word, that is longer that $cols and is outside
// any html tags, by the string $cut. Lines with whitespace in them are ok, only
// single words over $cols length are split. (&shy; = safe-hyphen)
function wordwrap_excluding_html($str, $cols = 30, $cut = "&shy;") {
  $len = strlen($str);
  $tag = 0;
  for ($i = 0; $i < $len; $i++) {
    $chr = $str[$i];
    if ($chr == '<') {
      $tag++;
    } elseif ($chr == '>') {
      $tag--;
    } elseif ((!$tag) && ($chr==" " or $chr=="\n" or $chr=="\r" or $chr=="\t")) {
      $wordlen = 0;
    } elseif (!$tag) {
      $wordlen++;
    }
    if ((!$tag) && ($wordlen) && (!($wordlen % $cols))) {
      $chr .= $cut;
    }
    $result .= $chr;
  }
  return $result;
}

// This function will truncate a string to a specified length
// "excluding" any html tags in the length calculation.
// Split on html delimiters, count and then recombine with delimiters.
function truncate_string_excluding_html($str, $len = 150) {
  $wordlen = 0; // Total text length.
  $resultlen = 0; // Total length of html and text.
  $len_exceeded = false;
  $cnt = 0;
  $splitstr = array (); // String split by html tags including delimiter.
  $open_tags = array(); // Assoc. Array for Simple html Tags
  $str = str_replace(array("\n","\r","\t"), array (" "," "," "), $str); // Replace returns/tabs with spaces
  $splitstr = preg_split('/(<[^>]*>)/', $str, -1, PREG_SPLIT_DELIM_CAPTURE );
  //var_dump($splitstr);
  if (count($splitstr) > 0 && strlen($str) > $len) { // split
    while ($wordlen <= $len && $cnt <= 200 &&!$len_exceeded) {
      $part = $splitstr[$cnt];
      if (preg_match('/^<[A-Za-z]{1,}/', $part)) {
        $open_tags[strtolower(substr($match[0],1))]++;
      } else if (preg_match('/^<\/[A-Za-z]{1,}/', $part)) {
        $open_tags[strtolower(substr($match[0],2))]--;
      } else if (strlen($part) > $len-$wordlen) { // truncate remaining length
        $tmpsplit = explode("\n", wordwrap($part, $len-$wordlen));
        $part = $tmpsplit[0]; // Define the truncated part.
        $len_exceeded = true;
        $wordlen += strlen($part);
      } else {
        $wordlen += strlen($part);
      }
      $result .= $part; // Add the part to the $result
      $resultlen = strlen($result);
      $cnt++;
    }
    //echo "wordlen: $wordlen, resultlen: $resultlen<br />";
    //var_dump($open_tags);
    // Close the open html Tags (Simple Tags Only!). This excludes IMG and LI tags.
    foreach ($open_tags as $key=>$value) {
      if ($value > 0 && $key!= "" && $key!= null && $key!= "img" && $key!= "li") {
        for ($i=0; $i<$value; $i++) { $result .= "</".$key.">"; }
      }
    }
  } else {
    $result = $str;
  }
  return $result;
}

?>