<?php
/**
 * Debug configuration file
 * Enable full error reporting for development
 * 
 * USAGE:
 *      include 'debug_config.php';
 * 
 * IMPORTANT:
 * - Do NOT include this in production unless actively debugging.
 * - Comment out the 'include "bin/debug_config.php';"
 */

// Display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Enable MySQLi error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>