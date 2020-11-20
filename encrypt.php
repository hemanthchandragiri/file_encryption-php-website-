<?php

$IV    = '12dasdq3g5b2434b';
/* $ivlen = openssl_cipher_iv_length($ALGORITHM);
    $IV = openssl_random_pseudo_bytes($ivlen);*///THIS WILL WORK IF THE CIPHER METHOD IS FIXED 
$error = '';
 
if (isset($_POST) && isset($_POST['password'])) {
  $ALGORITHM = isset($_POST['ALGORITHM']) && $_POST['ALGORITHM']!='' ? $_POST['ALGORITHM'] : null;
  $password   = isset($_POST['password']) && $_POST['password']!='' ? $_POST['password'] : null;
  $action = isset($_POST['action']) && in_array($_POST['action'],array('a','b')) ? $_POST['action'] : null;
  $file  = isset($_FILES) && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK ? $_FILES['file'] : null;
  $email = isset($_POST['email']) && $_POST['email']!='' ? $_POST['email'] : null;
  if ($password === null) {
    $error .= 'Invalid Password
<br>';
  }
  if ($file === null) {
    $error .= 'Errors occurred while elaborating the file
    <br>';
  }
  
  if ($error === '') {
  
    $content = '';
    $nomefile  = '';
  
    $content = file_get_contents($file['tmp_name']);
    $filename  = $file['name'];
  

 $content = openssl_encrypt($content, $ALGORITHM, $password, 0, $IV);
        $filename  = $filename . '.txt';

    if ($content === false) {
      $error .= 'Errors occurred while encrypting/decrypting the file ';
    }
    
    if ($error === '') {
    
      header("Pragma: public");
      header("Pragma: no-cache");
      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Expires: 0");
      header("Content-Type: application/octet-stream");
      header("Content-Disposition: attachment; filename=\"" . $filename . "\";");
      $size = strlen($content);
      header("Content-Length: " . $size);
      echo $content; // file output
    switch ($action) {
      case 'a':
      //mail sessions ..........
      $myfile = fopen('encrypted.txt', "w") or die("Unable to open file!");
$txt = $content;
fwrite($myfile, $txt);

 

$subject=" file encryption";

$email_message.="Please find the attachment below for encrypted text";
$semi_rand = md5(uniqid(time()));
$headers = "From: ".$fromemail;
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

    $headers .= "\nMIME-Version: 1.0\n" .
    "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";

 
  $strFilesName = 'encrypted.txt';  
  $strContent = chunk_split(base64_encode(file_get_contents('encrypted.txt')));  
  
  
    $email_message .= "This is a multi-part message in MIME format.\n\n" .
    "--{$mime_boundary}\n" .
    "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" .
    $email_message .= "\n\n";


    $email_message .= "--{$mime_boundary}\n" .
    "Content-Type: application/octet-stream;\n" .
    " name=\"{$strFilesName}\"\n" .
    //"Content-Disposition: attachment;\n" .
    //" filename=\"{$fileatt_name}\"\n" .
    "Content-Transfer-Encoding: base64\n\n" .
    $strContent  .= "\n\n" .
    "--{$mime_boundary}--\n";

$toemail= $email;  

if(mail($toemail, $subject, $email_message, $headers)){
   $statusMsg= "Email send successfully with attachment";
   fclose($myfile);
   unlink('encrypted.txt');

      
}else{
   $statusMsg= "Not sent";
}

break;
      case 'b':
        echo "hello";
        break;
}
      
    }
  
  }
  
}

?>
      <html>
        <head>
          <title>ENCRYPTION</title>
          <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
                <link rel="stylesheet" type="text/css" href="pika.css">
                <link href='https://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>
                <link href="https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap" rel="stylesheet">
                <style type="text/css">
                  .topnav {
  overflow: hidden;
  border-radius: 5px;
  background-image: linear-gradient(to left , #000000,#434343);
  width: 80%;
  margin: auto;
  box-shadow: 0px 0px 5px 5px blue;
}

.topnav a {
  position: relative;
  display:inline-block;
  color: #f2f2f2;
  text-align: center;
  padding: 10px 16px;
  text-decoration: none;
  font-size: 17px;
  border-radius: 5px;
  margin: 0;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}



.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: rgb(18,170,209);
  color: white;
  transition: 0.6s;
}

.dropdown-content a:hover {
  background-color: rgb(18,209,173);
  color: black;
}



@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;

  }

}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
    .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
                </style>
                </head>
                <body>
                    <div class="up" style="background-size:cover;">
    <div id='canvas_hex' style="position: absolute;background-size: cover; width: 100%; height: 100%; z-index: -1;margin: 0;padding: 0">
        <canvas id="canvas_background" style="position: absolute;"></canvas>
        <canvas id="canvas_interaction" style="position: absolute;"></canvas>
    </div></div>
               <br>   
    <div class="topnav" id="myTopnav" align="center">
  <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
  <a href="filehome.php"><i class="fa fa-fw fa-envelope"></i>File encryption</a>
  <a href="about.html" target="_blank"><i class="fa fa-fw fa-building-o"></i>About File encryption</a>
  <a href="https://hemanthchandragiri.github.io/mainpage/aboutpage.html" target="_blank"><i class="fa fa-fw fa-user"></i>Our Web team</a>
     <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">☰</a>
  </div>  <br>
  
<div class="total" style="background: black;width: 50%;margin: auto;max-height: 85%;border-radius: 10px;border-color: red;border-style: solid;box-shadow: 0 20px 50px rgb(23, 32, 90);">

      <div class="container">
        <div class="row">
          <div class="col-12" >
            <h1 style="color: white">ENCRYPTION</h1>
          </div>
        </div>
        <?php if ($error != '') { ?>
        <div class="row">
          <div class="col-12 alert alert-danger" role="alert">
            <?php echo ($error); ?>
          </div>
        </div>
        <?php } ?>
        <form class="form" enctype="multipart/form-data" method="post" id="form1" name="form1" auto-complete="off">
          <div class="form-row">
            <div class="form-group">
              <label for="file">File</label>
              <input type="file" name="file" id="file" placeholder="Choose a file" required class="form-control-file"/>
            </div>
          </div>

              <label for="password">Password</label>
              <br>
              <input type="password" name="password" id="pwd" placeholder="Insert password" required class="form-control" />
                      <div id="pwd_strength_wrap">
                <div id="passwordDescription" style="color: #fff;">Password not entered</div>
                <div id="passwordStrength" class="strength0"></div>
                <div id="pswd_info">
                        
                </div><!-- END pswd_info -->
        
          </div><br><br><br>
          <LABEL>Select the method:</LABEL>
          <BR>
          <div class="select">
            <select name="ALGORITHM" required="">
              <option value="AES-128-CBC">AES-128-CBC </option>
              <option value="AES-128-CBC-HMAC-SHA1">AES-128-CBC-HMAC-SHA1 </option>
              <option value="AES-128-CBC-HMAC-SHA256">AES-128-CBC-HMAC-SHA256 </option>
              <option value="AES-128-CFB">AES-128-CFB </option>
              <option value="AES-128-CFB1">AES-128-CFB1 </option>
              <option value="AES-128-CFB8">AES-128-CFB8 </option>
              <option value="AES-128-CTR">AES-128-CTR </option>
              <option value="AES-128-ECB">AES-128-ECB </option>
              <option value="AES-128-OFB">AES-128-OFB </option>
              <option value="AES-128-XTS">AES-128-XTS </option>
              <option value="AES-192-CBC">AES-192-CBC </option>
              <option value="AES-192-CFB">AES-192-CFB </option>
              <option value="AES-192-CFB1">AES-192-CFB1 </option>
              <option value="AES-192-CFB8">AES-192-CFB8 </option>
              <option value="AES-192-CTR">AES-192-CTR </option>
              <option value="AES-192-ECB">AES-192-ECB </option>
              <option value="AES-192-OFB">AES-192-OFB </option>
              <option value="AES-256-CBC" selected="">AES-256-CBC </option>
              <option value="AES-256-CBC-HMAC-SHA1">AES-256-CBC-HMAC-SHA1 </option>
              <option value="AES-256-CBC-HMAC-SHA256">AES-256-CBC-HMAC-SHA256 </option>
              <option value="AES-256-CFB">AES-256-CFB </option>
              <option value="AES-256-CFB1">AES-256-CFB1 </option>
              <option value="AES-256-CFB8">AES-256-CFB8 </option>
              <option value="AES-256-CTR">AES-256-CTR </option>
              <option value="AES-256-ECB">AES-256-ECB </option>
              <option value="AES-256-OFB">AES-256-OFB </option>
              <option value="AES-256-XTS">AES-256-XTS </option>
              <option value="BF-CBC">BF-CBC </option>
              <option value="BF-CFB">BF-CFB </option>
              <option value="BF-ECB">BF-ECB </option>
              <option value="BF-OFB">BF-OFB </option>
              <option value="CAMELLIA-128-CBC">CAMELLIA-128-CBC </option>
              <option value="CAMELLIA-128-CFB">CAMELLIA-128-CFB </option>
              <option value="CAMELLIA-128-CFB1">CAMELLIA-128-CFB1 </option>
              <option value="CAMELLIA-128-CFB8">CAMELLIA-128-CFB8 </option>
              <option value="CAMELLIA-128-ECB">CAMELLIA-128-ECB </option>
              <option value="CAMELLIA-128-OFB">CAMELLIA-128-OFB </option>
              <option value="CAMELLIA-192-CBC">CAMELLIA-192-CBC </option>
              <option value="CAMELLIA-192-CFB">CAMELLIA-192-CFB </option>
              <option value="CAMELLIA-192-CFB1">CAMELLIA-192-CFB1 </option>
              <option value="CAMELLIA-192-CFB8">CAMELLIA-192-CFB8 </option>
              <option value="CAMELLIA-192-ECB">CAMELLIA-192-ECB </option>
              <option value="CAMELLIA-192-OFB">CAMELLIA-192-OFB </option>
              <option value="CAMELLIA-256-CBC">CAMELLIA-256-CBC </option>
              <option value="CAMELLIA-256-CFB">CAMELLIA-256-CFB </option>
              <option value="CAMELLIA-256-CFB1">CAMELLIA-256-CFB1 </option>
              <option value="CAMELLIA-256-CFB8">CAMELLIA-256-CFB8 </option>
              <option value="CAMELLIA-256-ECB">CAMELLIA-256-ECB </option>
              <option value="CAMELLIA-256-OFB">CAMELLIA-256-OFB </option>
              <option value="CAST5-CBC">CAST5-CBC </option>
              <option value="CAST5-CFB">CAST5-CFB </option>
              <option value="CAST5-ECB">CAST5-ECB </option>
              <option value="CAST5-OFB">CAST5-OFB </option>
              <option value="DES-CBC">DES-CBC </option>
              <option value="DES-CFB">DES-CFB </option>
              <option value="DES-CFB1">DES-CFB1 </option>
              <option value="DES-CFB8">DES-CFB8 </option>
              <option value="DES-ECB">DES-ECB </option>
              <option value="DES-EDE">DES-EDE </option>
              <option value="DES-EDE-CBC">DES-EDE-CBC </option>
              <option value="DES-EDE-CFB">DES-EDE-CFB </option>
              <option value="DES-EDE-OFB">DES-EDE-OFB </option>
              <option value="DES-EDE3">DES-EDE3 </option>
              <option value="DES-EDE3-CBC">DES-EDE3-CBC </option>
              <option value="DES-EDE3-CFB">DES-EDE3-CFB </option>
              <option value="DES-EDE3-CFB1">DES-EDE3-CFB1 </option>
              <option value="DES-EDE3-CFB8">DES-EDE3-CFB8 </option>
              <option value="DES-EDE3-OFB">DES-EDE3-OFB </option>
              <option value="DES-OFB">DES-OFB </option>
              <option value="DESX-CBC">DESX-CBC </option>
              <option value="IDEA-CBC">IDEA-CBC </option>
              <option value="IDEA-CFB">IDEA-CFB </option>
              <option value="IDEA-ECB">IDEA-ECB </option>
              <option value="IDEA-OFB">IDEA-OFB </option>
              <option value="RC2-40-CBC">RC2-40-CBC </option>
              <option value="RC2-64-CBC">RC2-64-CBC </option>
              <option value="RC2-CBC">RC2-CBC </option>
              <option value="RC2-CFB">RC2-CFB </option>
              <option value="RC2-ECB">RC2-ECB </option>
              <option value="RC2-OFB">RC2-OFB </option>
              <option value="RC4">RC4 </option>
              <option value="RC4-40">RC4-40 </option>
              <option value="RC4-HMAC-MD5">RC4-HMAC-MD5 </option>
              <option value="SEED-CBC">SEED-CBC </option>
              <option value="SEED-CFB">SEED-CFB </option>
              <option value="SEED-ECB">SEED-ECB </option>
              <option value="SEED-OFB">SEED-OFB </option>
            </select></div>
            <div class="form-row">
              <div class="form-group">
         <label style="color:red">Do you want this encrypted file to be sent to your mail?</label>
<label for="yes">
    <input type="radio" id="yes" name="action" onclick="ShowHideDiv()" value="a">
    Yes
</label>
<label for="no">
    <input type="radio" id="no" name="action" onclick="ShowHideDiv()" value="b">
    No
</label>
<div id="dvtext" style="display: none">
    <label>Enter your email:</label>
    <input type="text" id="email"name="email">
</div>
            </div>  <div class="form-row">
              <button type="submit" class="button" onclick="setTimeout('document.form1.reset();',1000)"><strong>Execute</strong></button>
              
            </div>
          </form>
        </div></div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      </body>
    </html>
    <script type="text/javascript">
           function ShowHideDiv() {
        var yes = document.getElementById("yes");
        var dvtext = document.getElementById("dvtext");
        dvtext.style.display = yes.checked ? "block" : "none";}

$("input#pwd").on("focus keyup", function () {
        var score = 0;
        var a = $(this).val();
        var desc = new Array();
 
        // strength desc
        desc[0] = "Too short";
        desc[1] = "Weak";
        desc[2] = "Good";
        desc[3] = "Strong";
        desc[4] = "Best";
 
        $("#pwd_strength_wrap").fadeIn(400);
         
        // password length
        if (a.length >= 6) {
            $("#length").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#length").removeClass("valid").addClass("invalid");
        }
 
        // at least 1 digit in password
        if (a.match(/\d/)) {
            $("#pnum").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#pnum").removeClass("valid").addClass("invalid");
        }
 
        // at least 1 capital & lower letter in password
        if (a.match(/[A-Z]/) && a.match(/[a-z]/)) {
            $("#capital").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#capital").removeClass("valid").addClass("invalid");
        }
 
        // at least 1 special character in password {
        if ( a.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) {
                $("#spchar").removeClass("invalid").addClass("valid");
                score++;
        } else {
                $("#spchar").removeClass("valid").addClass("invalid");
        }
 
 
        if(a.length > 0) {
                //show strength text
                $("#passwordDescription").text(desc[score]);
                // show indicator
                $("#passwordStrength").removeClass().addClass("strength"+score);
        } else {
                $("#passwordDescription").text("Password not entered");
                $("#passwordStrength").removeClass().addClass("strength"+score);
        }
});
 
$("input#pwd").blur(function () {
        $("#pwd_strength_wrap").fadeOut(400);
});
canvas_background()
canvas_interaction()



function canvas_background(){

var dd = document.getElementById("canvas_background");
var cv = dd.getContext("2d");
var w = dd.width = document.getElementById('canvas_hex').offsetWidth;
var h = dd.height = document.getElementById('canvas_hex').offsetHeight
document.getElementById("canvas_hex").appendChild(dd);
function rRInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function polygon(x, y, ns, s) {
    this.shape = new Path2D();
    this.shape.moveTo(x + s * Math.cos(0), y + s * Math.sin(0));
    for (var i = 1; i <= ns; i++) {
        this.shape.lineTo(x + s * Math.cos(i * 2 * Math.PI / ns), y + s * Math.sin(i * 2 * Math.PI / ns));
    }
    return this.shape;
}
function draw() {
    cv.clearRect(0, 0, w, h);

    cv.fillStyle = 'rgba( 34, 46, 58, 1 )';
    cv.strokeStyle = 'rgba( 34, 46, 58, 1 )';
    cv.lineWidth = 2;
    var grid = {
        mesh: [],
        shapeSize: 20,
        shapeSides: 6,
        shapeApothem: 15 * Math.cos(Math.PI / 6),
        shapeSideLength: 1 * Math.sin(Math.PI / 6)
    };
    var mc = 0;
    for (var c = 0; c < w / (grid.shapeSize + grid.shapeSideLength); c++) {
        for (var d = 0; d < (h + grid.shapeSize) / (grid.shapeSize * 2); d++) {
            var ty = (d * grid.shapeSize * 2) + ((c % 2) * (grid.shapeSize));
            var tx = c * (grid.shapeSize + grid.shapeApothem);
            grid.mesh.push(new polygon(tx, ty, 6, grid.shapeSize));
            cv.fill(grid.mesh[mc]);
            cv.stroke(grid.mesh[mc]);
            mc++;
            //console.log(c);
        }
    }
}
var reset = function () {
    w = dd.width = document.getElementById('canvas_hex').offsetWidth;
    h = dd.height = document.getElementById('canvas_hex').offsetHeight
    draw();
}
draw();
//dd.addEventListener("click", draw);
window.addEventListener("resize", reset);
  
}

function canvas_interaction(){
  // start the main loop when ready
let color_indicator = 1
let color_1 = 255
let color_2 = 0
let color_3 = 0


requestAnimationFrame(mainLoop);
var can = document.getElementById("canvas_interaction");
// get the canvas context
const ctx = can.getContext("2d");
can.width = document.getElementById('canvas_hex').offsetWidth
can.height = document.getElementById('canvas_hex').offsetHeight
ctx.fillStyle = "rgba(0,0,0,1)";
ctx.fillRect(0, 0, can.width, can.height);

// set up mouse
document.addEventListener("mousemove", mEvent);
function mEvent(e) {

    mouse.x = e.pageX; mouse.y = e.pageY
}
const mouse = { x: 0, y: 0 };



window.addEventListener('resize', onWindowResize, false);

function onWindowResize() {


    can.width = document.getElementById('canvas_hex').offsetWidth;
    can.height = document.getElementById('canvas_hex').offsetHeight
    ctx.setTransform(2, 0, 0, 2, 0, 0);
    ctx.fillStyle = "rgba(0,0,0,1)";
    ctx.fillRect(0, 0, can.width, can.height);

    renderer.setSize(width,height);

}


function mainLoop() {

    const grad = ctx.createRadialGradient(0, 0, 10, 0, 0, 50);
    grad.addColorStop(0, "rgba(" + color_1 + "," + color_2 + "," + color_3 + ",1)");
    grad.addColorStop(1, "transparent");

    if (color_1 >= 255) color_indicator = 1
    if (color_2 >= 255) color_indicator = 2
    if (color_3 >= 255) color_indicator = 0

    if (color_indicator == 0) {
        color_1 += 1
        color_3 -= 1
        color_2 -= 1
    }
    if (color_indicator == 1) {
        color_1 -= 1
        color_3 -= 1
        color_2 += 1
    }
    if (color_indicator == 2) {
        color_1 -= 1
        color_3 += 1
        color_2 -= 1
    }

    if (color_1 < 0) color_1 = 0
    if (color_2 < 0) color_2 = 0
    if (color_3 < 0) color_3 = 0


    // set canvas origin to the mouse coords (moves the gradient)
    ctx.setTransform(2.5, 0, 0, 2.5, mouse.x, mouse.y);
    ctx.fillStyle = grad;
    ctx.fillRect(-mouse.x, -mouse.y, can.width, can.height);



    requestAnimationFrame(mainLoop);

}

function fadeOut() {
    ctx.setTransform(2, 0, 0, 2, 0, 0);
    ctx.fillStyle = "rgba(0,0,0,0.05)";
    ctx.fillRect(0, 0, can.width, can.height);
    setTimeout(fadeOut, 1);
}

fadeOut();
}
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
