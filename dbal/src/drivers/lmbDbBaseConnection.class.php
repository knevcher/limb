<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

lmb_require('limb/dbal/src/drivers/lmbDbConnection.interface.php');

/**
 * class lmbBaseDbConnection.
 * A base class for all connection classes
 *
 * @package dbal
 * @version $Id$
 */
abstract class lmbDbBaseConnection implements lmbDbConnection
{
  protected $config;
  protected $dsn_string;

  function __construct($config, $dsn_string = null)
  {
    $this->config = $config;
    if(is_object($config) && ($config instanceof lmbDbDSN))
      $this->dsn_string = $config->toString();
    else
      $this->dsn_string = $dsn_string;
  }

  function getConfig()
  {
    return $this->config;
  }

  function getHash()
  {
    return crc32(serialize($this->config));
  }

  function getDsnString()
  {
    return $this->dsn_string;
  }

  function __sleep()
  {
    return array('config','dsn_string');
  }
}


