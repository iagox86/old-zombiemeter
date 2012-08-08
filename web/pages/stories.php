<?php
	require_once('cls/clsComment.php');
	require_once('cls/clsParameters.php');
	require_once('cls/clsStory.php');
	require_once('cls/clsTemplate.php');


	$objStory = new clsStory();
	$objStory->getFromRequest();
	$objStory->load();

	$objMiniMenu->add('All Articles', 'index.php?subaction=articles');
	$objMiniMenu->add('All Stories', 'index.php?subaction=archive');

	if($strSubAction == '')
	{
		$objTemplate->setText('PAGETITLE', 'Home');

		if($objUser && $objUser->get('can_post'))
			$objMiniMenu->add('Post Story', 'index.php?subaction=edit');

		$strWhich = isset($_REQUEST['which']) ? $_REQUEST['which'] : '';
		$strDetails = isset($_REQUEST['details']) ? $_REQUEST['details'] : '';
		$arrStories = array();

		if($strWhich == '')
			$arrStories = clsStory::getNewest();
		else if($strWhich == 'bycountry')
		{
			$objCountry = new clsDB('country', $strDetails);
			$objTemplate->setText('PAGETITLE', " -- " . $objCountry->get('name'));
			$arrStories = clsStory::getByCountry($objCountry->get('id'));
		}
		else if($strWhich == 'byprobability')
		{
			$objProbability = new clsDB('probability', $strDetails);
			$objTemplate->setText('PAGETITLE', " -- " . $objProbability->get('name') . " probability");
			$arrStories = clsStory::getByProbability($objProbability->get('name'));
		}
	
		foreach($arrStories as $objStory)
		{
			$objStory = new clsStory($objStory->get('id'));
			$objStoryTemplate = new clsTemplate('story');
		
			$objStoryUser = $objStory->getForeignObject('user');
			$objAlbum = $objStory->getForeignObject('album');


			$objStoryTemplate->setText('ID',       $objStory->get('id'));
			$objStoryTemplate->setText('USERID',   $objStoryUser->get('id'));
			$objStoryTemplate->setText('USERNAME', $objStoryUser->get('username'));
			$objStoryTemplate->setText('DATE',     time_to_text(strtotime($objStory->get('date'))));
			$objStoryTemplate->setText('TITLE',    "<a href='index.php?subaction=view&".$objStory->getIDPair()."'>".$objStory->get('title')."</a>");
			$objStoryTemplate->setText('TEXT',     cut_text(bbcode_format(nl2br($objStory->get('text'))), 500, "<br><br><a href='index.php?subaction=view&".$objStory->getIDPair()."'>Read More...</a>"));
			$objStoryTemplate->setText('COMMENTS', "<a href='index.php?subaction=view&".$objStory->getIDPair()."'>".sizeof($objStory->getComments())."</a> comments");

			if($objStory->get('is_article'))
				$objStoryTemplate->setText('ISARTICLE', '(article)');

			if($objStory->canEdit($objUser))
				$objStoryTemplate->setText('EDIT', "[<a href='index.php?subaction=edit&".$objStory->getIDPair()."'>edit</a>] ");

			if($objStory->canDelete($objUser))
				$objStoryTemplate->setText('DELETE', "[<a href='index.php?subaction=delete&".$objStory->getIDPair()."'>delete</a>]");
	
			echo $objStoryTemplate->get();
		}

		print "<a href='index.php?subaction=archive'>More Stories...</a>";
	}

	if($strSubAction == 'edit')
	{
		if(!$objStory->canEdit($objUser))
			throw new Exception("exception_accessdenied");

		$objStory->load();

		$objStoryTemplate = new clsTemplate('editstory');
		$objStoryTemplate->setText('HIDDEN', "<input type='hidden' name='subaction' value='save'>");
		$objStoryTemplate->setText('HIDDEN', $objStory->getHiddenField('id'));
		$objStoryTemplate->setText('TITLE', $objStory->getTextField('title', new clsParameters('size', 40)));
		$objStoryTemplate->setText('ISBLOG', $objStory->getCombo('is_article', array(0=>"Blog", 1=>"Article")));
		$objStoryTemplate->setText('WARNING', $objStory->getCombo('level', array(0=>"N/A", 1=>"Low (1)", 2=>"Moderate (2)", 3=>"Elevated (3)", 4=>"High (4)", 5=>"Extreme (5)")));
		$objStoryTemplate->setText('COUNTRY', $objStory->getCombo('country_id', clsDB::getOptionsFromTable('country', 'name', 'id', 'N/A', 'name')));
		$objStoryTemplate->setText('PROBABILITY', $objStory->getCombo('probability_id', clsDB::getOptionsFromTable('probability', 'name', 'id', 'N/A', 'id')));
		$objStoryTemplate->setText('STORY', $objStory->getTextArea('text', 10, 45));
		$objStoryTemplate->setText('SUBMIT', $objStory->getSubmit('Post'));

		print $objStoryTemplate->get();
	}

	if($strSubAction == 'view')
	{
		$objTemplate->setText('PAGETITLE', $objStory->get('title'));
		if($objUser && !$objUser->isNew())
			$objMiniMenu->add('Post Comment', 'index.php?action=comment&subaction=edit&'.$objStory->getIDPair());

		$objStory = new clsStory($objStory->get('id'));
		$objStoryTemplate = new clsTemplate('story');
		
		$objStoryUser = $objStory->getForeignObject('user');
		$objAlbum = $objStory->getForeignObject('album');

		$objStoryTemplate->setText('ID',       $objStory->get('id'));
		$objStoryTemplate->setText('USERID',   $objStoryUser->get('id'));
		$objStoryTemplate->setText('USERNAME', $objStoryUser->get('username'));
		$objStoryTemplate->setText('DATE',     time_to_text(strtotime($objStory->get('date'))));
		$objStoryTemplate->setText('TITLE',    $objStory->get('title'));
		$objStoryTemplate->setText('TEXT',     nl2br(bbcode_format($objStory->get('text'))));

		if($objStory->get('is_article'))
			$objStoryTemplate->setText('ISARTICLE', '(article)');

		if($objStory->canEdit($objUser))
			$objStoryTemplate->setText('EDIT', "[<a href='index.php?subaction=edit&".$objStory->getIDPair()."'>edit</a>] ");

		if($objStory->canDelete($objUser))
			$objStoryTemplate->setText('DELETE', "[<a href='index.php?subaction=delete&".$objStory->getIDPair()."'>delete</a>]");
	
		echo $objStoryTemplate->get();

		foreach($objStory->getComments() as $objComment)
		{
			$objComment = new clsComment($objComment->get('id'));

			$objCommentTemplate = new clsTemplate('comment');
			$objCommentTemplate->setText('TITLE', $objComment->get('title'));
			$objCommentTemplate->setText('USERNAME', $objComment->getUsername());
			$objCommentTemplate->setText('DATE', time_to_text(strtotime($objComment->get('date'))));
			$objCommentTemplate->setText('TEXT', bbcode_format(nl2br($objComment->get('text'))));

			if($objComment->canEdit($objUser))
				$objCommentTemplate->setText('EDIT', "[<a href='index.php?action=comment&subaction=edit&".$objComment->getIDPair()."'>edit</a>] ");

			if($objComment->canDelete($objUser))
				$objCommentTemplate->setText('DELETE', "[<a href='index.php?action=comment&subaction=delete&".$objComment->getIDPair()."'>delete</a>]");
	
			print $objCommentTemplate->get();
		}
	}

	if($strSubAction == 'save')
	{
		$objStory->getFromRequest(array('id', 'title', 'is_article', 'text', 'level', 'country_id', 'probability_id'));
		if(!$objStory->canEdit($objUser))
			throw new Exception("exception_accessdenied");

		if($objStory->isNew())
		{
			$objStory->set('user_id', $objUser->get('id'));
			$objStory->set('date', date('Y-m-d H:i:s'));
		}
		$objStory->save();

		header("Location: index.php");
	}

	if($strSubAction == 'delete')
	{
		if(!$objStory->canDelete($objUser))
			throw new Exception("exception_accessdenied");

		$objStory->delete();
		$objStory->save();

		header("Location: index.php");
	}

	if($strSubAction == 'articles')
	{
		$arrArticles = clsDB::getListStatic('story', "`<<story><is_article>>`='1'");
	
		$objTemplate->setText('PAGETITLE', 'Articles');
		$objBreadcrumbs->add('Articles', 'index.php?action=articles');
	
		print "<table>";
		print "<tr><th align='left'>Title</th><th align='left'>Posted By</th><th align='left'>Date</th></tr>";
		foreach($arrArticles as $objArticle)
		{
			print "<tr>";
			print "<td width='350'><a href='index.php?subaction=view&" . $objArticle->getIDPair() . "'>" . $objArticle->get('title') . "</a></td><td width='100'>" . $objArticle->getFrom('user', 'username') . "</td><td width='100'>" . date('Y-m-d', strtotime($objArticle->get('date'))) . "</td>";
			print "</tr>";
		}
		print "</table>";
	}

	if($strSubAction == 'archive')
	{
		$arrArticles = clsDB::getListStatic('story', '', 'date', 'DESC');
	
		$objTemplate->setText('PAGETITLE', 'Archive');
		$objBreadcrumbs->add('Articles', 'index.php?action=articles');
	
		print "<table>";
		print "<tr><th align='left'>Title</th><th align='left'>Posted By</th><th align='left'>Date</th></tr>";
		foreach($arrArticles as $objArticle)
		{
			print "<tr>";
			print "<td width='350'><a href='index.php?subaction=view&" . $objArticle->getIDPair() . "'>" . $objArticle->get('title') . "</a></td><td width='100'>" . $objArticle->getFrom('user', 'username') . "</td><td width='100'>" . date('Y-m-d', strtotime($objArticle->get('date'))) . "</td>";
			print "</tr>";
		}
		print "</table>";
	}

?>
