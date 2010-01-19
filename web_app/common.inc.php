<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package web_app
 * @version $Id$
 */
require_once('limb/core/common.inc.php');
lmb_package_require('active_record');
lmb_package_require('session');

lmb_require('limb/web_app/toolkit.inc.php');
lmb_require('limb/web_app/http.inc.php');

lmb_package_register('web_app', dirname(__FILE__));
