<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url = load_class('Config')->config['base_url'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo $base_url.'assets/pg_admin/assets/img/favicon-16x16.png'; ?>" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo $base_url.'assets/pg_admin/assets/img/favicon-32x32.png'; ?>" sizes="32x32">

    <title>Altair Admin v2.10.0 - 404 error</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo $base_url.'assets/pg_admin/bower_components/uikit/css/uikit.almost-flat.min.css'; ?>"/>

    <!-- altair admin error page -->
    <link rel="stylesheet" href="<?php echo $base_url.'assets/pg_admin/assets/css/error_page.min.css'; ?>" />

</head>
<body class="error_page">
    <div class="error_page_header">
        <div class="uk-width-8-10 uk-container-center">
            <?php echo $heading; ?>
        </div>
    </div>
      <div class="error_page_content">
        <div class="uk-width-8-10 uk-container-center">
            <p class="heading_b">Page not found</p>
            <p class="uk-text-large">
                <?php echo $message; ?>
            </p>
            <a href="#" onclick="history.go(-1);return false;">Go back to previous page</a>
        </div>
    </div>
</body>
</html>
