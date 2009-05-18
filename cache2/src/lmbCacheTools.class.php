<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('limb/cache2/src/lmbCacheFactory.class.php');
lmb_require('limb/cache2/src/lmbMintCache.class.php');
lmb_require('limb/cache2/src/lmbLoggedCache.class.php');
lmb_require('limb/cache2/src/lmbTaggableCache.class.php');
/**
 * class lmbCacheTools.
 *
 * @package cache2
 * @version $Id: lmbCacheTools.class.php $
 */
class lmbCacheTools extends lmbAbstractTools
{
  protected $_cache = array();

  function getCache($name = 'default')
  {
    return $this->getCacheByName($name);
  }

  function getCacheByName($name)
  {
    if(isset($this->_cache[$name]) && is_object($this->_cache[$name]))
      return $this->_cache[$name];

    $this->_cache[$name] = $this->createCache($name);

    return $this->_cache[$name];
  }

  function createCache($name)
  {
    $conf = $this->toolkit->getConf('cache');

    $backend = $this->createCacheConnectionByName($name);

    if($conf->get('mint_cache_enabled', false))
      $backend = new lmbMintCache($backend);

    if ($conf->get('taggable_cache_enabled', false))
      $backend = new lmbTaggableCache($backend);

    if($conf->get('cache_log_enabled', false))
      $backend = new lmbLoggedCache($backend, $name);

    return $backend;
  }

  function createCacheConnectionByName($name)
  {
    $conf = $this->toolkit->getConf('cache');

    if($conf->get('cache_enabled'))
    {

      try
      {
        $dsn = lmbToolkit::instance()->getConf('cache')->get($name.'_cache_dsn');
        return $this->createCacheConnectionByDSN($dsn);
      }
      catch (Exception $e)
      {
        return $this->createCacheFakeConnection();
      }
    }
    else
      return $this->createCacheFakeConnection();
  }

  function createCacheFakeConnection()
  {
    return $this->createCacheConnectionByDSN('fake://localhost/');
  }

  function createCacheConnectionByDSN($dsn)
  {
    return lmbCacheFactory :: createConnection($dsn);
  }

  function setCache($cache, $name = 'default')
  {
    $this->_cache[$name] = $cache;
  }
}

