// lib.inc.js


// $('#form').submit(function(e) {
//   var form = $(this);
//   var formdata = false;
//   if(window.FormData){
//       formdata = new FormData(form[0]);
//   }

//   var formAction = form.attr('action');

//   $.ajax({
//     type        : 'POST',
//     url         : '/php/img_upload.php',
//     cache       : false,
//     data        : formdata ? formdata : form.serialize(),
//     contentType : false,
//     processData : false,

      
//       success: function(data, textStatus) {
//     $('#form').trigger('reset'); //reset form
//     $('#myModal .modal-header .modal-title').html("Result");

//     $('#myModal .modal-body').html(data);

//     $("#submitForm").remove();
//     $('#form').trigger('reset');
//     $('.onclick-reload').click(function() {
//       location.reload();
//     });
//     }
//   });
//     e.preventDefault();
// });
