<?php
function cleanStr($data)
{
    return trim(strip_tags($data));
}





/*function db_connect()
{
    //test function
    //
    //
    $conn = mysqli_connect(SERVERNAME, DB_ROOT, DB_PASS, DB_NAME);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "<h3> connection die </h3>";
    } else {
        echo "database OK";
    }
    mysqli_close($conn);
}
*/
function records_print()
{
     $conn = mysqli_connect(SERVERNAME, DB_ROOT, DB_PASS, DB_NAME);
     $sql = "
        SELECT rec_id, name, descr, img_name, date
        FROM records;
     ";


     $result = $conn->query($sql);
     //print_r($result);
//alt="Logo" class="img-responsive" style="min-width:230px; width:400px"
    
    //render records
    while ($row = $result->fetch_assoc()) {
    //print_r($row);
    //
        echo '<div class="container col-md-6" 
        style="
            margin-top:10px;

            ">';
        echo '<div class="row">';
            echo '<div class="col-sm-6">';
                //<img src="img/hacker_vlad.jpg" alt="Logo" class="img-responsive" style="min-width:230px; width:400px"/>
                echo '<img src="'.$row['img_name'].'"class="img-responsive" style="min-width:230px; width:400px"/>';
            echo '</div>';
            echo '<div class=" col-sm-6">';
                echo '<h4>'.$row['name'].'</h4>';

                // echo '<h5><i>'.$row['country'].' '.$row['town'].'</i></h5>';
            if ($row['date']) echo '<h5><i> Posted: '.$row['date'].'</i></h5>';
            // if ($row['os_ver']) echo '<h5>OS Version: '.$row['os_ver'].'</h5>';
                echo '<p>'.$row['descr'].'</p>';
                
            echo '</div>';
    echo '</div>';
    echo '</div>';
    }
    $conn->close();
}


/**
 * [insert_to_base inserts data form from to]
 * @param  [type] $name     [description]
 * @param  [type] $country  [description]
 * @param  [type] $img_name [description]
 * @return [type]           [description]
 */
function insert_to_base($name, $email, $descr, $img_name) {
    $conn = mysqli_connect(SERVERNAME, DB_ROOT, DB_PASS, DB_NAME);
    //$name = mysqli_real_escape_string($conn, $name);
    //$country = mysqli_real_escape_string($conn, $country);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "
        INSERT INTO `records` (`name`, `email`, `descr`, `img_name`, `date`)
        VALUES ('$name', '$email', '$descr', '$img_name', curdate())
    ";
    //  $sql = "
    //     INSERT INTO MyGuests (firstname, lastname, email)
    //     VALUES ('John', 'Doe', 'john@example.com')
    // ";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $conn->close();
}

function captcha_test($post_capthca){
if ($_SESSION["code"] == $post_capthca) {
    return 'true';
}else
    return 'false';
}

function img_upload($target_file, $img_name){

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            $result['upload_error'] =  "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            return "File is not an image";
            
            $uploadOk = 0;
            
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $result['upload_error'] =  "Sorry, file already exists.
        ";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["file"]["size"] > 5000000) {
        return "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        return "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
            return 'Sorry, your file was not uploaded';
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $img_name)) {
            //echo "The file ". basename($_FILES["file"]["name"]). " has been uploaded.";
            return 1;
            

    } else {
        return 'Sorry, there was an error uploading your file';
    }

    }    
  
}


/*// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO records (name, country)
VALUES ('John', 'Doe')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);*/


