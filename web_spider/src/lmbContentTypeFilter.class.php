<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * class lmbContentTypeFilter.
 *
 * @package web_spider
 * @version $Id$
 */
class lmbContentTypeFilter
{
  protected $allowed_types;

  function lmbContentTypeFilter()
  {
    $this->reset();
  }

  function reset()
  {
    $this->allowed_types = array();
  }

  function allowContentType($type)
  {
    $this->allowed_types[] = strtolower($type);
  }

  function canPass($type)
  {
    if(!in_array($type, $this->allowed_types))
      return false;

    return true;
  }
}


