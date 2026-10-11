<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Open Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Open Document</h2>
        <p>Enter a document name.</p>
        <form action="view.php" method="get">
            <div class="form-group">
                <label>Document</label>
                <input type="text" name="file" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="View">
            </div>
        </form>
    </div>
</body>
</html>
