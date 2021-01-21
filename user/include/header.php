<?php
session_start();
$current_url = $_SERVER['SERVER_NAME'] . '' . $_SERVER['REQUEST_URI'];
include("user.php");
$user = new User();
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EnakBenerCafe</title>
    <link rel="icon" type="image/png" href="../favicon.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

</head>
<body>

<?php
if (strpos($current_url, "active.php") === false) {
    include("nav.php");
}
?>