<?php
	require_once('include/constants.php');
	require_once('include/functions.php');
	require_once('include/messages.php');

	require_once('cls/clsDB.php');
	require_once('cls/clsSetting.php');
	require_once('cls/clsStory.php');
	require_once('cls/clsUser.php');

	session_start();
	clsSetting::load_settings();

	if(!isset($_SESSION['objUser']))
		$objUser = clsUser::getCookie();
	else
		$objUser = $_SESSION['objUser'];


	$objLog = new clsDB('rsslog');
	if($objUser)
		$objLog->set('user_id', $objUser->get('id'));
	$objLog->set('ip', $_SERVER['REMOTE_ADDR']);
	$objLog->set('date', date('Y-m-d H:i:s'));
	$objLog->save();

	try
	{
		header("Content-type: application/xhtml+xml");

		$arrStories = clsDB::getListStatic('story', '', 'date', 'DESC', 0, 20);

		print <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<!-- generator="wordpress/2.2.2" -->
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	>

<channel>
	<title>ZombieMeter</title>
	<link>http://www.zombiemeter.org</link>
	<description>On the lookout for zombies and zombie-related activities</description>
	<generator>http://www.zombiemeter.org</generator>
	<language>en</language>
	<ttl>10</ttl>

EOT;

		foreach($arrStories as $objStory)
		{
			$objStory = new clsStory($objStory->get('id'));
			$objStory->load();
			$intComments = sizeof($objStory->getComments());

			$link = "http://" . $_SERVER['HTTP_HOST'] . preg_replace("/\/[a-zA-Z0-9.]*$/", "/index.php?subaction=view&amp;".$objStory->getIDPair(), $_SERVER['PHP_SELF']);

			print "	<item>\n";
			print "		<title>" . $objStory->get('title') . ($intComments ? (" (" . sizeof($objStory->getComments()) . " comments)") : "") . "</title>\n";
			print "		<link>$link</link>\n";
			print "		<comments>$link</comments>\n";
			print "		<pubDate>" . date("D M j Y G:i:s T", strtotime($objStory->get('date'))) . "</pubDate>\n";
			print "		<dc:creator>" . $objStory->getFrom('user', 'username') . "</dc:creator>\n";
		
			print "		<category><![CDATA[" . ($objStory->get('is_article') ? "article" : "blog") . "]]></category>\n";

			print "		<guid isPermaLink=\"true\">$link</guid>\n";
			print "		<description><![CDATA[" . cut_text(bbcode_format(nl2br($objStory->get('text'))), 200) . "]]></description>\n";
			print "		<content:encoded><![CDATA[" . bbcode_format(nl2br($objStory->get('text'))) . "]]></content:encoded>\n";
			print "		<wfw:commentRss>" . $_SERVER['PHP_SELF'] . "</wfw:commentRss>\n";
			print "	</item>\n";
		}
		print "</channel>\n";
		print "</rss>\n";
	}
	catch(Exception $e)
	{
		$_SESSION['e'] = $e;
		header("Location: index.php?action=exception&message=" . $e->getMessage());
	}
?>
