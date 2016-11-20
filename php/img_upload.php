<?php
// captcha segment
require $_SERVER['DOCUMENT_ROOT'].'/db_pass.php';
require $_SERVER["DOCUMENT_ROOT"].'/php/lib.inc.php';
$target_dir = $_SERVER["DOCUMENT_ROOT"].'/img/';
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$img_date = date("Y-m-d_H-i-s");//img upload time
$img_name = $target_dir.$img_date.'_'.$_FILES["file"]["name"];
// checking post data
$img_db_name = 'img/'.$img_date.'_'.$_FILES["file"]["name"];

session_start();

$upl_result = array (
    'captcha_ok' => '',
    'file_exists' => '',
    'is_image' => '',
    'file_not_large' => '',
    'file_format' =>'',
    'upload_ok' => '',
    'upload_error' => ''
    );
//проверяет соответствие коду CAPTCHA
if ($_SESSION["code"] == $_POST["captcha"]) {
//сообщаем строку true, если код соответствует
    $upl_result['captcha_ok'] = 'true';
    $uploadOk = 1;
    if (isset($_POST['Name'])) {
        $name = cleanStr($_POST['Name']);
    }
    if (isset($_POST['Email'])) {
        $email = cleanStr($_POST['Email']);
    }
    if (isset($_POST['Description'])) {
        $descr = cleanStr($_POST['Description']);
    }
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            $upl_result['upload_error'] =  "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            $upl_result['upload_ok'] = 'true';
        } else {
            $upl_result['upload_error'] =  "File is not an image.</br>";
            $uploadOk = 0;
            $upl_result['upload_ok'] = 'false';
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $upl_result['upload_error'] =  "Sorry, file already exists.</br>";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["file"]["size"] > 5000000) {
        $upl_result['upload_error'] =  "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $upl_result['upload_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.</br>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.</br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $img_name)) {
            //echo "The file ". basename($_FILES["file"]["name"]). " has been uploaded.";
            insert_to_base($name, $email, $descr, $img_db_name);

        } else {
            $upl_result['upload_error'] = 'Sorry, there was an error uploading your file';
        }

    }    


    } 
else {
    
    $upl_result['captcha_ok'] = 'false';
  
}

echo json_encode($upl_result);
