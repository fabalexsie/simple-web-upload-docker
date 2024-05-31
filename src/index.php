<?php
  $msgs = [];
  if(!empty($_FILES['uploaded_file']))
  {
    $path = "/var/www/html/uploads/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      $msgs[] = "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded.";
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
    <link rel="icon" type="image/svg+xml" href="/images/icon.svg">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/icon-192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/images/icon-512.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
  </head>
  <body>
    <main>
      <h1>Upload your file</h1>
      <form enctype="multipart/form-data" action="/" method="POST">
        <input type="file" name="uploaded_file"></input><br />
        <input type="submit" value="Upload"></input>
      </form>
      
      <?php
        foreach ($msgs as $msg) {
          echo "<small><article style=\"border: 2px solid #0c7c59; background-color: #03b309\">$msg</article></small>";
        }
      ?>

      <?php
        $dir = "/var/www/html/uploads/";
        $files = scandir($dir);
        if($files === false || count($files) == 0) {
          echo "<li>No files uploaded yet</li>";
        } else {

        echo "<h1>Uploaded files</h1>";
        echo "<ul>";
        foreach ($files as $file) {
          if ($file == '.' || $file == '..') {
            continue;
          }
          echo "<li><a href='uploads/$file'>$file</a></li>";
        }
          echo "</ul>";
        }
      ?>
    </main>
  </body>
</html>
