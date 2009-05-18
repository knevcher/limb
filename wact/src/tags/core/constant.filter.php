<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * @filter const
 * @package wact
 * @version $Id$
 */
class WactConstantFilter extends WactCompilerFilter
{
  function getValue()
  {
    return constant($this->base->getValue());
  }

  function generateExpression($code_writer)
  {
    $code_writer->writePHP('@constant(');
    $this->base->generateExpression($code_writer);
    $code_writer->writePHP(')');
  }
}


