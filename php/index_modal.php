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
          <label for="Description">Description:</label>
          <textarea name="Description" type="text" class="form-control" id="Description" placeholder=""></textarea>
        </div>
                
        <div class="form-group" id="file">
          <input type="file" name="file" id="file" >
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
        <div class="modal-footer">
          <button type="button" class="btn btn-default onclick-reload" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="submitForm">Save</button>
        </div>  
        </div>
      </form>
    </div>
  </div>
</div>
<!--END Modal -->

<!-- Код ниже взят из другого источника, 
не добился работы

Капчу надо сделать как один из инпутов и проверять в img_upload.php -->

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




<!-- <script>
    $(function() {
    //выводит новый код CAPTCHA при открытии модального окна  
    $('#myModal').on('show.bs.modal', function () {
      $('#img-captcha').attr('src', 'php/captcha.php?id='+Math.random()+'');
    });
    //выводит новый код CAPTCHA при нажатии на кнопку Обновить
    $("#reload-captcha").click(function() {
      $('#img-captcha').attr('src', 'php/captcha.php?id='+Math.random()+'');
    });  
    //при нажатии на кнопку Регистрация (id="save")
    $('#save').click(function() {
      //переменная formValid
      var formValid = true;
      //перебирает все элементы управления input, кроме CAPTCHA 
      $('input').each(function() {
        //если текущий элемент CAPTCHA, то пропустить его
        if  ($(this).attr('id') == 'text-captcha') { return true; }
        //найти предков, которые имеют класс .form-group, для установления success/error
        var formGroup = $(this).parents('.form-group');
        //найти glyphicon, который предназначен для показа иконки успеха или ошибки
        var glyphicon = formGroup.find('.form-control-feedback');
        //для валидации данных используем HTML5 функцию checkValidity
        if (this.checkValidity()) {
          //добавить к formGroup класс .has-success, удалить has-error
          formGroup.addClass('has-success').removeClass('has-error');
          //добавить к glyphicon класс glyphicon-ok, удалить glyphicon-remove
          glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
        } else {
          //добавить к formGroup класс .has-error, удалить .has-success
          formGroup.addClass('has-error').removeClass('has-success');
          //добавить к glyphicon класс glyphicon-remove, удалить glyphicon-ok
          glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
          //отметить форму как не валидную 
          formValid = false;  
        }
      });
      //проверяем элемент input, в который пользователь вводит код CAPTCHA
      //получаем значение элемента input, содержащего код CAPTCHA
      var captcha = $("#text-captcha").val();
      //если код CAPTCHA пустой, то сразу сообщаем, что он не правильный
      if (captcha=='') {
        inputCaptcha = $("#text-captcha");
        formGroupCaptcha = inputCaptcha.parents('.form-group');
        glyphiconCaptcha = formGroupCaptcha.find('.form-control-feedback');
        formGroupCaptcha.addClass('has-error').removeClass('has-success');
        glyphiconCaptcha.addClass('glyphicon-remove').removeClass('glyphicon-ok');
      }
      //иначе запрашиваем результат у сервера через ajax
      else  { 
        var dataString = 'captcha=' + captcha;
        $.ajax({
          type: "POST",
          url: "verify.php",
          data: dataString,
          success: function(result) {
    	inputCaptcha = $("#text-captcha");
            formGroupCaptcha = inputCaptcha.parents('.form-group');
            glyphiconCaptcha = formGroupCaptcha.find('.form-control-feedback');
    	//если результат, который вернул сервер, равен true, 
    	//то отмечаем, что код валидный и изменяет цвет элементов на зелёный
            if (result==="true") {
              formGroupCaptcha.addClass('has-success').removeClass('has-error');
              glyphiconCaptcha.addClass('glyphicon-ok').removeClass('glyphicon-remove');
              if (formValid) {
                //скрыть модальное окно
                $('#myModal').modal('hide');
                //отобразить сообщение об успехе
                $('#success-alert').removeClass('hidden');
                $('#success-alert').removeClass('hidden');
              }         
            } 
    	//иначе отмечает, что код не валидный и изменяет цвет элементов на красный
    	else {
              formGroupCaptcha.addClass('has-error').removeClass('has-success');
              glyphiconCaptcha.addClass('glyphicon-remove').removeClass('glyphicon-ok');
            }
          }
        });
      }
    });
    });
</script> -->








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
    dataType    : 'json', 
    contentType : false,
    processData : false,

      
    success: function(data, textStatus) {
      
    if (data.captcha_ok ==="true"){    
      $('#form').trigger('reset'); //reset form
      $('#myModal .modal-header .modal-title').html("Result");

      //$('#myModal .modal-body').html(data);

      $("#submitForm").remove();
      $('#form').trigger('reset');
      $('.onclick-reload').click(function() {
        location.reload();
      });
      
      console.log(data);
      }
      else {
      
        console.log(data.captcha_ok);
      }
      
    }

  });
    e.preventDefault();
});
</script>