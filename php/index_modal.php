<!-- index_modal.php -->

<!-- this file contains madal form and processing script -->


<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form" enctype="multipart/form-data" role="form" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Upload your BSoD</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
          <label for="Name">Name:</label>
          <input name="Name" type="text" class="form-control" id="Name" placeholder="Type your name" required>
          </div>
          <div class="form-group">
          <label for="Name">Email:</label>
          <input name="Email" type="email" class="form-control" id="Name" placeholder="Type your email">
          <span id="" class="help-block">Your email will not be shown but we need it to contact you later</span>
          </div>
       
        <div class="form-group">
          <label for="Description">Description:</label>
          <textarea name="Description" type="text" class="form-control" id="Description" placeholder=""></textarea>
        </div>
                
        <div class="form-group" id="file">
          <input type="file" name="file" id="file" required>
          <span id="" class="help-block">Image size must be less than 2MB</span>
          <span id="fileHelpBlock" class="help-block" style="display: none;"></span>
        </div>
    
        <img id="img-captcha" src="php/captcha.php">
		<!--Элемент, запрашивающий новый код CAPTCHA-->
		<div id="reload-captcha" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Refresh</div>
		<!--Блок для ввода кода CAPTCHA-->
		<div class="form-group has-feedback">
			<label id="label-captcha" for="captcha" class="control-label">Enter captcha: </label>
			<input id="text-captcha" name="captcha" type="text" class="form-control" required="required" value="">
			<span class="glyphicon form-control-feedback"></span>
		</div>
        
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
  $(function() {
    //выводит новый код CAPTCHA при открытии модального окна
    //Math.random needs as trick   
    $('#myModal').on('show.bs.modal', function () {
      $('#img-captcha').attr('src', 'php/captcha.php?id='+Math.random()+'');
    });
    $("#reload-captcha").click(function() {
      $('#img-captcha').attr('src', 'php/captcha.php?id='+Math.random()+'');
    });

  });

</script>



<script>
$('#form').on('submit',function(e) {

e.preventDefault();
var form = $(this);

// $('#submitForm').click(function(){
//   var form = $('#form');  
  var formdata = false;
  if(window.FormData){
      formdata = new FormData(form[0]);
  }

  var formAction = form.attr('action');

  $.ajax({
    type        : 'POST',
    url         : '/php/img_upload.php',
    cache       : false,
    data        : formdata,
    dataType    : 'json', 
    contentType : false,
    processData : false,

      
    success: function(data, textStatus) {
    
    if (data.captcha_ok ==="false"){
        console.log("capthca error");
        $("#text-captcha").parents('.form-group').addClass('has-error');
        
        
    } 
    if (data.error_msg != ''){
      console.log("upload error");
      $("#fileHelpBlock").parents('.form-group').addClass('has-error');
      $("#fileHelpBlock").show();
      $("#fileHelpBlock").text(''+data.error_msg+'');
      
    } 
    

    if(data.upl_ok === "true"){ 
    $('#form').trigger('reset');
    $('#myModal .modal-header .modal-title').html("Result");
    $('#myModal .modal-body').html('Your bsod has been added and awaiting moderation'); 
    $("#submitForm").remove();
    $('.onclick-reload').click(function() {
      location.reload();  
    });
  }
    // if(data.captcha_ok ==='true') and (data.error_msg===''){
    //   console.log('success');
    //   $('#myModal .modal-header .modal-title').html("Result");
    // }
    // if ((data.error_msg == '') and (data.captcha_ok ==="true")){
    //   console.log(data.error_msg);
     // $('#myModal .modal-header .modal-title').html("Result");
    // }
    
    console.log(data);
    // form.submit();
    } //success
  
  }) //ajax
  
  // 
  //  //reset form
  // $('#myModal .modal-header .modal-title').html("Result");

  // $('#myModal .modal-body').text('File uploaded successfull');

  // 
  // $('#form').trigger('reset');
  // 
  // }}  

    

    
    
    // if (data.captcha_ok ==="true" and data.error_msg === ''){  
       
    //   //console.log(data);  
    //   //$('#form').trigger('reset'); //reset form
    //   //$('#myModal .modal-header .modal-title').html("Result");

    //   //$('#myModal .modal-body').html(data);

    //   // $("#submitForm").remove();
    //   // $('#form').trigger('reset');
    //   // $('.onclick-reload').click(function() {
    //   //   location.reload();
    //   } 
      
    // }
    
  });
  
</script>