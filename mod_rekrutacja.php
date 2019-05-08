<?php
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
$mod = new Helper;
require_once dirname(__FILE__) . '/mailer.php';
$mail = new Mailer;

require JModuleHelper::getLayoutPath('mod_rekrutacja');
?>