<?php

require_once('cls/clsDB.php');

class clsUser extends clsDB
{
	public function __construct($id = 0, $row = null)
	{
		parent::__construct('user', $id, $row);
	}

	/** Checks if the data loaded in this object matches anything from 
	 *  the database. */
	public function verify()
	{
		$username = $this->get('username');
		$password = $this->get('password');

		/* Prevent the password from being displayed back to the user if it fails. */
		$this->set('password', '');

		$arrResults = $this->getList("`<<user><username>>`='$username'");
		if(sizeof($arrResults) == 0)
			return false; // Username wasn't found 

		if(sizeof($arrResults) > 1)
			throw new Exception("exception_multiplenames");

		$objResult = $arrResults[0];

		$rightPassword = $objResult->get('password');

		if(md5($password . $username) == $rightPassword)
		{
			$this->set('id', $objResult->get('id'));
			$this->load();

			return true;
		}

		return false;
	}

	/** Returns the new user object on success, or an error message (string) otherwise.  To check the
	 * return value properly, use is_string or is_object.  */
	public function attemptCreate()
	{
		$username = $this->get('username');
		$password1 = $this->get('password1');
		$password2 = $this->get('password2');

		/* Prevent the password from being displayed back to the user if it fails. */
		$this->remove('password1');
		$this->remove('password2');

		if($password1 != $password2)
			return "register_dontmatch";

		if($password1 == '')
			return "register_blank";

		$arrDuplicates = $this->getList("`<<user><username>>`='$username'");
		if(sizeof($arrDuplicates) > 0)
			return "register_inuse";

		$objNewUser = new clsDB('user');
		$objNewUser->set('username', $username, false);
		$objNewUser->set('password', md5($password1 . $username));
		$objNewUser->set('date', date('Y-m-d H:i:s'));
		$objNewUser->save();

		return $objNewUser;
	}

	public function changePassword()
	{
		$password1 = $this->get('password1');
		$password2 = $this->get('password2');

		$this->remove('password1');
		$this->remove('password2');

		if($password1 != $password2)
			return "register_dontmatch";

		$this->set('password', md5($password1 . $this->get('username')));
	}

	public static function getUserList()
	{
		$arrUsers = clsDB::selectQueryObjects('user', 
							"SELECT `<<user><id>>` 
								FROM `<<tbl><user>>` 
								WHERE `<<isdel><user>>`='0' 
								ORDER BY `<<user><username>>`");
		$arrRet = array();
		foreach($arrUsers as $objUser)
			$arrRet[] = new clsUser($objUser->get('id'));

		return $arrRet;
	}

	public static function canEdit($objMember, $objUser)
	{
		if($objUser && $objUser->get('is_admin'))
			return true;

		if($objUser && ($objUser->get('id') == $objMember->get('id')))
			return true;

		if($objMember->isNew())
			return true;

		return false;
	}

	public function setCookie()
	{
		$intExpire = time() + (60*60*24*30);

		setcookie("zm_id", $this->get('id'), $intExpire);
		setcookie("zm_passhash", sha1($this->get('password')), $intExpire);
	}

	public static function getCookie()
	{
		if(!isset($_COOKIE['zm_id']))
			return null;

		if(!isset($_COOKIE['zm_passhash']))
			return null;

		$objUser = new clsUser($_COOKIE['zm_id']);
		if($objUser->isNew())
			return null;

		if(sha1($objUser->get('password')) == $_COOKIE['zm_passhash'])
		{
			/* Rejuvinate the cookie. */
			$objUser->setCookie();
			return $objUser;
		}

		return null;
	}


	public static function clearCookie()
	{
		setcookie('zm_id', null);
		setcookie('zm_passhash', null);
	}
}



?>
