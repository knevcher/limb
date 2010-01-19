<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package active_record
 * @version $Id$
 */
require_once('limb/core/common.inc.php');
lmb_package_require('validation');
lmb_package_require('dbal');

lmb_require('limb/active_record/toolkit.inc.php');
lmb_require('limb/active_record/src/lmbActiveRecord.class.php');

lmb_package_register('active_record', dirname(__FILE__));
