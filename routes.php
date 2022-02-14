<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

get('/', 'views/index.php');

any('/404','views/404.php');