
<?php
ob_start(); // Start output buffering
session_start();
// Rest of your PHP code
ob_end_flush();
include 'header.php';
?>
<body>
    <?php include 'navbar.php';?>
    <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="container mt-0">
          <form id="formdata" enctype="multipart/form-data">
            <div class="mb-3">
              <input type="hidden" name="key" class="keyvalue" value="">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control email" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control pass" name="pass" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
            <label for="file" class="form-label">Upload Document</label>
            <input type="file" class="form-control fileToUpload" name="fileToUpload" id="fileToUpload">
            </div>
            <button type="button" class="btn btn-primary submit">Submit</button>
          </form>
        
        </div>
        
      </div>

      <div class="col-md-6">
        <div class="append_table">
        <?php include './table.php'?>
      </div>
        </div>
    </div>
    </div>

</body>
<script>
  $(document).ready(function(){
    // toastr.success('Page Loaded!');
  })
   $(document).on('click','.edit',function(){
     var key = $(this).attr('key');
    $.ajax({
         type:"POST",
         url:"backend.php",
         data:{
           'key' : key,
           'action' : "edit",
         },
         dataType: 'json',
         cache:false,
         success:function(res){
            console.log(res);
            // window.location.reload();
            $('.email').val(res.email);
            $('.pass').val(res.pass);
            $('.keyvalue').val(key);
         }
    });
  });

  $(document).on('click','.submit',function(){
    var email = $('.email').val();
    var pass  = $('.pass').val();
    var key   = $('.keyvalue').val();
    var file  = $('.fileToUpload').val();
    var condition = true;
    msg = '';
    if(email==""){
          condition = false;
          msg = "Please enter the email address";
          showAlertMsg(type='Error',icon='error',msg);
    }
    if(pass==""){
      condition = false;
      msg = "Please enter the Passcode";
      showAlertMsg(type='Error',icon='error',msg);
    }
    var formdata= new FormData($('#formdata')[0]);
    formdata.append('action','create');
    formdata.append('key',key);
    if(condition){
      $.ajax({
           type:"POST",
           url:"backend.php",
           data:formdata,
           contentType: false,
           processData: false,
           dataType: 'json',
           success:function(res){
            $('#formdata')[0].reset();
              swal({
                title: "Success",
                text: res.msg,
                icon: "success",
                button: "OK",
                button:true,
                dangerMode: true,
              })
              .then((value) => {
                // window.location.reload();
                 $('.append_table').html(res.view);
                });

           }
      });
    }else{

    }
  });


  // delete
  $(document).on('click','.delete',function(){
    var key = $(this).attr('key');

    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this record",
      icon: "warning",
      buttons: true,
      dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
         type:"POST",
         url:"backend.php",
         data:{
           'key' : key,
           'action' : "delete",
         },
         dataType: 'json',
         cache:false,
         success:function(res){
          swal({
              title: "Success",
              text: res.msg,
              icon: "success",
              button: "OK",
              button:true,
              dangerMode: true,
            })
            .then((value) => {
              // window.location.reload();
              $('.append_table').html(res.view);
              });
         }
    });

  } else {
    swal("Your record is safe!");
  }
});

  });


</script>
</html>
