<?php

	require_once('cls/clsComment.php');
	require_once('cls/clsStory.php');

	$objComment = new clsComment();
	$objComment->getFromRequest();
	$objComment->load();

	$objStory = new clsStory();
	$objStory->getFromRequest();
	$objStory->load();

	if($strSubAction == 'edit')
	{
		if(!$objComment->canEdit($objUser))
			throw new Exception('exception_accessdenied');


		$objBreadcrumbs->add($objStory->get('title'), 'index.php?subaction=view&'.$objStory->getIDPair());
		$objBreadcrumbs->add('Post comment', 'comment.php?action=edit&'.$objStory->getIDPair().'&'.$objComment->getIDPair());

		$objCommentTemplate = new clsTemplate('editcomment');
		$objCommentTemplate->setText('HIDDEN', $objComment->getHiddenField('id'));
		$objCommentTemplate->setText('HIDDEN', $objStory->getHiddenField('id'));
		$objCommentTemplate->setText('HIDDEN', "<input type='hidden' name='action' value='comment'>");
		$objCommentTemplate->setText('HIDDEN', "<input type='hidden' name='subaction' value='save'>");

		if($objUser)
			$objCommentTemplate->setText('NAME', '<strong>' . $objUser->get('username') . '</strong>');
		else
			$objCommentTemplate->setText('NAME', $objComment->getTextField('username'));

		/* Set a default title if it's not present. */
		if(!$objComment->exists('title'))
			$objComment->set('title', 'Re: ' . $objStory->get('title'), false);

		$objCommentTemplate->setText('TITLE', $objComment->getTextField('title'));
		$objCommentTemplate->setText('COMMENT', $objComment->getTextArea('text', 5, 60));
		$objCommentTemplate->setText('SUBMIT', $objComment->getSubmit('Save'));

		print $objCommentTemplate->get();
	}
	else if($strSubAction == 'save')
	{
		if(!$objComment->canEdit($objUser))
			throw new Exception('exception_accessdenied');

		$objComment->getFromRequest(array('id', 'username', 'title', 'text'));
		$objComment->set('story_id', $objStory->get('id'));
		$objComment->set('date', date('Y-m-d H:i:s'));

		if($objComment->isNew())
		{
			if($objUser)
			{
				$objComment->set('user_id', $objUser->get('id'));
				$objComment->set('username', $objUser->get('username'));
			}

			$objComment->set('ip', $_SERVER['REMOTE_ADDR']);
		}

		$objComment->save();

		header("Location: index.php?subaction=view&" . $objStory->getIDPair());
	}
	else if($strSubAction == 'delete')
	{
		if(!$objComment->canDelete($objUser))
			throw new Exception('exception_accessdenied');

		$objStory = $objComment->getForeignObject('story');

		$objComment->delete();
		$objComment->save();

		header("Location: index.php?subaction=view&" . $objStory->getIDPair());
	}
?>
