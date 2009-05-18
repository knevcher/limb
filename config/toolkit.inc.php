<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package config
 * @version $Id$
 */
lmb_require('limb/toolkit/src/lmbToolkit.class.php');
lmb_require('limb/fs/toolkit.inc.php');
lmb_require('limb/config/src/lmbConfTools.class.php');
lmbToolkit :: merge(new lmbConfTools());


