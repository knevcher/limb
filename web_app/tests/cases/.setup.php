<?php

require_once(dirname(__FILE__) . '/../../common.inc.php');

require_once('limb/core/tests/cases/init.inc.php');
lmb_tests_init_var_dir(dirname(__FILE__) . '/../../../var');

require_once('limb/dbal/tests/cases/init.inc.php');
lmb_tests_init_db_dsn();