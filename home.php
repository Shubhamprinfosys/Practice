<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./toast.style.css">
    <link rel="stylesheet" href="./toast.style.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Add Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">View Person Info</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <div class="container mt-0">
        <form>
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
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="button" class="btn btn-primary submit">Submit</button>
        </form>

        <?php include('./table.php') ?>
      </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script scr="./toast.script.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>



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
    $.ajax({
         type:"POST",
         url:"backend.php",
         data:{
           'action' :"create",
           'email'  :email,
           'pass'   :pass,
           'key'    :key,
         },
         dataType: 'json',
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
              window.location.reload();
              });
          
         }
    });
  });
    
    
</script>
</html>
