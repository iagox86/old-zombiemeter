<?php

	$objTemplate->setText("PAGETITLE", "Is Your Friend a Zombie?");

	$arrQuestions = array();


	$arrQuestions[] = array("<strong>Is the Potential Zombie...</strong> Slurring their words", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Unable to walk properly?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Wanting to eat your flesh?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Slow moving?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Showing signs of <i>rigor mortis</i>?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Smell like rotting flesh?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Inability to swim since they cannot float in water?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Showing signs of slow moving bodily fluids (<i>Livor Mortis</i>)", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Attacking friends and loved ones", "Not sure", "No", "Yes");
	$arrQuestions[] = array("<strong>Is the flesh...</strong> Falling off their bones?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Pallid or discoloured?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Cold to the touch?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Missing?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Did you witness the Potential Zombie being bitten by a zombie?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Have you observed the Potential Zombie biting other humans?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Can the Potential Zombie survive underwater for long lengths of time?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Is the Potential Zombie unaffected by gun shots to the body?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Does the Potential Zombie react to hearing their name being called out?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Have you observed the Potential Zombie attacking and devouring animals?", "Not sure", "No", "Yes");
	$arrQuestions[] = array("Is the Potential Zombie missing any body parts?", "Not sure", "No", "Yes");

	$arrScores = array(1, 0, 2);
	$intMaxScore = 2;
	$intTotalMaxScore = $intMaxScore * sizeof($arrQuestions);

	/* 20 questions -> range is -20 - 40 */
	$arrResults = array();

	$arrResults[10] = "The person is definitely not a zombie. In fact, he's more human than most humans! You may rest easily.";

	$arrResults[20] = "It is highly likely that the person you think is a Potential Zombie is in fact drunk or just tired. College students the day after a party are commonly confused as Potential Zombies since they exhibit some of these signs. But be vigilant; zombie infections have been documented to take as long as one week to turn their victim. If you discover the condition of the Potential Zombie worsening, it may be time to take action.";

	$arrResults[30] = "More tests will need to be conducted to accurately determine if this is in fact a real zombie. Do not take any risks in trying to conduct these tests yourself unless you are an certified zombie hunter.";

	$arrResults[40] = "Destroy the brain of the undead immediately and begin your contingency plan. You must act fast as you are in the presence of a zombie. If you cannot destroy the brain, you must gather your loved ones (as long as they have had no contact with the zombie) and run a far away as possible.";



	if(!isset($_REQUEST['submit']))
	{

		print "While walking downtown one evening, I found it quite difficult to differentiate real zombies from the street people. The street people (or non-zombies) exhibited signs that are common to zombies but upon further inspection, they were determined to be on a different kind of drug.<br><br>";

		print "So the correspondents of ZombieMeter have produced a Zombie Test. This will help determine if your Potential Zombie is in fact, a real zombie. Note: this test is not conclusive and ZombieMeter does not guarantee results in any manner. Please use this as one of your tools for zombie determination. ZombieMeter is not responsible for the actions of its readers and the possibility that a real human may be mistaken for a zombie and exterminated.";


	print "<hr>";
		print "<form action='index.php' method='post'>\n";
		print "<input type='hidden' name='action' value='pz-quiz'>";

		$i = 0;
		foreach($arrQuestions as $arrQuestion)
		{
			print "	" . $arrQuestion[0] . "<br>\n";

			for($j = 1; $j < sizeof($arrQuestion); $j++)
				print "		<input type='radio' name='question$i' value='" . $arrScores[$j - 1] . "' " . ($j == 1 ? "checked" : '') . "> " . $arrQuestion[$j] . "<br>\n";

			print "		<hr>\n";
			$i++;
		}

		print "		<input type='submit' name='submit' value='Get results'>\n";
		print "	</form>";
	}
	else
	{
		$i = 0;
		$intTotal;

		while(isset($_REQUEST["question$i"]))
		{
			$intTotal += $_REQUEST["question$i"];
			$i++;
		}

		print "<p>You scored $intTotal points out of a maximum of $intTotalMaxScore</p>";

		print "<strong><em>";

		foreach($arrResults as $val=>$str)
		{
			if($intTotal <= $val)
			{
				print $str;
				break;
			}
		}
		print "</em></strong>";

		print "<hr><a href='index.php?action=pz-quiz'>Back</a>";
	}


?>
