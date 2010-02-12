<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */

/**
 * class lmbCurlRequest.
 *
 * @package net
 * @version $Id$
 */
class lmbCurlRequest
{
  protected $_url = '';
  protected $_handle;
  protected $_opts = array();
  
  protected $_error;
  protected $_request_status;

  function __construct($url = '')
  {
    if($url)
      $this->setUrl($url);
    
    $this->_initDefaultOptions();
  }
  
  function setUrl($url)
  {
    $this->_url = $url;
    $this->setOpt(CURLOPT_URL, $url);
  }
  
  function setTimeout($timeout)
  {
    $this->setOpt(CURLOPT_TIMEOUT_MS, $timeout); 
  }
  
  function open($post_data = '')
  {
    $this->_ensureCurl();
    if($post_data)
      $this->_setPostData($post_data);

    $this->_setupCurlOptions();
    return $this->_exec();
  }

  function setOpt($opt, $value)
  {
    $this->_opts[$opt] = $value;
  }

  protected function _initDefaultOptions()
  {
    $this->_opts = array(
      CURLOPT_HEADER => 0,
      CURLOPT_RETURNTRANSFER => 1,
    );
  }

  protected function _ensureCurl()
  {
    if(!is_resource($this->_handle))
      $this->_handle = curl_init();
  }

  protected function _setupCurlOptions()
  {
    foreach($this->_opts as $opt => $value)
      curl_setopt($this->_handle, $opt, $value);
  }

  protected function _exec()
  {
    $res = curl_exec($this->_handle);
    
    $this->_request_status = curl_getinfo($this->_handle, CURLINFO_HTTP_CODE);
    $this->_error = curl_error($this->_handle);
    
    $this->_resetCurl();
    
    return $res;
  }

  protected function _resetCurl()
  {
    if(is_resource($this->_handle))
      curl_close($this->_handle);
    
    $this->_opts = array();
  }

  protected function _setPostData($post_data)
  {
    if(!$post_data)
      return;

    $this->setOpt(CURLOPT_POST, 1);

    $var_string = '';
    foreach ($post_data as $k => $v)
      if(is_array($v))
      {
        foreach($v as $value)
        $var_string .= "{$k}[]={$value}&";
      }
      else
        $var_string .= "{$k}={$v}&";

    $this->setOpt(CURLOPT_POSTFIELDS, $var_string);
  }
  
  function getError()
  {
    return $this->_error;
  }

  function getRequestStatus()
  {
    return $this->_request_status;
  }
}


