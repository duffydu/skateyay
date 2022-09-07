<h2>Show the most active skaters</h2>
<p>Show information about skaters who participated in all events: </p>
<form action="query.php" method="GET">
    <input type="hidden" id="divisionQueryRequest" name="divisionQueryRequest">
    <input type="submit" class='btn btn-primary' name="division"/>
</form>

<?php
    require('app/request_functions.php');
    if (isset($_GET['divisionQueryRequest'])) {
        handleGETRequest();
    }