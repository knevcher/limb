<?php
require_once(dirname(__FILE__) . '/../../common.inc.php');
require_once('limb/dbal/src/lmbDbDump.class.php');
require_once('limb/core/src/lmbSet.class.php');
require_once('limb/core/src/lmbCollection.class.php');
require_once('limb/active_record/src/lmbActiveRecord.class.php');
require_once('limb/dbal/src/criteria/lmbSQLRawCriteria.class.php');
require_once('limb/dbal/src/lmbSimpleDb.class.php');
require_once('limb/dbal/src/lmbTableGateway.class.php');
require_once('limb/dbal/src/lmbSimpleDb.class.php');

$type = lmbToolkit :: instance()->getDefaultDbConnection()->getType();
$this->dump = new lmbDbDump(dirname(__FILE__) . '/.fixture/init_tests.' . $type);
$this->dump->load();

require_once(dirname(__FILE__) . '/lmbARBaseTestCase.class.php');


