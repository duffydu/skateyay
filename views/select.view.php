<h2>Select the information you want to know more about!</h2>
<form action="query.php?view=select" method="GET" >
    <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
    <label for="tableName" class="col-form-label">Table Name:</label> 
    <select class="form-control" name="selectedTable">
        <option value="" disabled selected>-- Choose Table --</option>
        <option value="Skater">Skater</option>
        <option value="Organization">Organization</option>
        <option value="Events">Events</option>
        <option value="SkateLocation">Skate Location</option>
        <option value="Brands">Brands</option>
        <option value="BoardShop">Board Shop</option>
        <option value="Tricks">Tricks</option>
    </select>
    <label for="name" class="col-form-label">Search by 
        <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
        <select class="form-control" name="selectedAttribute">
        <option value="" disabled selected>-- Choose Attribute --</option>
        <option value="Name">Name</option>
        <option value="Hometown">Hometown</option>
    </select></label> 
    <input class="form-control" name="searchName" id="searchName"> <br /><br />
    <button type="submit" class="btn btn-primary" value="selectSubmit" name="selectSubmit">Submit</button>
</form>

<?php
    require('app/request_functions.php');
    if (isset($_GET['selectQueryRequest'])) {
        handleGETRequest();
    }