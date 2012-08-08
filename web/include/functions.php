<?php

function nl2brStrict($text, $replacement = '<br />')
{
	$text = preg_replace("((\r\n)+)", trim($replacement), $text);
	$text = preg_replace("((\n)+)",   trim($replacement), $text);
	$text = preg_replace("((\r)+)",   trim($replacement), $text);

	return $text;
}

/** This will take the query string from the server and replace a parameter in it with another
 * value.  This is useful for changing which column is being searched or which page is being 
 * displayed or something like that. */
function replaceParameterURL($strFieldName, $strNewValue, $strQueryString = null)
{
	return $_SERVER['PHP_SELF'] . '?' . replaceParameterQuery($strFieldName, $strNewValue, $strQueryString);
}

function replaceParameterQuery($strFieldName, $strNewValue, $strQueryString = null)
{
	if(!$strQueryString)
		$strQueryString = $_SERVER['QUERY_STRING'];

	$strQueryString = preg_replace("/$strFieldName=.*?&/", "&", $strQueryString);
	$strQueryString = preg_replace("/$strFieldName=.*?&/", "&", $strQueryString);
	$strQueryString = preg_replace("/$strFieldName=.*?$/", "&", $strQueryString);
	$strQueryString = preg_replace("/[&]+/",               "&", $strQueryString);

	return "$strQueryString&$strFieldName=$strNewValue";
}

function array_merge_keep_keys()
{
	$args = func_get_args();
	$result = array();
	foreach($args as &$array)
	{
		if(!is_array($array))
			throw new Exception('exception_internalerror');

		foreach($array as $key=>&$value)
		{
			$result[$key] = $value;
		}
	}
	return $result;
}

/** Cuts text off a certain point, attempting to put the cut after any html tags. */
function cut_text($strText, $intLength, $strMore = null)
{
	if(strlen($strText) <= $intLength)
		return $strText;

	$blnInHTML = false;
	$strRet = '';
	$i = 0;
	$count = 0;

	do
	{
		$c = substr($strText, $i, 1);
		$strRet = $strRet . $c;

		$i++;

		if($c == '<')
			$blnInHTML = true;
		else if($c == '>')
			$blnInHTML = false;

		if($blnInHTML && $intLength < strlen($strText))
			$intLength++;
	}
	while(($i < strlen($strText)) && ($i < $intLength || $c != ' ' || $blnInHTML));

	return trim($strRet) . '...' . ($strMore ? $strMore : '');
}

/** Slightly modified from php.net. */
function time_to_text($timestamp,$detailed=false, $max_detail_levels=8, $precision_level='second')
{
	if($timestamp == 0)
		return "never";

	$now = time();

	#If the difference is positive "ago" - negative "away"
	($timestamp > $now) ? $action = 'away' : $action = 'ago';
  
	# Set the periods of time
	$periods = array("second", "minute", "hour", "day", "week", "month", "year",   "decade");
	$lengths = array(1,        60,       3600,   86400, 604800, 2630880, 31570560, 315705600);

	$diff = ($action == 'away' ? $timestamp - $now : $now - $timestamp);

	if($diff > ($lengths[5] * 6)) /* Longer than 6 months ago. */
		return "on " . date('Y-m-d', $timestamp);
  
	$prec_key = array_search($precision_level,$periods);
  
	# round diff to the precision_level
	$diff = round(($diff/$lengths[$prec_key]))*$lengths[$prec_key];
  
	# if the diff is very small, display for ex "just seconds ago"
	if ($diff <= 10) 
	{
		$periodago = max(0,$prec_key-1);
		$agotxt = $periods[$periodago].'s';
		return "just $agotxt $action";
	}
  
	# Go from decades backwards to seconds
	$time = "";
	for ($i = (sizeof($lengths) - 1); $i>0; $i--) 
	{
		if($diff > $lengths[$i-1] && ($max_detail_levels > 0)) 		# if the difference is greater than the length we are checking... continue
		{
			$val = floor($diff / $lengths[$i-1]);	# 65 / 60 = 1.  That means one minute.  130 / 60 = 2. Two minutes.. etc
			$time .= $val ." ". $periods[$i-1].($val > 1 ? 's ' : ' ');  # The value, then the name associated, then add 's' if plural
			$diff -= ($val * $lengths[$i-1]);	# subtract the values we just used from the overall diff so we can find the rest of the information
			if(!$detailed) { $i = 0; }	# if detailed is turn off (default) only show the first set found, else show all information
				$max_detail_levels--;
		}
	}
 
	# Basic error checking.
	if($time == "") {
		return "Error-- Unable to calculate time.";
	} else {
		return $time.$action;
	}
}

function imgToString($img, $mime_type)
{
	ob_start(); /* Start output buffering (so we can capture the file). */

	switch($mime_type)
	{
		case 'image/jpeg':
			if(!@imagejpeg($img))
				return "tn_nosave";
			break;

		case 'image/png':
			if(!@imagepng($img))
				return "tn_nosave";
			break;

		case 'image/gif':
			if(!@imagegif($img))
				return "tn_nosave";
			break;

		default:
			return 'tn_filetype';
	}

	return ob_get_clean();
}

function imagepalettetotruecolor(&$img)
{
	if (!imageistruecolor($img))
	{
		$w = imagesx($img);
		$h = imagesy($img);
		$img1 = imagecreatetruecolor($w,$h);
		imagecopy($img1,$img,0,0,0,0,$w,$h);
		imagedestroy($img);
		$img = $img1;
	}

	return $img;
}

// based on http://www.phpit.net/article/create-bbcode-php/  
// modified by www.vision.to  
// please keep credits, thank you :-)  
// document your changes.  
  
function bbcode_format ($str) {  
  
    $simple_search = array(  
                //added line break  
                '/\[br\]/is',  
                '/\[b\](.*?)\[\/b\]/is',  
                '/\[i\](.*?)\[\/i\]/is',  
                '/\[u\](.*?)\[\/u\]/is',  
                '/\[url\=(http:\/\/.*?)\](.*?)\[\/url\]/is',  
                '/\[url\](http:\/\/.*?)\[\/url\]/is',  
                '/\[align\=(left|center|right)\](.*?)\[\/align\]/is',  
                '/\[img\](http:\/\/.*?)\[\/img\]/is',  
                '/\[mail\=(.*?)\](.*?)\[\/mail\]/is',  
                '/\[mail\](.*?)\[\/mail\]/is',  
                '/\[font\=(.*?)\](.*?)\[\/font\]/is',  
                '/\[size\=(.*?)\](.*?)\[\/size\]/is',  
                '/\[color\=(.*?)\](.*?)\[\/color\]/is',  
                  //added textarea for code presentation  
               '/\[codearea\](.*?)\[\/codearea\]/is',  
                 //added pre class for code presentation  
              '/\[code\](.*?)\[\/code\]/is',  
                //added paragraph  
              '/\[p\](.*?)\[\/p\]/is',  

              '/\[ul\](.*?)\[\/ul\]/is',  
              '/\[ol\](.*?)\[\/ol\]/is',  
              '/\[li\](.*?)\[\/li\]/is',  
              '/\[\*\]/is',  
              '/\[pre\](.*?)\[\/pre\]/is',  
              '/\[youtube\]([a-zA-Z0-9]*?)\[\/youtube\]/is',  
                );  
  
    $simple_replace = array(  
				//added line break  
               '<br />',  
                '<strong>$1</strong>',  
                '<em>$1</em>',  
                '<u>$1</u>',  
				// added nofollow to prevent spam  
                '<a href="$1" rel="nofollow" title="$2 - $1">$2</a>',  
                '<a href="$1" rel="nofollow" title="$1">$1</a>',  
                '<div style="text-align: $1;">$2</div>',  
				//added alt attribute for validation  
                '<img src="$1" alt="" />',  
                '<a href="mailto:$1">$2</a>',  
                '<a href="mailto:$1">$1</a>',  
                '<span style="font-family: $1;">$2</span>',  
                '<span style="font-size: $1;">$2</span>',  
                '<span style="color: $1;">$2</span>',  
				//added textarea for code presentation  
				'<textarea class="code_container" rows="30" cols="70">$1</textarea>',  
				//added pre class for code presentation  
				'<pre class="code">$1</pre>',  
				//added paragraph  
				'<p>$1</p>',  
				'<ul>$1</ul>',
				'<ol>$1</ol>',
				'<li>$1</li>',
				'<li>',
				'<pre>$1</pre>',
				'<object width="425" height="355"><param name="movie" value="http://www.youtube.com/v/$1"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/$1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="355"></embed></object>'
                );  

	$str = preg_replace ('/\[\[/', '&lbrak;', $str);
	$str = preg_replace ('/\]\]/', '&rbrak;', $str);

    // Do simple BBCode's  
    $str = preg_replace ($simple_search, $simple_replace, $str);  

	$str = preg_replace('/&lbrak;/', '[', $str);
	$str = preg_replace('/&rbrak;/', ']', $str);
  
    // Do <blockquote> BBCode  
    $str = bbcode_quote ($str);  
  
    return $str;  
}  

  
function bbcode_quote ($str) {  
    //added div and class for quotes  
    $open = '<blockquote><div class="quote">';  
    $close = '</div></blockquote>';  
  
    // How often is the open tag?  
    preg_match_all ('/\[quote\]/i', $str, $matches);  
    $opentags = count($matches['0']);  
  
    // How often is the close tag?  
    preg_match_all ('/\[\/quote\]/i', $str, $matches);  
    $closetags = count($matches['0']);  
  
    // Check how many tags have been unclosed  
    // And add the unclosing tag at the end of the message  
    $unclosed = $opentags - $closetags;  
    for ($i = 0; $i < $unclosed; $i++) {  
        $str .= '</div></blockquote>';  
    }  
  
    // Do replacement  
    $str = str_replace ('[' . 'quote]', $open, $str);  
    $str = str_replace ('[/' . 'quote]', $close, $str);  
  
    return $str;  
}  

?>
