<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * @tag pager:last:DISABLED
 * @parent_tag_class WactPagerNavigatorTag
 * @package wact
 * @version $Id$
 */
class WactPagerLastDisabledTag extends WactCompilerTag
{
  function generateTagContent($code)
  {
    $code->writePhp('if (' . $this->findParentByClass('WactPagerNavigatorTag')->getComponentRefCode() . '->isLast()) {');

    parent :: generateTagContent($code);

    $code->writePhp('}');
  }
}


