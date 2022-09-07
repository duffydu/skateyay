<h2>Find Skaters that can do certain tricks with a specified familiarity:</h2>
<form method="GET" action="index.php"> <!--refresh page when submitted-->
    <input type="hidden" id="joinQueryRequest" name="joinQueryRequest">
    <label for="trickName" class="col-form-label">Trick Name:</label> 
    <select class="form-control" name="trickName" id="trickName">
        <option value="" disabled selected>-- Choose option --</option>
        <option value="Pivot180">Pivot 180</option>
        <option value="Kickflip">Kickflip</option>
        <option value="Shovit">Shovit</option>
        <option value="Ghostride Kickflip">Ghostride Kickflip</option>
        <option value="No-Comply">No Comply</option>
    </select>
    <label for="familiarity" class="col-form-label">Familiarity no less than:</label> 
    <input type="number" min="0" max="10" class="form-control" name="familiarity" id="familiarity"> <br /><br />
    <button type="submit" class="btn btn-primary" value="Join" name="joinSubmit">Submit</button>
</form>

<hr />