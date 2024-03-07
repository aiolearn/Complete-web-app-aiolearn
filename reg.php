<?php
include("db.php");
$user_db='';
$pass_db='';
$ok=false;
$error='-';
if (isset($_POST["user"])){
  $user = $_POST["user"];
  $pass = $_POST["pass"];
  $namefull = $_POST["namefull"];
  $mobile = $_POST["mobile"];
  if (strlen($namefull)<5 || strlen($namefull)>50 ){
    $error='نام و نام خانوادگی را درست وارد کنید.';
  }
  if (strlen($mobile)<11 || strlen($mobile)>11 ){
      $error='شماره موبایل را درست وارد کنید، مثال : 09121234567'; 
  }
  if (substr($mobile,0,2) !='09'){
      $error='شماره موبایل نادرست است، مثال : 09121234567';
  }
  if ($error=='-'){
    mysqli_query($db,"insert into user (username , pass, namefull , mobile) values ('$user' , '$pass' , '$namefull' , '$mobile' ); ");
  }
}

?>




<html dir="rtl">
    <head>

    <meta charset="UTF-8">
      <link rel="icon" type="image/png" href="icon.png">

      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta charset="UTF-8">
      <link href="css/bootstrap.min.css" rel="stylesheet" >

      <link rel="stylesheet" href="css/aiolearn.css">

      <script src="js/bootstrap.min.js"  ></script>



    </head>

    <body>




      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Hello</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              hi there...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>








      
       <div style="text-align: center;">
        


            <!-- <p  class="alert alert-warning" >
              سلام من یک آیولرنی هستم و تمام تمریناتمو انجام میدم.
            </p> -->


            <nav class="navbar navbar-expand-lg bg-body-tertiary">
              <div class="container-fluid">
                <a class="navbar-brand" href="home.html">اپلیکیشن آیولرن <span style="font-size: 12px;">ثبت نام</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">خانه</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">صفحه ورود</a>
                    </li>
                    
                  </ul>
                
                </div>
              </div>
            </nav>

            <br>
  




 

            <img src="logo.png" style="width: 60px;">
            <br>
            <br>
            <form method="post" action="reg.php" >
              
              <label>نام و نام خانوادکی:</label><br>
              <input type="text" name="namefull" class="input1" value=""><br>
              <br> 
              
              <label>شماره موبایل:</label><br>
              <input type="tel" name="mobile" maxlength="11" class="input1" value=""><br>
              <br>


                <label>نام کاربری:</label><br>
              <input type="text" name="user" class="input1" value=""><br>
              <br>


              <label>رمز عبور:</label><br>
              <input type="password" name="pass" class="input1" value=""><br><br> 

              <button class="btn btn-primary" type="submit" id="btn_send">
                ثبت نام

              </button>
              <br>
              <br>
              <a href="index.php" style=" color: black;  text-decoration: none;">
                بازگشت 
              </a>
              
            </form>


        </div>

        
<!-- <div class="dropdown">
  <span>Mouse over me</span>
  <div class="dropdown-content">
    <p>Hello World!</p>
  </div>
</div>

         -->



      <?php

          if ($ok == true){
            echo ' 
            <div class="alert alert-success text-center">
            شما با موفقیت وارد اپلیکیشن شدید :)
            </div>  
            <meta http-equiv="refresh" content="2; url=home.html">
            ';
          }else{
            if ($error<>'-'){
              echo ' 
              <div class="alert alert-danger text-center">
                '.  $error  .'
              </div>  
              ';
            }
          }

       ?>

     

    </body>
</html>    