<h2>Update Values in Skater Table</h2>

<form method="POST" action="skaters.php"> <!--refresh page when submitted-->

    <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
    <label for="skaterID" class="col-form-label">SkaterID:</label> 
    <input type="text" class="form-control" name="skaterID" id="skaterID" value=<?= $_GET['skaterIDtoEdit'] ?>> <br /><br /> <!--implement not null? -->
    <label for="skaterName" class="col-form-label">SkaterName:</label> 
    <input type="text" class="form-control" name="skaterName" id="skaterName" value=<?= getName($_GET['skaterIDtoEdit']) ?>> <br /><br />
    <label for="yearOfSkating" class="col-form-label">YearOfSkating:</label> 
    <input type="number" min="0" max="100" name="yearOfSkating" class="form-control" id="yearOfSkating" value=<?= getYOS($_GET['skaterIDtoEdit']) ?>> <br /><br />
    <label for="homeTown" class="col-form-label">Hometown:</label> 
    <input type="text" class="form-control" name="homeTown" id="homeTown" value=<?php echo getHomeTown($_GET['skaterIDtoEdit']); ?>> <br /><br />
    <label for="socialMedia" class="col-form-label">SocialMedia:</label> 
    <input type="text" class="form-control" name="socialMedia" id="socialMedia" value=<?php echo getSocialMedia($_GET['skaterIDtoEdit']); ?> > <br /><br />
    <button type="submit" class="btn btn-primary" value="Update" name="updateSubmit">Submit</button>
</form>

<?php function getName($ID) {
            global $db_conn;
            if (connectToDB()) { 
                $result1 = executePlainSQL("SELECT * FROM Skater WHERE SkaterID = '" . $ID . "'");
                $row = OCI_Fetch_Array($result1, OCI_BOTH);
                $NAME = $row[1];
                return $NAME;
            }
        }

        function getYOS($ID) {
            global $db_conn;
            if (connectToDB()) { 
                $result1 = executePlainSQL("SELECT * FROM Skater WHERE SkaterID = '" . $ID . "'");
                $row = OCI_Fetch_Array($result1, OCI_BOTH);
                $YOS = $row[2];
                return $YOS;
            }
        }

        function getHomeTown($ID) {
            global $db_conn;
            if (connectToDB()) { 
                $result1 = executePlainSQL("SELECT * FROM Skater WHERE SkaterID = '" . $ID . "'");
                $row = OCI_Fetch_Array($result1, OCI_BOTH);
                $HT = $row[3];
                return $HT;
            }
        }

        function getSocialMedia($ID) {
            global $db_conn;
            if (connectToDB()) { 
                $result1 = executePlainSQL("SELECT * FROM Skater WHERE SkaterID = '" . $ID . "'");
                $row = OCI_Fetch_Array($result1, OCI_BOTH);
                $SM = $row[4];
                return $SM;
            }
        }