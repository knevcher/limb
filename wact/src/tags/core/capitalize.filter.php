<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * @filter capitalize
 * @package wact
 * @version $Id$
 */
class WactCapitalizeFilter extends WactCompilerFilter
{
  function getValue()
  {
    if ($this->isConstant())
      return ucfirst($this->base->getValue());
    else
      $this->raiseUnresolvedBindingError();
  }

  function generateExpression($code_writer)
  {
    $code_writer->writePHP('ucfirst(');
    $this->base->generateExpression($code_writer);
    $code_writer->writePHP(')');
  }
}


