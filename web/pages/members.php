<?php
	require_once('cls/clsTemplate.php');
	require_once('cls/clsUser.php');

	$objBreadcrumbs->add('Members', 'index.php?action=members');

	$objMember = new clsUser();
	$objMember->getFromRequest();
	$objMember->load();

	if($strSubAction == '')
	{
		$objTemplate->setText('PAGETITLE', 'Member List');

		$arrUsers = clsDB::getListStatic('user');

		foreach($arrUsers as $objMember)
		{
			print "<a href='index.php?action=members&subaction=view&".$objMember->getIDPair()."'>".$objMember->get('username')."</a> " . ($objMember->get('is_admin') ? "(admin)" : "") . "<br>";
		}
	}

	if($strSubAction == 'view') /* View details for a particular user. */
	{
		if(clsUser::canEdit($objMember, $objUser))
		{
			if($objMember->isNew())
			{
				$objMember->getFromRequest(array('id', 'username', 'password1', 'password2', 'email', 'realname', 'location'));
				$objTemplate->setText('PAGETITLE', 'Registration');
				$objBreadcrumbs->add('Registration', "index.php?action=members&subaction=view");
			}
			else
			{
				$objTemplate->setText('PAGETITLE', 'Editing ' . $objMember->get('username'));
				$objBreadcrumbs->add('Registration', "index.php?action=members&subaction=view&".$objMember->getIDPair());
			}

			$objMemberTemplate = new clsTemplate('edituser');
			$objMemberTemplate->setText('HIDDEN', "<input type='hidden' name='action' value='members'>");
			$objMemberTemplate->setText('HIDDEN', "<input type='hidden' name='subaction' value='save'>");
			$objMemberTemplate->setText('HIDDEN', $objMember->getHiddenField('id'));

			if($objMember->isNew())
				$objMemberTemplate->setText('USERNAME', $objMember->getTextField('username'));
			else
				$objMemberTemplate->setText('USERNAME', $objMember->get('username'));
			$objMemberTemplate->setText('PASSWORD1', $objMember->getPasswordField('password1'));
			$objMemberTemplate->setText('PASSWORD2', $objMember->getPasswordField('password2'));
			$objMemberTemplate->setText('EMAIL', $objMember->getTextField('email'));

			if($objUser && $objUser->get('is_admin'))
			{
				$objMemberTemplate->setText('STORIES', $objMember->getCheckNoJavascript('can_post'));
				$objMemberTemplate->setText('ADMINISTRATOR', $objMember->getCheckNoJavascript('is_admin'));
			}
			else
			{
				$objMemberTemplate->setText('STORIES', $objMember->get('can_post') ? "Yes" : "No");
				$objMemberTemplate->setText('ADMINISTRATOR', $objMember->get('is_admin') ? "Yes" : "No");
			}

			$objMemberTemplate->setText('SAVE', $objMember->getSubmit('Save'));

			print $objMemberTemplate->get();
		}
		else
		{
			$objTemplate->setText('PAGETITLE', 'Viewing ' . $objMember->get('username'));
			$objBreadcrumbs->add($objMember->get('username'), "index.php?action=members&subaction=view&".$objMember->getIDPair());

			$objMemberTemplate = new clsTemplate('viewuser');
			$objMemberTemplate->setText('USERNAME', $objMember->get('username'));
			$objMemberTemplate->setText('REALNAME', $objMember->get('realname'));
			$objMemberTemplate->setText('LOCATION', $objMember->get('location'));

			print $objMemberTemplate->get();
		}
	}

	if($strSubAction == 'save') /* Save the user's details. */
	{
		if(!clsUser::canEdit($objMember, $objUser))
			throw new Exception('exception_accessdenied');

		if($objUser && $objUser->get('is_admin'))
			$objMember->getFromRequest(array('id', 'username', 'password1', 'password2', 'email', 'is_admin', 'can_post'));
		else
			$objMember->getFromRequest(array('id', 'username', 'password1', 'password2', 'email'));

		if($objMember->isNew())
		{
			$ret = $objMember->attemptCreate();
			if(is_string($ret))
			{
				$objMember->remove('password1');
				$objMember->remove('password2');
				header("Location: index.php?action=members&subaction=view&&error=$ret&" . $objMember->getQueryString());
			}
			else
			{
				$objUser = $ret;
				$_SESSION['objUser'] = $objUser;
				header("Location: index.php?message=register_successful");
			}
		}
		else
		{
			if(strlen($objMember->get('password1')))
			{
				$ret = $objMember->changePassword();
				if(is_string($ret))
				{
					header("Location: index.php?action=members&subaction=view&".$objMember->getIDPair()."&error=$ret");
					exit;
				}
			}
			$objMember->remove('password1');
			$objMember->remove('password2');
			$objMember->save();

			if($objMember->get('id') == $objUser->get('id'))
				$_SESSION['objUser'] = $objMember;

			header("Location: index.php?action=members&subaction=view&".$objMember->getIDPair()."&message=edit_successful");
		}

	}
?>
