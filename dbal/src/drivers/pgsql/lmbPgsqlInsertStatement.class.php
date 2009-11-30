<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */
lmb_require('limb/dbal/src/drivers/lmbDbInsertStatement.interface.php');
lmb_require(dirname(__FILE__) . '/lmbPgsqlManipulationStatement.class.php');

/**
 * class lmbPgsqlInsertStatement.
 *
 * @package dbal
 * @version $Id$
 */
class lmbPgsqlInsertStatement extends lmbPgsqlManipulationStatement implements lmbDbInsertStatement
{
  function insertId($field_name = 'id')
  {
    $this->sql .= " RETURNING {$field_name}";
    $queryId = $this->execute();

    if(isset($this->parameters[$field_name]) && !empty($this->parameters[$field_name]))
      return $this->parameters[$field_name];
    else
      return $this->_getLastInsertId($queryId);
  }

  function _retriveTableName($sql)
  {
    preg_match('/INSERT\s+INTO\s+(\S+)/i', $sql, $m);
    //removing possible quotes
    $m[1] = str_replace('"','',$m[1]);
    return $m[1];
  }

  protected function _getLastInsertId($queryId)
  {
    $row = pg_fetch_row($queryId);
    pg_free_result($queryId);

    if(is_array($row))
      return $row[0];
  }
}


