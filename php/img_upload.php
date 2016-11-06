<?php
require $_SERVER['DOCUMENT_ROOT'].'/db_pass.php';
// file resize

require $_SERVER["DOCUMENT_ROOT"].'/php/lib.inc.php';
//print_r($_POST);
//
// echo $_POST['Name'];
// echo "</br>";
// echo $_POST['Country'];
// print_r($_FILES);
// echo "</br>";
$target_dir = $_SERVER["DOCUMENT_ROOT"].'/img/';
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$img_date = date("Y-m-d_H-i-s");//img upload time
$img_name = $target_dir.$img_date.'_'.$_FILES["file"]["name"];
// checking post data
$img_db_name = 'img/'.$img_date.'_'.$_FILES["file"]["name"];

if(isset($_POST['Name'])){
    $name = cleanStr($_POST['Name']);
}
if(isset($_POST['Country'])){
    $country = cleanStr($_POST['Country']);
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.</br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.</br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.</br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.</br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $img_name)) {

        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
       
        insert_to_base($name, $country, $img_db_name);

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>