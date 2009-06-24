<?php
lmb_require('limb/cache2/src/lmbCache.interface.php');

class lmbTaggableCache implements lmbCache
{
  /**
  * @var lmbCacheConnection
  */
  protected $connection;
  public $tags_prefix = 'tag42_';

  function __construct(lmbCacheConnection $connection)
  {
    $this->connection = $connection;
  }

  protected function _resolveTagsKeys($tags_keys)
  {
    if(is_array($tags_keys))
    {
      $new_keys = array();
      foreach($tags_keys as $pos => $key)
        $new_keys[] = $this->tags_prefix . $key;
    }
    else
      $new_keys = $this->tags_prefix . $tags_keys;

    return $new_keys;
  }

  protected function _createContainer($value, $tags)
  {
    $tags = $this->_resolveTagsKeys($tags);
    $tags_values = (array) $this->connection->get($tags);

    foreach($tags as $tag_key )
      if(!isset($tags_values[$tag_key]) || is_null($tags_values[$tag_key]))
    {
        $tags_values[$tag_key] = 0;
        $this->connection->add($tag_key, 0);
    }

    return array('tags' => $tags_values, 'value' => $value);
  }

  protected function _isTagsValid($tags)
  {
    $tags_versions = (array) $this->connection->get(array_keys($tags));

    foreach($tags_versions as $tag_key => $tag_version)
      if(is_null($tag_version) || $tags[$tag_key] != $tag_version)
        return false;

    return true;
  }

  protected function _getFromContainer($container)
  {
    if($this->_isTagsValid($container['tags']))
      return $container['value'];
    else
      return NULL;
  }

  protected function _prepareValue($value, $tags_keys)
  {
    if(!is_array($tags_keys))
      $tags_keys = array($tags_keys);

    return $this->_createContainer($value, $tags_keys);
  }

  function add($key, $value, $ttl = false, $tags_keys = 'default')
  {
    return $this->connection->add($key, $this->_prepareValue ($value, $tags_keys), $ttl);
  }

  function set($key, $value, $ttl = false, $tags_keys = 'default')
  {
    return $this->connection->set($key, $this->_prepareValue ($value, $tags_keys), $ttl);
  }

  function get($key)
  {
    if(is_null($container = $this->connection->get($key)))
      return NULL;

    if(is_null($value = $this->_getFromContainer($container)))
      $this->connection->delete($key);

    return $value;
  }

  function delete($key)
  {
    $this->connection->delete($key);
  }

  function deleteByTag($tag)
  {
    $tag = $this->_resolveTagsKeys($tag);
    $this->connection->safeIncrement($tag);
  }

  function flush()
  {
    $this->connection->flush();
  }
}
