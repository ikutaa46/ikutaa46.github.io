<?php
///////////////////////////////////////////////////////////////////////////
//  Product: Daddy's Link Protector					
//  Version: 1.X						     
//								
// by DaddyScripts.com						
//								        
///////////////////////////////////////////////////////////////////////////
session_start();
error_reporting (E_ALL ^ E_NOTICE);

/// General Site Config

$sitetitle = "Link Protector";
$siteslogan = "Protecting your links!";
$scripturl = "https://ikutaa46.github.io/"; // URL ENDING WITH A SLASH

// Short URL

$shorturl = false; // Set true to enable short url feature e.g. when turned on, it will display yoursite.com/103MySites instead of yoursite.com/index.php?ID=103MySites

// Top 10 List

$topten = true; // Set true to enable the Top 10 Links, or false to disable the Top 10 Links

?>