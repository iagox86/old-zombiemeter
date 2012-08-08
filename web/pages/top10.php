<?php

	require_once('cls/clsStory.php');

	$arrCountries = clsStory::getTopCountries();

	print "<table>";
	print "<tr><td colspan='3' class='top10header'>Top Zombie Countries</td></tr>";
	$i = 1;
	foreach($arrCountries as $objCountry)
	{
		$intProportion = round($objCountry->get('proportion') * 100);
		print "<tr><td class='top10body'>$i.&nbsp;</td><td width='100' class='top10body'><a href='index.php?which=bycountry&details=" . $objCountry->get('id') . "'>" . $objCountry->get('name') . "</a></td><td align='right' class='top10body'>$intProportion%</td></tr>";
		$i++;
	}
	print "</table>";

//	print "<ol>";
//	foreach($arrCountries as $objCountry)
//	{
//		$intProportion = round($objCountry->get('proportion') * 100);
//		print "<li>" . $objCountry->get('name') . "</li>";
//	}
//	print "</ol>";


?>
