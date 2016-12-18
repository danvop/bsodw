<?php
require $_SERVER['DOCUMENT_ROOT'].'/db_pass.php';
require 'php/lib.inc.php';




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>BSoDw</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="/js/lib.inc.js"></script>
  <style>
    
  </style>
</head>
<body>

<div class="jumbotron text-center" >
  <h1 class="bg-primary">BSoDw</h1>
  <p>Blue Screen of Death warriors</p>
  <h5><i>Just because Windows must die</i></h5>
</div>
  
<div class="container">
<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Post your bsod</button>
<div class="row">

<?php
  require 'php/index_modal.php';
?>

<!-- ajax for make record -->




<!-- END ajax for make record -->

<?php 
if (isset($_GET['user_role']) and ($_GET['user_role'] == 'admin')) {
    records_print('not moderated'); 
} else {
    records_print('not moderated');
}

?>
 
  </div> 


</div>
<hr>
<footer class="footer">
<div class="container">
   <p class="text-muted">This project on GitHub</p>
</div>
</footer>
</body>
</html>

