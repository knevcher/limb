<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */


/**
 * Interface for filter classes to be used with lmbFilterChain
 *
 * @version $Id$
 * @package filter_chain
 */
interface lmbInterceptingFilter
{
  /**
   * Runs the filter.
   * Filters should decide whether to pass control to the next filter in the chain or not.
   * @see lmbFilterChain :: next()
   *
   * @param lmbFilterChain filters chain
   * @return void
   */
  function run($filter_chain);
}


