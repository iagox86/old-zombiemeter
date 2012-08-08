<?php

require_once('cls/clsDB.php');


class clsSetting extends clsDB
{
    public function __construct()
    {
        parent::__construct('setting');
    }

	public static function load_settings()
	{
		$arrSettings = clsDB::getListStatic('setting');

		foreach($arrSettings as $objSetting)
		{
			define($objSetting->get('name'), $objSetting->get('value'));
		}
	}
}
