<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package tree
 * @version $Id$
 */
lmb_require('limb/tree/src/lmbTree.interface.php');
lmb_require('limb/core/src/lmbDecorator.class.php');
lmbDecorator :: generate('lmbTree', 'lmbTreeDecorator');


