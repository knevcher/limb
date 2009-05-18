<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */
lmb_require('limb/config/src/lmbIni.class.php');

/**
 * class lmbFakeIni.
 *
 * @package config
 * @version $Id$
 */
class lmbFakeIni extends lmbIni
{
  function __construct($contents)
  {
    $this->_parseLines(explode("\n", $contents));
  }
}


