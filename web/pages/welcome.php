<?php

	if($objUser)
	{
?>
		Welcome back, <?=$objUser->get('username')?>! <br>
<?php
	}
	else
	{
?>
		Welcome, guest! You can <a href='index.php?action=login'>log in</a> or <a href='index.php?action=members&subaction=view'>register</a>.<Br>
		&nbsp;<br>
<?php
	}
?>
