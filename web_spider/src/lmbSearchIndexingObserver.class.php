<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * class lmbSearchIndexingObserver.
 *
 * @package web_spider
 * @version $Id$
 */
class lmbSearchIndexingObserver
{
  protected $counter = 0;
  protected $indexer;

  function __construct($indexer)
  {
    $this->indexer = $indexer;
  }

  function notify($reader)
  {
    $uri = $reader->getUri();

    $this->counter++;

    echo "{$this->counter})started indexing " . $uri->toString() . "...";

    $this->indexer->index($uri, $reader->getContent());

    echo "done\n";
  }
}


