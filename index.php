<?php
 
$cookie_name = "user";
$cookie_value = "1";



// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
 

// $read_cookie1= $_COOKIE['user'];

// echo $read_cookie1;

// if(!isset($_COOKIE[$cookie_name])) {
//   echo "Cookie named '" . $cookie_name . "' is not set!";
// } else {
//   echo "Cookie '" . $cookie_name . "' is set!<br>";
//   echo "Value is: " . $_COOKIE[$cookie_name];
// }

// die('');



session_start();


$user_db='';
$pass_db='';
$ok=false;

 


 

// if (isset($_SESSION['mobile']) && strlen($_SESSION['mobile'])==11 ){

// echo '

// <meta http-equiv="refresh" content="0; url=home.php">

// ';

// die('');

// }else{
 
//   $_SESSION['namefull']='';
//   $_SESSION['mobile']='';
  
// }


if (isset($_COOKIE['mobile']) && strlen($_COOKIE['mobile'])==11 ){

echo '

<meta http-equiv="refresh" content="0; url=home.php">

';

die('');

}else{
 
  $_COOKIE['namefull']='';
  $_COOKIE['mobile']='';
  
}


if (isset($_POST["user"])){




$file=fopen('db.txt','r');




$user = $_POST["user"];
$pass = $_POST["pass"];



for($i=1;$i<=3;$i++){
 
$read1=fgets($file);

$read2=explode(",",$read1);


$user_db=$read2[0];
$pass_db=$read2[1];




if ($user == $user_db && $pass == $pass_db){

  $ok=true;
  
  
  // $_SESSION['namefull']=$read2[3];
  // $_SESSION['mobile']=$read2[2];
  setcookie('mobile', $read2[2] , time() + (86400 * 30), "/"); // 86400 = 1 day
  setcookie('namefull', $read2[3] , time() + (86400 * 30), "/"); // 86400 = 1 day

    
  
  
  }

}










fclose($file);



// var_dump($read2) ;









// echo "user: ".$user;
// echo "<br>";
// echo "pass: ".$pass;





}

?>




<html dir="rtl">
    <head>


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
                <a class="navbar-brand" href="home.html">اپلیکیشن آیولرن</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">صفحه ورود</a>
                    </li>
                    
                    
                  </ul>
                  <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form> -->
                </div>
              </div>
            </nav>

            <br>
  





            <br>

            <img src="logo.png" style="width: 100px;">
            <br>
            <br>
            <!-- <form method="post" action="index.php" > -->
              
              <label>نام کاربری:</label><br>
              <input type="text" name="user" id="user" class="input1"><br>
              <br>
              <label>رمز عبور:</label><br>
              <input type="text" name="pass"  id="pass" class="input1"><br><br> 

              <button class="btn btn-success" onclick="send()"   id="btn_send">ورود به اپلیکیشن</button>
              <br>
              <br>
              <a href="reg.php" style=" color: black;  text-decoration: none;">
                ثبت نام
              </a>
              
            <!-- </form> -->


        </div>

        
<!-- <div class="dropdown">
  <span>Mouse over me</span>
  <div class="dropdown-content">
    <p>Hello World!</p>
  </div>
</div>

         -->
<br>
         <div id="error1" class="alert alert-danger text-center" style="display: none;">
        نام کاربری یا رمز عبور شما اشتباه است.
        </div>  

        <div id="ok1" class="alert alert-success text-center" style="display: none;">
        شما با موفقیت وارد اپلیکیشن شدید :)
        </div>  


      <?php

        if ($ok == true){
        echo ' 
        <div class="alert alert-success text-center">
        شما با موفقیت وارد اپلیکیشن شدید :)
        </div>  


        <meta http-equiv="refresh" content="2; url=home.php">

        ';
        }

       ?>

     

<script>

  function send() {
    document.getElementById("error1").style.display="none";
    document.getElementById("btn_send").disabled=true;
    document.getElementById("btn_send").textContent="در حال پردازش...";


      user=document.getElementById('user').value;
      pass=document.getElementById('pass').value;

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
          let ok = this.responseText;



          document.getElementById("btn_send").disabled=false;
          document.getElementById("btn_send").textContent="ورود به اپلیکیشن";


          if (ok=='1'){
            document.getElementById("error1").style.display="none";
            document.getElementById("ok1").style.display="block";
            window.location.assign("home.php");
          }

          if (ok=='0'){
            document.getElementById("error1").style.display="block";
            document.getElementById("ok1").style.display="none";
          }

        }
      };


      xmlhttp.open("GET", "ajax.php?user=" + user + "&pass=" + pass, true);
      xmlhttp.send();
  
  }

 

</script>



    </body>
</html>    