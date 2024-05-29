<?php
  $msgs = [];
  if(!empty($_FILES['uploaded_file']))
  {
    $path = "/var/www/html/uploads/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      $msgs[] = "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded";
    } else{
        $msgs[] = "There was an error uploading the file, please try again!";
    }
  }
?><!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <?php
    foreach ($msgs as $msg) {
      echo "<p>$msg</p>";
    }
    ?>
  <form enctype="multipart/form-data" action="/" method="POST">
    <p>Upload your file</p>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
  </form>
  <ul>
    <?php
      $dir = "/var/www/html/uploads/";
      $files = scandir($dir);
      foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
          continue;
        }
        echo "<li><a href='uploads/$file'>$file</a></li>";
      }
    ?>
  </ul>
</body>
</html>
