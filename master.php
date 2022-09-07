<?php
    require("app/app.php");
    $view_bag = [
        'title' => 'Trick Help Center'
    ];

    $view_bag['title'] = 'Trick Help Center';
    view('master', $view_bag);

    require('app/request_functions.php');

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

