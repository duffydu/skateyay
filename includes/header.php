<?php 
    if (!isset($title)){
        $title = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>SKATEYAY - <?= $model['title']; ?> </title>
</head>
<body>
    <!-- Nav Bar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <a class="navbar-brand" href="#">SKATEYAY</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto topnav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="skaters.php?displayTupleRequest=&displayTuples=Submit">Skater Display Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="boards.php?displayTupleRequest=boards&displayTuples=Submit">Boards Display Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="master.php">Trick Help Center</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="query.php?view=select">View Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="query.php?view=group">Skater Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="query.php?view=division">Leadership Board</a>
                    </li>
                </ul>
            </div>
    
        </nav>
    </div>
    <div class="container">
