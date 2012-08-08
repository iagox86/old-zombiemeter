<?php

	require_once('cls/clsStory.php');

	$arrCountries = clsStory::getTopCountries();

	print "<h3>Top zombie countries</h3>";

	print "<ol>";
	foreach($arrCountries as $objCountry)
	{
		$intProportion = round($objCountry->get('proportion') * 100);
		print "<li>($intProportion%) " . $objCountry->get('name') . "</li>";
	}
	print "</ol>";


?>
