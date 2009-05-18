<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * interface WactTemplateConfig.
 *
 * @package wact
 * @version $Id$
 */
interface WactTemplateConfig
{
  function isForceScan();
  function isForceCompile();
  function getCacheDir();
  function getScanDirectories();
  function getSaxFilters();
}


