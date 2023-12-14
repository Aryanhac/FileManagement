<?php

namespace OCA\FileManagement\AppInfo;

use OCP\AppFramework\App;
use OCA\FileManagementController\Controller\FileManagementController;

$app = new App('file_management');

// Define your routes here
$app->get('/', 'FileManagementController', 'index');
$app->post('/upload', 'FileManagementController', 'upload');
$app->get('/download/{id}', 'FileManagementController', 'download');
$app->get('/view/{id}', 'FileManagementController', 'view');
$app->delete('/delete/{id}', 'FileManagementController', 'delete');

return $app;
