<?php

require_once('cls/clsStory.php');

$objStory = clsStory::getLevelStory();

$strData = file_get_contents('images/' . clsStory::getCurrentLevel() . '.png');

if($strData)
{
	header('Content-type: image/png');
	print $strData;
}
else
{
	print "Error";
}

?>
