<?php 
    require("app/app.php");
    $view_bag = [
        'title' => 'Home'
    ];
    include("includes/header.php");
?>
<div class="container text-center">
    <h1 class="display-4">Welcome to the SKATEYAY Database!</h1>
    <img src="img/skaters.jpg" class="mx-auto d-block" alt="skaters">
</div>

<h2>Database Stats:</h2>

<?php 
    require('app/request_functions.php');
    if (connectToDB()) {
        handleCountRequest();
        disconnectFromDB();
    }

    if (isset($_POST['reset']) || 
        isset($_POST['deleteSubmit']) || 
        isset($_POST['insertSubmit'])
        ) 
    {
        handlePOSTRequest();
    } else if (isset($_GET['countTupleRequest']) || 
                isset($_GET['joinSubmit'])|| 
                isset($_GET['selectQueryRequest']) || 
                isset($_GET['groupQueryRequest']) || 
                isset($_GET['divisionQueryRequest'])||
                isset($_GET['havingQueryRequest']) ||
                isset($_GET['NestedQueryRequest'])) 
    {
        handleGETRequest();
    }

    include("./includes/footer.php");
?>
