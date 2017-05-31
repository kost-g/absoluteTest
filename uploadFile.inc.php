<?php ?>
if(isset($_POST['submit'])){

}
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload file</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
        </div>
    </form>
