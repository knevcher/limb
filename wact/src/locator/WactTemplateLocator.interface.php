<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * interface WactTemplateLocator.
 *
 * @package wact
 * @version $Id$
 */
interface WactTemplateLocator
{
  public function locateCompiledTemplate($fileName);
  public function locateSourceTemplate($fileName);

  public function readTemplateFile($fileName);
}

