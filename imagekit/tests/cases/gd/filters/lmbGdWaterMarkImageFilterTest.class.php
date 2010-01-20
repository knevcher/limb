<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */
lmb_require('limb/imagekit/src/gd/filters/lmbGdWaterMarkImageFilter.class.php');
lmb_require('limb/imagekit/tests/cases/filters/lmbBaseWaterMarkImageFilterTest.class.php');

/**
 * @package imagekit
 * @version $Id$
 */
class lmbGdWaterMarkImageFilterTest extends lmbBaseWaterMarkImageFilterTest
{
  protected $driver = 'gd';
}