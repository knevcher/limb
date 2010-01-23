<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package dbal
 * @version $Id: toolkit.inc.php 7486 2009-01-26 19:13:20Z pachanga $
 */
lmb_require('limb/config/toolkit.inc.php');
lmb_require('limb/toolkit/src/lmbToolkit.class.php');
lmb_require('limb/log/src/toolkit/lmbLogTools.class.php');
lmbToolkit :: merge(new lmbLogTools());
