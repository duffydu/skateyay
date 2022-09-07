
<?php 
    require("app/app.php");
    include("includes/header.php");

    echo "<h2>Boards Details</h2>";

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

