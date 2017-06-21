<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Address Book</title>

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body style="padding-top: 60px;">
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="clients.php" class="navbar-brand"><strong>MANAGER</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <?php
            if ($_SESSION['loggedInUser']) { // if user is logged in
            ?>
            <ul class="nav navbar-nav">
                <li><a href="clients.php">My Clients</a></li>
                <li><a href="add.php">Add Client</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">">
                <p class="navbar-text">Aloha, Pavlvs</p>
                <li><a href="logout.php">Log out</a></li>
            </ul>
            <?php
            } else {
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Log in</a></li>
            </ul>
            <?php
            }
            ?>
        </div>
    </div>
</nav>
<div class="container">
