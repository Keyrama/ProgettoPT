<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Upload Document</h2>
        <p>Select a document from your filesystem.</p>
        <form action="welcome.php" method="post">
            <div class="form-group">
                <label>File</label>
                <input type="file" name="file" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Upload">
            </div>
        </form>
    </div>
</body>
</html>
