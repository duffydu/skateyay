<?php
    require("app/app.php");
    $view_bag = [
        'title' => 'Skaters'
    ];

    if (isset($_GET['view'])) {
        // echo "division = " . $_GET['division'];
        if ($_GET['view'] == 'insert'){
            $view_bag['title'] = 'Insert';
            view('insert', $view_bag);
        } else if ($_GET['view'] == 'delete'){
            $view_bag['title'] = 'Delete';
            view('delete', $view_bag);
        } else if ($_GET['view'] == 'update'){
            $view_bag['title'] = 'Update';
            view('update', $view_bag);
        } else if ($_GET['view'] == 'group'){
            $view_bag['title'] = 'Group';
            view('group', $view_bag);
        } else if ($_GET['view'] == 'select'){
            $view_bag['title'] = 'View Data';
            view('select', $view_bag);
        }else if ($_GET['view'] == 'division'){
            $view_bag['title'] = 'Division';
            view('division', $view_bag);
        }
    } 
    else {
        if (isset($_GET['division'])) {
            $view_bag['title'] = 'Division Results';
            view('division', $view_bag);
        } else if (isset($_GET['selectSubmit'])) {
            $view_bag['title'] = 'View Table Results';
            view('select', $view_bag);
        } else if (isset($_GET['groupQueryRequest']) || isset($_GET['havingQueryRequest'])) {
            $view_bag['title'] = 'Skater Experience Results';
            view('group', $view_bag);
        }
    }    