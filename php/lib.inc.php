<?php
function cleanStr($data)
{
    return trim(strip_tags($data));
}





function db_connect()
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

function records_print()
{
     $conn = mysqli_connect(SERVERNAME, DB_ROOT, DB_PASS, DB_NAME);
     $sql = "
        SELECT rec_id, name, country, town, os_ver, descr, img_name
        FROM records;
     ";


     $result = $conn->query($sql);
     //print_r($result);
//alt="Logo" class="img-responsive" style="min-width:230px; width:400px"
    
    //render records
    while ($row = $result->fetch_assoc()) {
    //print_r($row);
    //

    //
    //
    //
    //
    echo '<h3>'.$row['img_name'].'</h3>';
    echo '<img src="'.$row['img_name'].'"alt="Logo" class="img-responsive" style="min-width:230px; width:400px"/>';
    }

}





function print_echo() {


}

