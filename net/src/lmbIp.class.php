<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * class lmbIp.
 *
 * @package net
 * @version $Id$
 */
class lmbIp
{
  const SIGNED   = 1;
  const UNSIGNED = 2;
  const USTRING  = 3;

  static function encode($ip, $mode = lmbIp::SIGNED)
  {
    switch($mode)
    {
      case self::SIGNED:
        return ip2long($ip);
      case self::UNSIGNED:
        // NOTE: may return a php int or float 
        return substr($ip, 0, 3) > 127 ? ((ip2long($ip) & 0x7FFFFFFF) + 0x80000000) : ip2long($ip); 
      case self::USTRING:
        return sprintf('%u', ip2long($ip));
      default:
        throw new lmbException("Unknow ip encode mode '$mode'");
    }
  }

  static function decode($numeric_ip)
  {
    return long2ip($numeric_ip);
  }

  static function encodeIpRange($ip_begin, $ip_end, $mode = lmbIp::SIGNED)
  {
    // Returns ip adressess array with in range $ip_begin - $ip_end
    if(!self::isValid($ip_begin) || !self::isValid($ip_end))
      throw new lmbException("Invalid IP range from '$ip_begin' to '$ip_end'");

    $start = self::encode($ip_begin, self::UNSIGNED);
    $end = self::encode($ip_end, self::UNSIGNED);
    $ip_list = array();
    for($i=$start; $i<=$end; $i++)
    {
      if($mode == self::UNSIGNED)
        $ip_list[] = $i;
      else if($mode == self::SIGNED)
        $ip_list[] = ip2long(long2ip($i));
      else if($mode == self::USTRING)
        $ip_list[] = sprintf('%u', ip2long(long2ip($i)));
      else
        throw new lmbException("Unknow ip encode mode '$mode'");
    }
    return $ip_list;
  }

  static function isValid($ip)
  {
    return ip2long($ip) !== false;
  }

  static function getRealIp()
  {
   if(!empty($_SERVER['HTTP_CLIENT_IP']))
     return $_SERVER['HTTP_CLIENT_IP'];

   elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
     return $_SERVER['HTTP_X_FORWARDED_FOR'];

   return self :: getRemoteIp();
  }

  static function getRemoteIp()
  {
    if(!empty($_SERVER['REMOTE_ADDR']))
     return $_SERVER['REMOTE_ADDR'];

    return NULL;
  }
}


