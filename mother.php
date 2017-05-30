<!DOCTYPE html>
<html>
<head>
    <title>Mother page</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="style/style.css" rel="stylesheet">

</head>
<body>
<header><p><a href="exit.php">Exit(<?php echo $_COOKIE['name']; ?>)</a></p></header>
<div class="container">
    <h1>Excel Upload</h1>

    <form method="POST" action="excelUpload.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
        </div>
    </form>
</div>

</body>
</html>