<?php

if (isset($_GET['route']) && $_GET["route"] === "category" && isset($_GET["category"])) {
    
    //index.php?route=category&category=1
    
    require "controllers/category.php";
    categoryPage();
    
} elseif (isset($_GET['route']) && $_GET["route"] === "post" && isset($_GET["post"])) {
    
    //index.php?route=post&post=42
    
    require "controllers/post.php";
    postPage();
} else {
    require "controllers/home.php";
    homePage();
}

?>