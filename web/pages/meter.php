<?php

require_once('cls/clsStory.php');

$objStory = clsStory::getLevelStory();
$intLevel = clsStory::getCurrentLevel();

print("<a href='index.php?action=help&subaction=levels'><img src=\"images/$intLevel.png\" alt=\"ZombieCon Level $intLevel\"></a><br>");
print "<a href='index.php?subaction=view&" . $objStory->getIDPair() . "'>Updated " . clsStory::getLevelDate() . "</a><br>";
/*
print "<h3>ZombieCon</h3>";
print "Current level is: " . clsStory::getCurrentLevel();
*/
?>
