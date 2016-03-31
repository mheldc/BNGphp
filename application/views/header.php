<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $asset_url = str_replace('index.php/','assets',base_url());
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <link rel="icon" href="<?php echo $asset_url.'/favicon.ico'; ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title>Billing Notice Generator</title>
        <link rel="stylesheet" href="<?php echo $asset_url.'/lib/bootstrap/css/bootstrap.min.css'; ?>"/>
        <link rel="stylesheet" href="<?php echo $asset_url.'/lib/font-awesome/css/font-awesome.min.css'; ?>"/>
        <link rel="stylesheet" href="<?php echo $asset_url.'/lib/bootstrap/css/bootstrap-datetimepicker.min.css'; ?>"/>
        <style>
            .tab-content {
                border-left: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
                padding: 10px;
            }
            
            .nav-tabs {
                margin-bottom: 0;
            }
        </style>
    </head>
    <body style="font-family: Calibri;">
