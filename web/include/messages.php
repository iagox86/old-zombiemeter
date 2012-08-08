<?php
	$arrMessages = array();

	$arrMessages['test']                      = "Testing!";

	$arrMessages['login_failed']              = "Sorry, either your username or password was incorrect.";
	$arrMessages['login_successful']          = "Successfully logged in.";
	$arrMessages['logout_failed']             = "Sorry, your logout failed. This isn't actually possible, and this error isn't used anywhere, so congratulations on finding it!";
	$arrMessages['logout_successful']         = "Successfully logged out.";
	$arrMessages['register_inuse']            = "Sorry, that username is already in use. Please pick another.";
	$arrMessages['register_dontmatch']        = "Your passwords don't match, please try again.";
	$arrMessages['register_blank']            = "Please don't use a blank password.";
	$arrMessages['register_successful']       = "Your account is now registered. Enjoy!";

	$arrMessages['edit_successful']           = "Changes have been saved.";

	$arrMessages['exception_multiplenames']   = "Multiple users are using the same name. This shouldn't be possible; please report a bug!";
	$arrMessages['exception_templatemissing'] = "Template not found!";
	$arrMessages['exception_accessdenied']    = "Access Denied.";
	$arrMessages['exception_notloggedin']     = "You have to be logged in to perform that action. If you got here by clicking a link, please report a bug!";
	$arrMessages['exception_invalidrequest']  = "An invalid request was made. Please try again and/or report a bug!";
	$arrMessages['exception_internalerror']   = "An internal error has occurred. Please report a bug!";

	$arrMessages['image_nosave']              = "Couldn't save the image.";
	$arrMessages['image_noresize']            = "Couldn't resize the image.";
	$arrMessages['image_filetype']            = "Unknown filetype.";

	$arrMessages['tn_nosave']                 = "Couldn't save thumbnail.";
	$arrMessages['tn_noresize']               = "Couldn't resize thumbnail.";
	$arrMessages['tn_filetype']               = "Unknown filetype.";

?>
