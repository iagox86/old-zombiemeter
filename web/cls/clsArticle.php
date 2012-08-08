<?php
require_once('cls/clsDB.php');
require_once('cls/clsThumbnail.php');


class clsStory extends clsDB
{
	public function __construct($id = 0, $row = null)
	{
		parent::__construct('story', $id, $row);
	}

	public function getUsername()
	{
		$objUser = new clsUser($this->get('user_id'));

		if($objUser->isNew())
			return $this->get('username');

		return $objUser->get('username');
	}

	public function canEdit($objUser)
	{
		if(!$objUser)
			return false;

		if($objUser->get('is_admin'))
			return true;

		if($this->isNew())
			return true;

		return $objUser->get('id') == $this->get('user_id');
	}

	public function canDelete($objUser)
	{
		if(!$objUser)
			return false;

		if($objUser->get('is_admin'))
			return true;

		if($this->isNew())
			return false;

		return $objUser->get('id') == $this->get('user_id');
	}
}

?>
