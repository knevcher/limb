<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package core
 * @version $Id$
 */
$_ENV['LIMB_LAZY_CLASS_PATHS'] = array();
define('LIMB_UNDEFINED', 'undefined' . microtime());

function lmb_env_has($name)
{
  if(array_key_exists($name, $_ENV))
  {
    if($_ENV[$name] === LIMB_UNDEFINED)
      return false;
    else
      return true;
  }

  if(defined($name))
    return true;

  return false;
}

function lmb_env_get($name, $def = null)
{
  if(array_key_exists($name, $_ENV))
  {
    if($_ENV[$name] === LIMB_UNDEFINED)
      return $def;
    else
      return $_ENV[$name];
  }

  if(defined($name))
    return constant($name);

  return $def;
}

function lmb_env_setor($name, $value)
{
  if(!array_key_exists($name, $_ENV))
  {
    if(defined($name))
    {
       $_ENV[$name] = constant($name);
    }
    else
    {
      $_ENV[$name] = $value;
      define($name, $value);
    }
  }

  if(lmb_env_trace_has($name))
    lmb_env_trace_show();
}

function lmb_env_set($name, $value)
{
  $_ENV[$name] = $value;

  if(!defined($name))
    define($name, $value);

  if(lmb_env_trace_has($name))
    lmb_env_trace_show();
}

function lmb_env_remove($name)
{
  $_ENV[$name] = LIMB_UNDEFINED;
}

function lmb_env_trace($name)
{
  lmb_env_setor('profile' . $name . LIMB_UNDEFINED, true);
}

function lmb_env_trace_has($name)
{
  return lmb_env_has('profile' . $name . LIMB_UNDEFINED);
}

function lmb_env_trace_show()
{
  $trace = debug_backtrace();
  $trace = $trace[1];

  $file_str = 'Called '.$trace['file'].'@'.$trace['line'];
  $call_str = $trace['function'].'('.$trace['args'][0].','.$trace['args'][1].')';
  echo $file_str.' '.$call_str.PHP_EOL;
}

function lmb_resolve_include_path($path)
{
  if(function_exists('stream_resolve_include_path'))
    return stream_resolve_include_path($path);

  foreach(lmb_get_include_path_items() as $dir)
  {
    $full_path = "$dir/$path";
    if(is_file($full_path) || is_dir($full_path))
      return $full_path;
  }
}

function lmb_is_readable($file)
{
  $fh = @fopen($file, 'r', true);
  if(!is_resource($fh))
    return false;

  fclose($fh);
  return true;
}

function lmb_glob($path)
{
  if(lmb_is_path_absolute($path))
    return glob($path);

  $result = array();
  foreach(lmb_get_include_path_items() as $dir)
  {
    if($res = glob("$dir/$path"))
    {
      foreach($res as $item)
         $result[] = $item;
    }
  }
  return $result;
}

function lmb_get_include_path_items()
{
  return explode(PATH_SEPARATOR, get_include_path());
}

function lmb_is_path_absolute($path)
{
  if(!$path)
    return false;

  //very trivial check, is more comprehensive one required?
  return (($path{0} == '/' || $path{0} == '\\') ||
          (strlen($path) > 2 && $path{1} == ':'));
}

function lmb_require($file_path, $class = '')
{
  static $tried = array();

  if(isset($tried[$file_path . $class]))
    return;
  else
    $tried[$file_path . $class] = true;

  //do we really need this stuff here?

  if(strpos($file_path, '*') !== false)
  {
    $file_paths = lmb_glob($file_path);
    if(is_array($file_paths))
      foreach($file_paths as $path)
        lmb_require($path);

    return;
  }

  if(!$class)
  {
    //autoguessing class or interface name by file
    $file = basename($file_path);
    $items = explode('.', $file);

    if(isset($items[1]))
    {
      if($items[1] == 'class' || $items[1] == 'interface')
        $class = $items[0];
    }
  }

  if($class)
  {
    $_ENV['LIMB_LAZY_CLASS_PATHS'][$class] = $file_path;
    return;
  }

  if(!include_once($file_path))
    throw new lmbException("Could not include source file '$file_path'");
}

function lmb_require_class($file_path, $class = '')
{
  if(!$class)
  {
    //autoguessing class or interface name by file
    $file = basename($file_path);
    $items = explode('.', $file);
    $class = $items[0];
  }

  $_ENV['LIMB_LAZY_CLASS_PATHS'][$class] = $file_path;
}

function lmb_require_glob($file_path)
{
  if(strpos($file_path, '*') !== false)
  {
    foreach(lmb_glob($file_path) as $path)
      lmb_require($path);
  }
  else
    lmb_require($path);
}

function lmb_require_optional($file_path)
{
  if(!lmb_is_readable($file_path))
    return;

  lmb_require($file_path);
}

function lmb_autoload($name)
{
  if(isset($_ENV['LIMB_LAZY_CLASS_PATHS'][$name]))
  {
    $file_path = $_ENV['LIMB_LAZY_CLASS_PATHS'][$name];
    //is it safe to use include here instead of include_once?
    if(!include($file_path))
      throw new lmbException("Could not include source file '$file_path'");
  }
}

function lmb_var_dump($obj, $echo = false)
{
  ob_start();
  var_dump($obj);
  $dump = ob_get_contents();
  ob_end_clean();

  if($echo)
  {
    if(PHP_SAPI != 'cli')
    {
      echo '<pre>';
      echo $dump;
      echo '</pre>';
    }
    else
      echo $dump;
  }
  else
    return $dump;
}

function lmb_camel_case($str, $ucfirst = true)
{
  //if there are no _, why process at all
  if(strpos($str, '_') === false)
    return ($ucfirst) ? ucfirst($str) : $str;

  $items = explode('_', $str);
  $len = sizeof($items);
  $first = true;
  $res = '';
  for($i=0;$i<$len;$i++)
  {
    $item = $items[$i];
    if($item)
    {
      //we don't ucfirst first word by default
      $res .= ($first && !$ucfirst ? $item : ucfirst($item));
      $first = false;
      //skipping next "_" if it's not last
      if($i+1 < $len-1 && !$items[$i+1])
        $i++;
    }
    else
      $res .= '_';
  }

  return ($ucfirst) ? ucfirst($res) : $res;
}

function lmb_under_scores($str)
{
  //caching repeated requests
  static $cache = array();
  if(isset($cache[$str]))
    return $cache[$str];

  $items = preg_split('~([A-Z][a-z0-9]+)~', $str, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
  $res = '';
  foreach($items as $item)
    $res .= ($item == '_' ? '' : '_') . strtolower($item);
  $res = substr($res, 1);
  $cache[$str] = $res;
  return $res;
}

function lmb_humanize($str)
{
  return str_replace('_', ' ', lmb_under_scores($str));
}

function lmb_plural($word)
{
  $plural_rules = array(
    '/person$/' => 'people', # person, salesperson
    '/man$/' => 'men', # man, woman, spokesman
    '/child$/' => 'children', # child
    '/(?:([^f])fe|([lr])f)$/' => '\1\2ves', # half, safe, wife
    '/([ti])um$/' => '\1a', # datum, medium
    '/(x|ch|ss|sh)$/' => '\1es', # search, switch, fix, box, process, address
    '/series$/' => '\1series',
    '/([^aeiouy]|qu)ies$/' => '\1y',
    '/([^aeiouy]|qu)y$/' => '\1ies', # query, ability, agency
    '/sis$/' => 'ses', # basis, diagnosis
    '/(.*)status$/' => '\1statuses',
    '/s$/' => 's', # no change (compatibility)
    '/$/' => 's'
  );

  $result = $word;
  foreach($plural_rules as $pattern => $repl)
  {
    $result = preg_replace ($pattern, $repl, $word);
    if ($result!= $word) break;
  }
  return $result;
}

lmb_require('limb/core/src/exception/lmbException.class.php');

spl_autoload_register('lmb_autoload');


