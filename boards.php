<?php 
    require("app/app.php");
    $view_bag['title'] = "Boards";
    include("includes/header.php");
    
?>
        <h2>Boards</h2>
        <form method="GET" action="boards.php">
        <a role='button' class='btn btn-primary' href='boardsDetails.php?displayTupleRequest=details&displayTuples=Submit'>View all details</a>

 <?php  
    require('app/request_functions.php');
    if (isset($_POST['reset']) || 
        isset($_POST['updateSubmit']) || 
        isset($_POST['insertSubmit'])) {
        handlePOSTRequest();
    } else if (isset($_GET['countTupleRequest']) || 
                isset($_GET['displayTupleRequest'])) {
        handleGETRequest();
    } else if (isset($_GET['skaterIDtoDelete'])) {
        handleDeleteRequest();
    } else if (isset($_GET['skaterIDtoEdit'])) {
       handleUpdateRequest();
    }
    
    include("includes/footer.php");
    