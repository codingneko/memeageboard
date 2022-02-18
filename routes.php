<?php
require_once("functions.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

get('/', 'views/index.php');

get('/users', 'views/users.php');

get('/upload', 'views/upload.php');
post('/upload', 'controllers/upload.php');

get('/tags', 'views/tags.php');

get('/login', 'views/login.php');
post('/login', 'controllers/login.php');

any('/404','views/404.php');