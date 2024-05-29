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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Upload your files</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
  </head>
  <body>
    <main>
      <?php
        foreach ($msgs as $msg) {
          echo "<p>$msg</p>";
        }
      ?>
    <form enctype="multipart/form-data" action="/" method="POST">
      <h1>Upload your file</h1>
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
    </main>
  </body>
</html>
