<?php

function view($name, $model) {
    // global $view_bag;
    require("layout.view.php");
}

function printResult($result, $mode) { //prints results from a select statement
    
        echo "<table class='table table-hover table-striped'>";
        echo "<thead>";
        if ($mode == 'Count') {
            echo "<tr><th scope='col'>Table Name</th>
                    <th scope='col'># of Tuples</th></tr>";
        } else if ($mode == 'Join'){
            echo "<tr><th scope='col'>SkaterID</th>
                    <th scope='col'>SkaterName</th>
                    <th scope='col'>YearOfSkating</th>
                    <th scope='col'>Hometown</th>
                    <th scope='col'>SocialMedia</th>
                    <th scope='col'>TrickName</th>
                    <th scope='col'>Familiarity</th></tr>";
        } else if ($mode =='Group'){
            echo "<tr><th scope='col'>HomeTown</th>
                    <th scope='col'>Average Year of Skating</th></tr>";
        } else if ($mode == 'Division') {
            echo "<tr><th scope='col'>SkaterID</th>
                    <th scope='col'>SkaterName</th>
                    <th scope='col'>YearOfSkating</th>
                    <th scope='col'>Hometown</th>
                    <th scope='col'>SocialMedia</th></tr>";
        } else if ($mode =='Having'){
            echo "<tr><th scope='col'>Organization Name</th>
                    <th scope='col'>Average Year of Skating</th></tr>";
        } else if ($mode == 'NestedGroupBy') {
            echo "<tr><th scope='col'>HomeTown</th>
                    <th scope='col'>SkaterName</th>
                    <th scope='col'>SocialMedia</th>
                    <th scope='col'>Familiarity</th></tr>";
        } else if ($mode == 'boards'){
            echo "<tr><th>ProductNum</th> 
                    <th>BrandName</th>
                    <th>BoardName</th>
                    <th>BoardType</th></tr>";
        } else if ($mode == 'boardsDetail'){
            echo "<tr><th>ProductNum</th> 
                    <th>BrandName</th>
                    <th>BoardName</th>
                    <th>Kicktail</th>
                    <th>BoardLength</th>
                    <th>BoardType</th></tr>";
        }
        echo "</thead>";

        if ($mode != 'Count') { 
            printTuples($result); 
            echo "</table>";
        }
}

function queryAndPrintColNames($tableName){
    $tableName = strtoupper($tableName);
    $colNames = executePlainSQL("SELECT column_name FROM USER_TAB_COLUMNS WHERE table_name = '{$tableName}'");
    // outputting column names
    echo "<thead>";
    echo "<tr>";
    while ($row = oci_fetch_array($colNames, OCI_ASSOC)) {
        foreach ($row as $item) {
            echo "<th scope='col'><strong>" . $item . "</strong></th>";
        }
    }
    echo "</tr>";
    echo "</thead>";
}

function printSelectionResult($selected, $result) { 
    // echo "<br>Retrieved data from {$selected} Table:<br>";
    echo "<table class='table table-hover table-striped'>";

    // outputting column names 
    queryAndPrintColNames($selected);

    // outputting tuples
    printTuples($result);
    echo "</table>";
}

function printTuples($result){
    echo "<tbody>";
    // echo "fetch array = ";
    // $arr = [];
    // echo oci_fetch_all($result, $arr);
    if (!$row = oci_fetch_array($result, OCI_ASSOC)) {
        echo "<div class='alert alert-warning' role='alert'>
        No such data point satisfying the query in our database</div>";
        echo "<tr>";
            foreach ($row as $item) {
                echo "<td>" . $item . "</td>";
            }
        echo "</tr>";
    } else {
        echo "<tr>";
            foreach ($row as $item) {
                echo "<td>" . $item . "</td>";
            }
        echo "</tr>";
        while ($row = oci_fetch_array($result, OCI_ASSOC)) {
            echo "<tr>";
            foreach ($row as $item) {
                echo "<td>" . $item . "</td>";
            }
            echo "</tr>";
        }
    } 
    echo "</tbody>";
}
   

function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
    //echo "<br>running ".$cmdstr."<br>";
    global $db_conn, $success;

    $statement = OCIParse($db_conn, $cmdstr);
    //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
        echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
        echo htmlentities($e['message']);
        $success = False;
    }

    return $statement;
}

function executeBoundSQL($cmdstr, $list) {
    /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
In this case you don't need to create the statement several times. Bound variables cause a statement to only be
parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
See the sample code below for how this function is used */

    global $db_conn, $success;
    $statement = OCIParse($db_conn, $cmdstr);

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
        echo htmlentities($e['message']);
        $success = False;
    }

    foreach ($list as $tuple) {
        foreach ($tuple as $bind => $val) {
            //echo $val;
            //echo "<br>".$bind."<br>";
            OCIBindByName($statement, $bind, $val);
            unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
        }

        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
            echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
            echo htmlentities($e['message']);
            echo "<br>";
            $success = False;
        }
    }
}
