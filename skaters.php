<?php 
    require("app/app.php");
    $view_bag = [
        'title' => 'Skaters'
    ];
    require('app/request_functions.php');

    if (isset($_POST['reset']) || 
        isset($_POST['deleteSubmit']) || 
        isset($_POST['insertSubmit']) || 
        isset($_POST['updateSubmit'])
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


    if (isset($_GET['req'])) {
        if ($_GET['req'] == 'insert'){
            $view_bag['title'] = 'Insert';
            view('insert', $view_bag);
        } else if ($_GET['req'] == 'delete'){
            $view_bag['title'] = 'Delete';
            view('delete', $view_bag);
        } else if ($_GET['req'] == 'update'){
            $view_bag['title'] = 'Update';
            view('update', $view_bag);
        } else if ($_GET['req'] == 'join'){
            $view_bag['title'] = 'Join';
            view('join', $view_bag);
        } else if ($_GET['req'] == 'group'){
            $view_bag['title'] = 'Group';
            view('group', $view_bag);
        } else if ($_GET['req'] == 'select'){
            $view_bag['title'] = 'Select';
            view('select', $view_bag);
        }else if ($_GET['req'] == 'division'){
            $view_bag['title'] = 'Division';
            view('division', $view_bag);
        }
    } else {
        view('skaters', $view_bag);
    }    

    include("./includes/footer.php");
?>

    



