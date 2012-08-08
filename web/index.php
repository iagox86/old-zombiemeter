<?php
	require_once('include/constants.php');
	require_once('include/functions.php');
	require_once('include/messages.php');

	require_once('cls/clsBreadcrumbs.php');
	require_once('cls/clsDB.php');
	require_once('cls/clsMiniMenu.php');
	require_once('cls/clsSetting.php');
	require_once('cls/clsTemplate.php');
	require_once('cls/clsUser.php');

	define('DEBUG', 0);

	session_start();
	clsSetting::load_settings();

	try
	{
		$strAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		$strSubAction = isset($_REQUEST['subaction']) ? $_REQUEST['subaction'] : '';
		$objBreadcrumbs = new clsBreadcrumbs();
		$objBreadcrumbs->add('Home', 'index.php');
		$objMiniMenu = new clsMiniMenu();

		if(!isset($_SESSION['objUser']))
		{
			$objUser = clsUser::getCookie();
		}
		else
		{
			$objUser = $_SESSION['objUser'];
		}

		if($objUser)
		{
			$objUser->set('ip', $_SERVER['REMOTE_ADDR']);
			$objUser->save();
		}
	
		if(!preg_match('/^[a-zA-Z2-9_-]*$/', $strAction))
			throw new Exception(ERRORMSG_INVALID);

		

		$objTemplate = new clsTemplate('default');
	
		$objTemplate->setText('SCRIPT', clsDB::initializeJS());
		$objTemplate->setText('TITLE', "ZombieMeter");

		if(isset($_REQUEST['error']) && isset($arrMessages[$_REQUEST['error']]))
			$objTemplate->setText('ERROR', $arrMessages[$_REQUEST['error']]);
		else if(isset($_REQUEST['message']) && isset($arrMessages[$_REQUEST['message']]))
			$objTemplate->setText('MESSAGE', $arrMessages[$_REQUEST['message']]);
	
		$objTemplate->setScript('MENU', 'menu');
	
		$objTemplate->setScript('LOGO',      'logo');
		$objTemplate->setScript('METER',     'meter');
		$objTemplate->setScript('COUNTRIES', 'top10');
		$objTemplate->setScript('ARCHIVE',   'archive');
		$objTemplate->setText('COPYRIGHT', "If you have any reports or incidents of zombie behaviour, or of suspected zombie behaviour, don't wait until it's too late! Send the report to <a href='mailto:alerts@zombiemeter.org'>ZombieMeter</a> before it's too late!<br><br>All text and graphics on ZombieMeter are copyrighted. If you wish to use them, feel free to <a href='mailto:admin@zombiemeter.org'>contact us</a> for permission. Feel free to link here if you like the site!");
	
		switch($strAction)
		{
			case '':
				$objTemplate->setScript('CONTENT', 'stories');
				break;
	
			case 'login':
				$objTemplate->setScript('CONTENT', 'login');
				break;
	
			case 'logout':
				$objTemplate->setScript('CONTENT', 'logout');
				break;

			case 'exception':
				$objTemplate->setScript('CONTENT', 'exception');
				break;

			case 'comment':
				$objTemplate->setScript('CONTENT', 'comment');
				break;

			case 'members':
				$objTemplate->setScript('CONTENT', 'members');
				break;

			case 'articles':
				$objTemplate->setScript('CONTENT', 'articles');
				break;

			case 'help':
				$objTemplate->setScript('CONTENT', 'help');
				break;

			case 'test':
				$objTemplate->setScript('CONTENT', 'test');
				break;

			case 'links':
				$objTemplate->setScript('CONTENT', 'links');
				break;

			case 'pz-quiz':
				$objTemplate->setScript('CONTENT', 'pz-quiz');
				break;

			default:
				$objTemplate->setText('CONTENT', 'error');
				break;
		}

		$objTemplate->setScript('BREADCRUMBS', 'breadcrumbs');
		$objTemplate->setScript('MINIMENU',    'minimenu');
		$objTemplate->setScript('WELCOME', 'welcome');
	
		echo $objTemplate->get();

	}
	catch(Exception $e)
	{
		$_SESSION['e'] = $e;
		header("Location: index.php?action=exception&message=" . $e->getMessage());
	}
?>
