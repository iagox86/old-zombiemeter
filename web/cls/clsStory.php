<?php
require_once('cls/clsDB.php');


class clsStory extends clsDB
{
	public function __construct($id = 0, $row = null)
	{
		parent::__construct('story', $id, $row);
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

	public function getComments()
	{
		return clsDB::getListStatic('comment', "`<<foreign><comment><story>>`='".$this->get('id')."'");
	}

	/** Retrieves the story object that changed the ZombieCon. */
	public static function getLevelStory()
	{
		$arrStories = clsDB::getListStatic('story', "`<<story><level>>` > 0", "date", "DESC", 0, 1);

		return sizeof($arrStories) ? $arrStories[0] : null;
	}

	/* Retrieves the current zombiecon level. */
	public static function getCurrentLevel()
	{
		$objStory = clsStory::getLevelStory();

		return $objStory ? $objStory->get('level') : 1;
	}

	/* Retrieve the date at which the zombiecon level was changed. */
	public static function getLevelDate()
	{
		$objStory = clsStory::getLevelStory();

		return $objStory ? time_to_text(strtotime($objStory->get('date'))) : "Never";
	}

	/* Get the top countries for zombie infections. */
	public static function getTopCountries($intNum = 10)
	{
		if(!is_numeric($intNum))
			throw new Exception(ERRORMSG_INVALID);

		$arrTemp = clsDB::selectQueryObjects('country', "
						SELECT SUM(`<<probability><weight>>`) AS `<<country><total>>` 	
						FROM `<<tbl><story>>` 
							JOIN `<<tbl><probability>>` ON `<<foreign><story><probability>>`=`<<probability><id>>`
						WHERE `<<isdel><story>>`='0'
							AND `<<isdel><probability>>`='0'
								");
		$intTotal = $arrTemp[0]->get('total');

		return clsDB::selectQueryObjects('country', "
			SELECT * FROM
			(
				SELECT `<<country><id>>`, `<<country><name>>`, SUM(`<<probability><weight>>`) AS `<<country><count>>`, SUM(`<<probability><weight>>`) / $intTotal AS `<<country><proportion>>`
					FROM `<<tbl><country>>` 
						JOIN `<<tbl><story>>` ON `<<country><id>>`=`<<foreign><story><country>>`
						JOIN `<<tbl><probability>>` ON `<<foreign><story><probability>>`=`<<probability><id>>`
					WHERE `<<isdel><country>>`='0'
						AND `<<isdel><story>>`='0'
						AND `<<foreign><story><country>>` != 0
					GROUP BY `<<country><id>>`
			) AS a
			ORDER BY `<<country><count>>` DESC
			LIMIT 0, $intNum
				");
	}

	public static function getNewest($intNum = 10)
	{
		return clsDB::getListStatic('story', "", 'date', 'DESC', 0, 8);
	}

	public static function getByCountry($intCountry)
	{
		if(!is_numeric($intCountry))
			$intCountry = 0;
		return clsDB::getListStatic('story', "`<<foreign><story><country>>`='" . $intCountry . "'");
	}

	public static function getByProbability($intProbability)
	{
		if(!is_numeric($intProbability))
			$intProbability = 0;

		return clsDB::getListStatic('story', "`<<foreign><story><probability>>`='" . $intProbability . "'");
	}
}

?>
