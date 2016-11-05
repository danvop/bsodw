<!DOCTYPE html>
    <html>
    <head>
        <title>Upload a Photo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/libs/html5shiv/r29/html5.min.js"></script>
            <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Open Modal</button>

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

        </div>

        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
                    url         : 'result.php',
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

      <script>
       
      </script>
    </body>
</html>
