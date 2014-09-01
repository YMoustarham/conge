<?php
/**
 *
 * User: GreyFox
 * Date: 9/1/14
 * Time: 11:24 PM
 */

	// put full path to Smarty.class.php
	require_once ('/../external/Smarty/libs/Smarty.class.php');
	$smarty = new Smarty();
	$smarty->setTemplateDir('../views');
	$smarty->setCompileDir('/smarty/templates_c');
	$smarty->setCacheDir('/smarty/cache');
	$smarty->setConfigDir('/smarty/configs');

