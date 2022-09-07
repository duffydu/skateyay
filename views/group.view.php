<h2>Find the city you want to go and skate</h2>
<p>Show average year of skating of skaters from each hometown: </p>
<form action="query.php" method="GET">
    <input type="hidden" id="groupQueryRequest" name="groupQueryRequest">
    <input type="submit" class='btn btn-primary' name="groupByHometown"/>
</form>

<h2>Find the organization that you want to join</h2>
<p>For each organization with more than one affiliated skaters, show the average year of skating of those skaters: </p>
<form action="query.php" method="GET">
    <input type="hidden" id="havingQueryRequest" name="havingQueryRequest">
    <input type="submit" class='btn btn-primary' name="groupByOrg"/>

<!-- </form>
    <input type="submit" name="groupByOrg"/>
</form> -->
</form>



<?php
    require('app/request_functions.php');
    if (isset($_GET['groupQueryRequest']) || isset($_GET['havingQueryRequest'])) {
        handleGETRequest();
    }