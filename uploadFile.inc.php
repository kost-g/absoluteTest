<?php
if(isset($_POST['submit1'])){
    var_dump($_FILES["file"]["name"]);
    $uploadname = $_FILES["file"]["name"];
    $uploadfile = 'G:\IT\OpenServer_5\absoluteTest\uploads' . $uploadname;
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)){
        $housework->importFile($uploadfile);
    }else{
        echo 'Load fail';
    }
    $home_url = 'http://' . $_SERVER['HTTP_HOST'];
    header('Location: '. $home_url);
}

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label>Upload file</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <input type="file" name="file" class="form-control">
        <input type="text" name="text">
    </div>
    <div class="form-group">
        <button type="submit" name="submit1" class="btn btn-success">Upload</button>
    </div>
</form>
