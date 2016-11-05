<?php
require 'db_pass.php';
require 'php/lib.inc.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>BSoDw</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Open Modal</button>
 <div class="row">

<!-- Modal -->
<div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="form" enctype="multipart/form-data" role="form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Upload Photo</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
            <!-- <label for="Name">Name:</label> -->
            <input name="Name" type="text" class="form-control" id="Name" placeholder="Type your name">
          </div>
          <div class="form-group">
            <!-- <label for="Country">Country:</label> -->
            <input name="Country" type="text" class="form-control" id="Country" placeholder="Type your country">
          </div>
                                <div id="messages"></div>
                                <input type="file" name="file" id="file">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default onclick-reload" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="submitForm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!--END Modal -->

<!-- ajax for make record -->

<script>
            $('#form').submit(function(e) {
              var form = $(this);
                var formdata = false;
                if(window.FormData){
                    formdata = new FormData(form[0]);
                }

                var formAction = form.attr('action');

                $.ajax({
                    type        : 'POST',
                    url         : 'img_upload.php',
                    cache       : false,
                    data        : formdata ? formdata : form.serialize(),
                    contentType : false,
                    processData : false,

                    // success: function(data, textStatus)
                    success: function(data, textStatus) {
                  $('#myModal .modal-header .modal-title').html("Result");
                  $('#myModal .modal-body').html(data);

                  $("#submitForm").remove();
                  $('.onclick-reload').click(function() {
                  location.reload();
                  });
                }




                    // success: function(response) {
                    //     if(response != 'error') {
                    //         $('#messages').addClass('alert alert-success').text(response);
                    //         // OP requested to close the modal
                    //         //$('#myModal').modal('hide');
                    //     } else {
                    //         $('#messages').addClass('alert alert-danger').text(response);
                    //     }
                    // }
                });
                e.preventDefault();
           });
        </script>


<!-- END ajax for make record -->
<?php records_print() ?>


<!-- 

  #1. Надо переделать в db_pass с переменных в константы 
  #2. Или сделать их глобальными
3. надо дату создания записи включить в таблицу

-->

<!-- js form modal  -->

<!-- 
<script type="text/javascript">
     $(document).ready(function () {
$("input#submit").click(function(){
    $.ajax({
        type: "POST",
        url: "process.php", //process to mail
        data: $('form.contact').serialize(),
        success: function(msg){
            $("#thanks").html(msg) //hide button and show thank you
            $("#form-content").modal('hide'); //hide popup  
        },
        error: function(){
            alert("failure");
        }
    });
});
});
  </script>

 -->

    

  </div> <!-- row -->
</div>

</body>
</html>

