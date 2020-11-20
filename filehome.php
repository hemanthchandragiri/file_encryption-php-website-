      <html>
        <head>
          <title>Choose one</title>
          <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
                <link rel="stylesheet" type="text/css" href="pika.css">
                <link href='https://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>
                <link href="https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap" rel="stylesheet">
                <style type="text/css">


div.desc {
  padding: 15px;
  text-align: center;
  color: white;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
                </style>
                </head>
                <body>
                    <div class="up" style="background-size:cover;">
    <div id='canvas_hex' style="position: absolute;background-size: cover; width: 100%; height: 115vh; z-index: -1;margin: 0;padding: 0">
        <canvas id="canvas_background" style="position: absolute;"></canvas>
        <canvas id="canvas_interaction" style="position: absolute;"></canvas>
    </div></div>
                  


  <nav class="fill">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#">File Encryption</a></li>
      <li><a href="about.html">About File encryption</a></li>
      <li><a href="#">Team</a></li>
    </ul>
  </nav>
  <h1 style="color: red;text-align: center;">Choose one!!!</h1>

<div class="responsive" style="margin-left: 10%;">
  <div class="gallery">
    <a target="_blank" href="encrypt.php">
      <img src="lock.png" style="width: 100%">
    </a>
    <div class="desc">ENCRYPTION</div>
  </div>
</div>
<div class="responsive" style="margin-left: 20%;">
  <div class="gallery">
    <a target="_blank" href="decrypt.php">
      <img src="unlock.png" style="width: 79%;">
    </a>
    <div class="desc">DECRYPTION</div>
  </div>
</div>

        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      </body>
    </html>
    <script type="text/javascript">
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
