<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * Exception 'Image create is failed'
 * 
 * @package imagekit
 * @version $Id$
 */
class lmbImageCreateFailedException extends lmbException 
{

  function __construct($file_name)
  {
  	parent::__construct('Image create is failed', array('file' => $file_name));
  }

}
