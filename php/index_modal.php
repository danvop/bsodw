<!-- index_modal.php -->

<!-- this file contains madal form and processing script -->


<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form" enctype="multipart/form-data" role="form" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Upload Photo</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
          <label for="Name">Name:</label>
          <input name="Name" type="text" class="form-control" id="Name" placeholder="Type your name" required>
          </div>
          <div class="form-group">
          <label for="Name">Email:</label>
          <input name="Email" type="email" class="form-control" id="Name" placeholder="Type your email">
          </div>
        <div class="form-group">
          <label for="Country">Country:</label>
          <input name="Country" type="text" class="form-control" id="Country" placeholder="Type your country">
        </div>
        <div class="form-group">
          <label for="Town">Town:</label>
          <input name="Town" type="text" class="form-control" id="Country" placeholder="Type your town">
        </div>

        <div class="form-group">
          <label for="OsVersion">OS version:</label>
          <input name="OsVersion" type="text" class="form-control" id="OsVersion" placeholder="Type your OS version">
        </div>
        <div class="form-group">
          <label for="Description">Description:</label>
          <textarea name="Description" type="text" class="form-control" id="Description" placeholder=""></textarea>
        </div>
        <div id="file"></div>
          <input type="file" name="file" id="file" required>
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
    url         : '/php/img_upload.php',
    cache       : false,
    data        : formdata ? formdata : form.serialize(),
    contentType : false,
    processData : false,

      
      success: function(data, textStatus) {
    $('#form').trigger('reset'); //reset form
    $('#myModal .modal-header .modal-title').html("Result");

    $('#myModal .modal-body').html(data);

    $("#submitForm").remove();
    $('#form').trigger('reset');
    $('.onclick-reload').click(function() {
      location.reload();
    });
    }
  });
    e.preventDefault();
});
</script>