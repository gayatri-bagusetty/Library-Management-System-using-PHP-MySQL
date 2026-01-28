<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
  background-image: url("img/login.jpg");;
  font-family: Arial, Helvetica, sans-serif;
  width: 60%;
  display: flex;
}
form {border: 3px solid #f1f1f1;
width: 80%;
margin-left: 80%;
margin-top: 20%;
background-color : #5d4306;
}
h2{
    color: black;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #d7b311;
  box-sizing: border-box;
  ;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 19%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<table><tr><td>
<div class="column">
<form action="auth.php?role=student" method="post">
  <div class="imgcontainer">
    <center><h2><font color="white">Student Login</h2></center>
   <i class="fa-solid fa-circle-user" style="font-size:60px;"></i>
  </div>

  <div class="container">
    <label for="uname"><b><font color="white">Username</b></label></font>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b><font color="white">Password</font></b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"><font color="white"> Remember me</font>
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw"><font color="black">Forgot <a href="#">password?</a></span>
  </div>
</form>
</td>
<td>
<div class="side">
<form action="auth.php?role=admin" method="post">
  <div class="imgcontainer">
    <center><h2><font color="white">Admin Login</h2></center>
    <i class="fa-solid fa-circle-user" style="font-size:60px;"></i>
  </div>

  <div class="container">
    <label for="uname"><b><font color="white">Username</font></b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b><font color="white">Password</font></b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"><font color="white"> Remember me
</font></label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw"><font color="black">Forgot <a href="#">password?</a></span>
  </div>
</form>
</td></tr></table>
</div>
</div>
</div>
</body>
</html>   