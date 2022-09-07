<h2>Insert Values into Skater Table</h2>
<form method="POST" action="skaters.php"> <!--refresh page when submitted-->
    <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
    <label for="skaterID" class="col-form-label">SkaterID:</label> 
    <input type="text" class="form-control" name="skaterID" id="skaterID"> <br /><br /> <!--implement not null? -->
    <label for="skaterName" class="col-form-label">SkaterName:</label> 
    <input type="text" class="form-control" name="skaterName" id="skaterName"> <br /><br />
    <label for="yearOfSkating" class="col-form-label">YearOfSkating:</label> 
    <input type="number" min="0" max="100" name="yearOfSkating" class="form-control" id="yearOfSkating"> <br /><br />
    <label for="homeTown" class="col-form-label">Hometown:</label> 
    <input type="text" class="form-control" name="homeTown" id="homeTown"> <br /><br />
    <label for="socialMedia" class="col-form-label">SocialMedia:</label> 
    <input type="text" class="form-control" name="socialMedia" id="socialMedia"> <br /><br />
    <button type="submit" class="btn btn-primary" value="Insert" name="insertSubmit">Submit</button>
</form>

<hr />