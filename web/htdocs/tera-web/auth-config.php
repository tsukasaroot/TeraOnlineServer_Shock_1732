<?php
if(basename($_SERVER["PHP_SELF"]) == "auth-config.php") 
{
    die("403 - Access Forbidden");
}

//SQL Information
$host['hostname'] = 'localhost'; // Hostname
$host['user'] = 'root'; // Database Username
$host['password'] = ''; // Database Password
$host['database'] = 'terax'; // Database Name

//Account Information
$database['table'] = 'accounts'; // Database [AccountTable]
$database['username'] = 'login'; // Database [AccountTable ->Username]
$database['password'] = 'password'; // Database [AccountTable -> Password]

//Database Prefix
$prefix = "prefix_";  //not used for now


/* Don`t touch. */
$mysqli = new MySQLi($host['hostname'],$host['user'],$host['password'],$host['database']);
?>
