<!DOCTYPE html>
<html>
<head>
	
	<title>File Encryption</title>
	<style type="text/css">	
body{
	margin: 0;
	padding: 0;
  font-family: 'Exo', sans-serif;
}


/* NAVIGATION */
nav {
  width: 80%;
  margin: 0 auto;
  background: transparent;
  padding: 50px 0;
 
}
nav ul {
  list-style: none;
  text-align: center;
}
nav ul li {
  display: inline-block;
}
nav ul li a {
  display: block;
  padding: 15px;
  text-decoration: none;
  color: #aaa;
  font-weight: 800;
  text-transform: uppercase;
  margin: 0 10px;
}
nav ul li a,
nav ul li a:after,
nav ul li a:before {
  transition: all .5s;
}
nav ul li a:hover {
  color: #fff;
}


/* stroke */
nav.stroke ul li a,
nav.fill ul li a {
  position: relative;
}
nav.stroke ul li a:after,
nav.fill ul li a:after {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  width: 0%;
  content: '.';
  color: transparent;
  background: #aaa;
  height: 1px;
}
nav.stroke ul li a:hover:after {
  width: 100%;
}

nav.fill ul li a {
  transition: all 2s;
}

nav.fill ul li a:after {
  text-align: left;
  content: '.';
  margin: 0;
  opacity: 0;
}
nav.fill ul li a:hover {
  color: #fff;
  z-index: 1;
}
nav.fill ul li a:hover:after {
  z-index: -10;
  animation: fill 1s forwards;
  -webkit-animation: fill 1s forwards;
  -moz-animation: fill 1s forwards;
  opacity: 1;
}

/* Keyframes */
@-webkit-keyframes fill {
  0% {
    width: 0%;
    height: 1px;
  }
  50% {
    width: 100%;
    height: 1px;
  }
  100% {
    width: 100%;
    height: 100%;
    background: #000;
  }
}
</style>
</head>
<body>
	<div class="up" style="background-size:cover;">
    <div id='canvas_hex' style="position: absolute; width: 100vw; height: 100vh; z-index: -1;margin: 0;padding: 0">
        <canvas id="canvas_background" style="position: absolute;"></canvas>
        <canvas id="canvas_interaction" style="position: absolute;"></canvas>
    </div></div>
                      <link href='https://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400' rel='stylesheet' type='text/css'>
                      <link href="https://fonts.googleapis.com/css2?family=Exo:wght@100&display=swap" rel="stylesheet">


  <nav class="fill">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="filehome.php">File Encryption</a></li>
      <li><a href="about.html">About File encryption</a></li>
      <li><a href="#">Team</a></li>
    </ul>
  </nav>
    	<br>
    	<br>

<div class="container" style="margin:auto;color: white; background: black;text-align: center;box-shadow: 5px 10px 18px #056fff">
  <p>This is a File encryption Website built as part of our Project</p>
<p>All the files are encrypted with different cipher methods.<br> Your data in the file is encrypted and nothing is stored on the server. We use different types of encryption techniques. The files encrypted here can be decrypted only here.</p>
<p style="color: red"><strong>Don't forget to remember your password or save it...!</strong></p>
</div>
    	
    		
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

</body>
</html>

</body>
</html>