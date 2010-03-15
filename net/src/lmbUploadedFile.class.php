<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */
lmb_require('limb/core/src/lmbObject.class.php');

/**
 * class lmbUploadedFile.
 *
 * @package net
 * @version $Id$
 */
class lmbUploadedFile extends lmbObject
{
  protected $_error_messages = array(
    0 => 'No errors during file uploading',
    UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
    UPLOAD_ERR_NO_FILE => 'No file was uploaded',
    UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
    UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
  );


  function getFilePath()
  {
    return $this->getTmpName();
  }

  function getMimeType()
  {
    return $this->getType();
  }

  function move($dest)
  {
    return move_uploaded_file($this->getTmpName(), $dest);
  }

  function isUploaded()
  {
    return is_uploaded_file($this->getTmpName());
  }

  function isValid()
  {
    return $this->getError() == UPLOAD_ERR_OK;
  }

  function getContents()
  {
    return file_get_contents($this->getTmpName());
  }

  function destroy()
  {
    unlink($this->getTmpName());
  }

  function getErrorMessage()
  {
    return isset($this->_error_messages[$this->getError()]) ? $this->_error_messages[$this->getError()] : 'Unknown file upload error';
  }
}


