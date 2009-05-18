<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * class lmbFullPageCacheUser.
 *
 * @package web_cache
 * @version $Id$
 */
class lmbFullPageCacheUser
{
  protected $groups;

  function __construct($groups = array())
  {
    $this->groups = $groups;
  }

  function getGroups()
  {
    return $this->groups;
  }
}


