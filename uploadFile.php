<?
if($role == 'mother'){
    ?>
    <h2>File upload</h2>
    <form method="POST" action="uploadFile.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload file</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
        </div>
    </form>
    <?php
}elseif($role == 'father'){?>
    <h3>Father</h3>
    <?php
}
