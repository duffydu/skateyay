<h2>All talented skaters!</h2>
<a class="btn btn-primary" href="skaters.php?req=insert" role="button">Add</a>
<?php
    
    if (connectToDB()) {
        global $db_conn;
        $result = handleDisplaySkatersRequest();
        printAllSkaterResult($result);
        disconnectFromDB();
    }

    function printAllSkaterResult($result) { //prints results from a select statement
            
        echo "<table class='table table-hover table-striped'>";
        echo "<thead>";
        echo "<tr><th scope='col'><strong>ID</strong></th>
                    <th scope='col'><strong>Name</strong></th>
                    <th scope='col'><strong>Years Of Skating</strong></th>
                    <th scope='col'><strong>Hometown</strong></th>
                    <th scope='col'><strong>Social Media</strong></th>
                    <th scope='col'><strong>Delete Option</strong></th>
                    <th scope='col'><strong>Update Option</strong></th></tr>";
        echo "</thead>";
    
    
        echo "<tbody>";
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row[0] .
                 "</td><td>" . $row[1] .
                 "</td><td>" . $row[2] .
                 "</td><td>" . $row[3] .
                 "</td><td>" . $row[4] .
                  "</td><td><form method='POST' action='skaters.php'>
                  <input type='hidden' id='deleteQueryRequest' name='deleteQueryRequest'>
                  <input type='hidden' name='skaterIDtoDelete' value='"  . $row[0] . "'>
                  <input type='submit' class='btn btn-secondary' value='Delete' name='deleteSubmit'></form>" .
                 "</td><td>" . "<a class='btn btn-info' role='button' href='skaters.php?req=update&skaterIDtoEdit="  . $row[0] ."'> Edit </a></button>" .
                  "</td></tr>";
        }
    
        echo "</tbody>";
        echo "</table>";
    }