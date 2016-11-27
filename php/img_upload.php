<?php

require $_SERVER['DOCUMENT_ROOT'].'/db_pass.php';
require $_SERVER["DOCUMENT_ROOT"].'/php/lib.inc.php';


$target_dir = $_SERVER["DOCUMENT_ROOT"].'/img/';
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$img_date = date("Y-m-d_H-i-s");//img upload time
$img_name = $target_dir.$img_date.'_'.$_FILES["file"]["name"];
// checking post data
$img_db_name = 'img/'.$img_date.'_'.$_FILES["file"]["name"];



if (isset($_POST['Name'])) {
    $name = cleanStr($_POST['Name']);
}
if (isset($_POST['Email'])) {
    $email = cleanStr($_POST['Email']);
}
if (isset($_POST['Description'])) {
    $descr = cleanStr($_POST['Description']);
}

session_start();

$upl_result = array (
    'captcha_ok' => '',
    'error_msg' => '',
    'upl_ok'=> ''

);

//captcha checking
if (captcha_test($_POST["captcha"]) == 'true' ) {
    $upl_result['captcha_ok'] = 'true';
    $img_upl_res = img_upload($target_file, $img_name);
    if ($img_upl_res !== 1){
        $upl_result['error_msg'] = $img_upl_res;
    } else {
        insert_to_base($name, $email, $descr, $img_db_name);
        $upl_result['upl_ok'] = 'true';
    }
}
else $upl_result['captcha_ok'] = 'false';




echo json_encode($upl_result);
