<?php

use mini_projet\Managers\CategoryManager;

require_once '../models/Category.php';
require_once '../managers/CategoryManager.php';

$categoryManager = new CategoryManager($someArgument);
$categories = $categoryManager->findAll();

header('Content-Type: application/json');
echo json_encode($categories);
