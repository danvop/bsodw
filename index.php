<?php
require 'db_pass.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  	@media (min-width: 768px ) {
	  .row {
	      position: relative;
	  }

	  .bottom-align-text {
	    position: absolute;
	    bottom: 0;
	    right: 0;
	  }
	}

  </style>
</head>
<body>

<div class="jumbotron text-center" >
  <h1 class="bg-primary">BSoDw</h1>
  <p>Blue Screen of Death warriors</p>
  <h5><i>Just because Windows must die</i></h5>
</div>
  
<div class="container">
 <div class="row">
    <!-- <div class="col-sm-6">
    
      <div class="media">
        <div class="media-left">
          <img src="hacker_dan.jpg" class="media-object img-thumbnail" style="width:260px">
        </div>
        <div class="media-body">
          <h4 class="media-heading">Hacker Dan</h4><i>Russia, Astrakhan Posted 26.10.2016</i>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    </div> -->

<div class="container col-md-6">
    <div class="row">
        <div class="col-sm-6">
            <img src="img/hacker_vlad.jpg" alt="Logo" class="img-responsive" style="min-width:230px; width:400px"/>
        </div>
        <div class=" col-sm-6">
            <h3>Some Text</h3>
            <h3><?=$db_pass?></h3>>
        </div>
    </div>
</div>
<div class="container col-md-6">
    <div class="row">
        <div class="col-sm-6">
            <img src="//placehold.it/600x300" alt="Logo" class="img-responsive"/>
        </div>
        <div class="bottom-align-text col-sm-6">
            <h3>Some Text</h3>
        </div>
    </div>
</div>
<div class="container col-md-6">
    <div class="row">
        <div class="col-sm-6">
            <img src="//placehold.it/600x300" alt="Logo" class="img-responsive"/>
        </div>
        <div class="col-sm-6">
            <h3>Some Text</h3>
        </div>
    </div>
</div>

    

  </div>
</div>

</body>
</html>

