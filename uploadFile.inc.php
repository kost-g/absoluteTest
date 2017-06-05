<?php
if(isset($_POST['submit1'])){
    if (isset($_FILES["file"])){
        if ($housework->importFile($_FILES["file"]["tmp_name"])){
            $home_url = 'http://' . $_SERVER['HTTP_HOST'];
            header('Location: '. $home_url);
        }else{
            echo 'Load fail';
        }
    }
}
?>

<div>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload file (.txt format)</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <input type="file" name="file">
        </div>
        <div class="form-group">
            <button type="submit" name="submit1" class="btn btn-success">Upload</button>
        </div>
    </form>
</div>