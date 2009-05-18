<?php 
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */ 

/**
 * class lmbMacroDecodeIpFilter.
 *
 * @filter decode_ip
 * @package macro
 * @version $Id$
 */ 
class lmbMacroDecodeIpFilter extends lmbMacroFunctionBasedFilter
{
  protected $function = array('lmbIp', 'decode');
  protected $include_file = 'limb/net/src/lmbIp.class.php';
} 
