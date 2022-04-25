<?php
require_once("functions.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// Migration deployment
get('/runMigrations', 'backend/runMigrations.php');

// Image views
get('/', 'views/index.php');
get('/image/$id', 'views/image.php');

// User views
get('/users', 'views/users.php');
get('/user/$user_name', 'views/user.php');

get('/upload', 'views/upload.php');
post('/upload', 'backend/upload.php');

//Tag views
get('/tags', 'views/tags.php');
get('/tag/$tag_name', 'views/tag.php');

// UAC pages
get('/login', 'views/login.php');
post('/login', 'backend/login.php');

get('/register', 'views/register.php');
post('/register', 'backend/register.php');

//Server error pages
any('/404','views/404.php');