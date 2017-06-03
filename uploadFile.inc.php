<?php
if(isset($_POST['submit1'])){
    $uploaddir = 'g:/IT/OpenServer_5/domains/absoluteTest/uploads/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)){
        $housework->importFile($uploadfile);
        $home_url = 'http://' . $_SERVER['HTTP_HOST'];
        header('Location: '. $home_url);
    }else{
        echo 'Load fail';
    }
}
?>

<div>
    <div>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload file</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <input type="file" name="file">
            </div>
            <div class="form-group">
                <button type="submit" name="submit1" class="btn btn-success">Upload</button>
            </div>
        </form>
    </div>
</div>