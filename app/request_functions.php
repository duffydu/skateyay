<?php
        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['skaterID'],
                ":bind2" => $_POST['skaterName'],
                ":bind3" => $_POST['yearOfSkating'],
                ":bind4" => $_POST['homeTown'],
                ":bind5" => $_POST['socialMedia']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into Skater values (:bind1, :bind2, :bind3, :bind4, :bind5)", $alltuples);
            OCICommit($db_conn);
        }

        function handleDeleteRequest() {
            global $db_conn;
            
            $IDtoDelete = $_POST['skaterIDtoDelete'];
            executePlainSQL("delete from Skater" . " where SkaterID = '{$IDtoDelete}'");
            OCICommit($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;
            if (connectToDB()) {
            $ID = $_POST["skaterID"];
            $NAME = $_POST["skaterName"];
            $YOS = $_POST["yearOfSkating"];
            $homeTown = $_POST["homeTown"];
            $socialMedia = $_POST["socialMedia"];
            executePlainSQL("UPDATE Skater SET SkaterID = '" .$ID . "', YearOfSkating = '" .$YOS . "', SocialMedia = '" .$socialMedia . "',HomeTown = '" .$homeTown . "', SkaterName = '" .$NAME . "' WHERE SkaterID = '" .$ID. "'");
            $result = executePlainSQL("UPDATE Skater SET SkaterID = '" .$ID . "', YearOfSkating = '" .$YOS . "', SocialMedia = '" .$socialMedia . "', HomeTown = '" .$homeTown . "', SkaterName = '" .$NAME . "' WHERE SkaterID = '" .$ID. "'");
            if ($result){
                header('location:skaters.php?displayTupleRequest=&displayTuples=Submit');
            }
            OCIcommit($db_conn);
            disconnectFromDB();
         }
        }

        function handleDisplaySkatersRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Skater");
            return $result;
        }

        function handleJoinRequest() {
            global $db_conn;

            $trick_name = $_GET['trickName'];
            $familiarity = $_GET['familiarity'];

            $result = executePlainSQL("SELECT * FROM Skater 
                             JOIN CanDo
                             ON Skater.SkaterID = CanDo.SkaterID
                             WHERE TrickName = '" . $trick_name . "' and Familiarity =" . $familiarity);
            printResult($result, 'Join');
        }

        function handleNestedGroupByRequest() {
            global $db_conn;
            $trick_name = $_GET['trickName'];

            $result = executePlainSQL("SELECT HomeTown, SkaterName, SocialMedia, MAX(Familiarity) FROM (SELECT * FROM Skater, CanDo WHERE Skater.SkaterID = CanDo.SkaterID) WHERE TrickName = '" . $trick_name . "' GROUP BY HomeTown, SkaterName, SocialMedia");
            printResult($result, 'NestedGroupBy');                     
        }

        function handleCountRequest() {
            global $db_conn;
            
            $tables = executePlainSQL("SELECT table_name FROM user_tables");
            printResult($tables, 'Count');
            echo "<tbody>";
            while ($row = oci_fetch_array($tables, OCI_ASSOC)) {
                echo "<tr>";
                foreach ($row as $item) {
                    $count = executePlainSQL("SELECT Count(*) FROM {$item}");
                    echo "<td>" . $item . "</td>";
                    if ($row = oci_fetch_row($count)) {
                        echo "<td>" . $row[0] . "</td>";
                    } else {
                        echo "<td>0</td>";
                    }
                }
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            // if (($row = oci_fetch_row($result)) != false) {
            //     echo "<br> The number of tuples in Skater Table: " . $row[0] . "<br>";
            // }
        }

        function handleDivisionRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Skater S WHERE NOT EXISTS ((SELECT E.eventName FROM Events E) MINUS (SELECT P.eventName FROM Participate P WHERE S.skaterID = P.skaterID))");
            
            printResult($result, 'Division');
        }

        function handleSelectRequest() {
            global $db_conn;
 
            $selected = $_GET['selectedTable'];
            $attribute = $_GET['selectedAttribute'];
            $searchName = $_GET['searchName'];
            $searchedTable = $selected;

            // Resolve some naming inconsistency issue
            if ($searchedTable == 'Organization') {
                $searchedTable = 'Org';
            }
            if ($searchedTable == 'Brands') {
                $searchedTable = 'Brand';
            }
            if ($searchedTable == 'Events') {
                $searchedTable = 'Event';
            }
            if ($searchedTable == 'Tricks') {
                $searchedTable = 'Trick';
            }

            if ($selected) {
                // If the user did not enter search word or did not choose attribute, display all the data.
                if ($attribute && $searchName) {
                    if ($attribute == 'Name') {
                        if ($selected != 'SkateLocation') {
                            $result = executePlainSQL("SELECT * FROM {$selected} WHERE {$searchedTable}Name = '{$searchName}'");
                            printSelectionResult($selected, $result);
                        } else {
                            echo "Skate Location doesn't have a name. ";
                        }
                    } else {
                        if ($selected == 'Skater') {
                            $result = executePlainSQL("SELECT * FROM {$selected} WHERE {$attribute} = '{$searchName}'");
                            printSelectionResult($selected, $result);
                        }
                    }
                } else {
                    $result = executePlainSQL("SELECT * FROM {$selected}");
                    printSelectionResult($selected, $result);
                }
            }
        }

        function handleHavingRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT OrgName, ROUND(AVG(YearOfSkating) ,0) FROM Skater, Affiliate WHERE Skater.SkaterID = Affiliate.SkaterID GROUP BY OrgName HAVING COUNT(*)>1");
            printResult($result, 'Having');
        }

        function handleGroupRequest(){
            global $db_conn;

            $result = executePlainSQL("SELECT HomeTown, AVG(YearOfSkating) FROM Skater GROUP BY Hometown");
            printResult($result, 'Group');
        }

        function handleDisplayRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT * FROM Skater");
            printSelectionResult("Skater", $result);
        }

        function handleBoardsDisplayRequest() {
            global $db_conn;
    
            $result = executePlainSQL("SELECT ProductNum, BrandName, BoardName, BoardType 
                                        FROM Boards, BoardType 
                                        WHERE Boards.BoardLength=BoardType.BoardLength AND Boards.Kicktail = BoardType.Kicktail");
            printResult($result, 'boards');
        }

        function handleBoardsDetailsDisplayRequest() {
            global $db_conn;
    
            $result = executePlainSQL("SELECT * FROM Boards, BoardType WHERE Boards.BoardLength=BoardType.BoardLength AND Boards.Kicktail = BoardType.Kicktail");
            printResult($result, 'boardsDetail');
        }
    

        // HANDLE ALL POST ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('deleteSubmit', $_POST)) {
                    handleDeleteRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                }

                disconnectFromDB();
            }
        }

        // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('joinQueryRequest', $_GET)){
                    handleJoinRequest();
                } else if (array_key_exists('selectSubmit', $_GET)) {
                    handleSelectRequest();
                } else if (array_key_exists('groupQueryRequest', $_GET)) {
                    handleGroupRequest();
                } else if (array_key_exists('divisionQueryRequest', $_GET)) {
                    handleDivisionRequest();
                } else if (array_key_exists('havingQueryRequest', $_GET)) {
                    handleHavingRequest();
                }  else if (array_key_exists('displayTupleRequest', $_GET)) {
                    if ($_GET['displayTupleRequest'] == 'boards'){
                        handleBoardsDisplayRequest();
                    } else if ($_GET['displayTupleRequest'] == 'details'){
                        handleBoardsDetailsDisplayRequest();
                    } else {
                        handleDisplayRequest(); //skater
                    }
                } else if (array_key_exists('NestedQueryRequest', $_GET)) {
                    handleNestedGroupByRequest();
                }
                disconnectFromDB();
            }
        }
