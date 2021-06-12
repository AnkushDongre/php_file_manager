<?php
$filename= $OLDNAME = '';
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <title>Demo File Manager Assignment</title>
</head>

<body>
  <div class="container">
  <div class="row">
  <div class="col-lg-4 pt-3">
  <h1 class="fw-bolder">File Manager</h1>
  </div>
  <div class="col-lg-2 pt-4">
  <form method="POST">
  <input type="text" name="RENAME" value="<?=$OLDNAME;?>">

  <input type="submit" value="save" style="visibility: hidden;">
  </form>
  </div>
  <div class="col-lg-6 pt-4">
  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file_upload" id="file-upload">
    <input type="submit" name="submit" id="upload" value="upload">
    </form>
  </div>
  </div>
  
    
  </div>

<div class="container">
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Size</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
<tr>
<?php

$dirpath = __DIR__;

$handle = opendir($dirpath);
if($handle){

    while(false !== ($entry = readdir($handle))){
        $only_file_name = str_replace("File/", "" , $entry);
        $xfilename = $only_file_name;
        if($entry == "." || $entry == ".."){continue;}
        if(is_dir($entry)){
            echo  "<tr><td><a href='$entry' >" . $entry . "/" . "</a></td><td>.</td><td>.</td></tr>";
        }else{
            echo "<tr><td><a href='$entry'>" . $entry . "</a></td>";
            echo "<td>". filesize($entry) . " kb</td>";
            echo "<td><a href='?DELL=".$entry."'>Delete</a>";
            echo "<a class='mx-2' href='?RENAME=".$only_file_name."'>Rename</a>";
            echo "</td></tr>";
        }
    
    }
    closedir($handle);
}else{
    echo "Could Not Found!";

}

echo "<br />";

$array = scandir($dirpath);


if(isset($_GET['DELL'])){
  $DELLS = $_GET['DELL'];
  unlink($DELLS);
  header("location: http://localhost/php/filemanager.php" ); 
}


if(isset($_GET['RENAME'])){
$OLDNAME = $_GET['RENAME'];

}


if(isset($_POST['RENAME'])){
$NEWNAME = $POST['RENAME'];
rename('File/'.$OLDNAME, 'File/'.$NEWNAME);
header("location: http://localhost/php/filemanager.php" ); 
}

?>






  </tbody>
</table>
</div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>