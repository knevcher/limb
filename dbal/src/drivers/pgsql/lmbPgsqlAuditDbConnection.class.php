<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */
lmb_require('limb/dbal/src/drivers/lmbAuditDbConnection.class.php');
/**
 * class lmbPgsqlAuditDbConnection.
 * Remembers stats for later analysis, especially useful in tests
 * @package dbal
 * @version $Id$
 */
class lmbPgsqlAuditDbConnection extends lmbAuditDbConnection
{
  protected $_statement_number = 0;

  function getStatementNumber()
  {
    return ++$this->_statement_number;
  }

  function executeStatement($stmt)
  {
    $info = array();
    $info['trace'] = $this->getTrace();
    $start_time = microtime(true);

    $res = parent :: executeStatement($stmt);
    $info['time'] = round(microtime(true) - $start_time, 6);

    $info['query'] = $this->_replaceProperties($stmt->getSQL(), $stmt->getParameters());

    $this->stats[] = $info;
    return $res;
  }

  protected function _replaceProperties($sql, $parameters)
  {
    $keys = array();
    foreach($parameters as $key => $value)
      $keys[] = ":{$key}:";

    return str_replace($keys, $parameters, $sql);
  }

  function _raiseError($msg)
  {
    $connection_id = lmbToolkit :: instance()->getDefaultDbConnection()->getConnectionId();
    throw new lmbException($msg . ($connection_id ? ' last pgsql driver error: ' . pg_last_error($connection_id) : ''));
  }
}