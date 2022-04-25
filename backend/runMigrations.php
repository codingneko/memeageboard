<?php
    require_once('db/MigrationController.php');

    $migrationController = new MigrationController();

    $migrationController->migrateAll();