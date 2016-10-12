<!DOCTYPE html>
<?php
//$conf = parse_ini_file("config.ini", true);
$conf = parse_ini_file("config.ini");
$passwdfile = $conf['htpasswd'];
?>
<html>
<head>
  <link rel="stylesheet" href="../style.css" type="text/css" />
  <link rel="stylesheet" href="../color.css" type="text/css" />
  <script>
  //<!--

  function clearColors(pass1, pass2, message, m2, defaultColor) {
    pass2.style.backgroundColor = defaultColor;
    pass1.style.backgroundColor = defaultColor;
    message.innerHTML="&nbsp;";
    m2.innerHTML="&nbsp;";
  }
  function checkPass()
  {
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    var pass = document.getElementById('testPass');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    var defaultColor = "#ffffff"; // this is set in the style sheet
    //Compare the values in the password field
    //and the confirmation field

    // check bad chars first
    re = /[^a-zA-Z0-9]/;
    if ((re.test(pass1.value)) && (pass1.value !="")) {
      pass1.style.backgroundColor = badColor;
      pass.style.color = badColor;
      pass.innerHTML = "Use numbers and letters only";
    } else {
      if ((pass1.value.length < 4) && (pass1.value.length !=0)) {
        //pass1.style.backgroundColor = badColor;
        //clearColors(pass1);// they're on the way
        //pass1.style.backgroundColor = defaultColor;
        clearColors(pass1, pass2, message, pass, defaultColor);
        pass.style.color = badColor;
        pass.innerHTML = "Too Short";

      } else {
        if (pass1.value.length > 63) {
          pass1.style.backgroundColor = badColor;
          pass.style.color = badColor;
          pass.innerHTML = "Too Long";

        } else {

          if (pass2.value != ""){
            if(pass1.value == pass2.value){
              //The passwords match.
              //Set the color to the good color and inform
              //the user that they have entered the correct password
              pass2.style.backgroundColor = goodColor;
              message.style.color = goodColor;
              message.innerHTML = "Passwords Match!";
            }else{
              //The passwords do not match.
              //Set the color to the bad color and
              //notify the user.
              pass2.style.backgroundColor = badColor;
              message.style.color = badColor;
              message.innerHTML = "Passwords Do Not Match!";
            }
          } else {
            clearColors(pass1, pass2, message, pass, defaultColor);
          }
        }
      }
    }
  };


function clearJunk() {
  //Store the password field objects into variables ...
  var pass1 = document.getElementById('pass1');
  var pass2 = document.getElementById('pass2');
  //Store the Confimation Message Object ...
  var message = document.getElementById('confirmMessage');
  var pass = document.getElementById('testPass');
  //clearColors(pass1, pass2, message);
  clearColors(pass1, pass2, message, pass, "#FFF");
  pass1.value="";
  pass2.value="";

};


function validate(form) {

    if(form.pass1.value != form.pass2.value) {
        alert('Passwords do not match');
        return false;
    }
    else {
        if(form.pass1.value== "") {
          return confirm('Are you sure you want to remove this user?');
        } else {
          if (form.pass1.value.length < 4) {
            alert('Password is too short');
            return false;
          } else {
            if (form.pass1.value.length > 63) {
              alert('Password is too long');
              return false;
            } else {
              re = /[^a-zA-Z0-9]/;
              if (re.test(pass1.value)) {
                alert('Only numbers and letters allowed');
                return false;
              } else {
                return true;
              }
            }

        }
      }
    }
}

function userfunc(form) {

  var val  = form.user.value;
  var userp = document.getElementById('newuserp');
  if(val=="new"){
    userp.height = "auto";
    userp.display = "block";
    userp.opacity = 1;
    userp.visibility = "visible";
  } else {
    userp.height = 0;
    userp.display="none";
    userp.opacity = 0;
    userp.visibility = "hidden";

  }


}

//-->
</script>
  <title>Advanced Options</title>
  </head>
  <body>
  <div id="words">
    <div class="dropdown">
      <button class="dropbtn">&#9776;</button>
     <div class="dropdown-content">
       <a href="../">Home</a>
       <a href="./">(Re)Start Piece</a>
      <a href="./piece.html">Show Piece as Conductor</a>
      <a href="../piece.html">Show piece as Player</a>
      <a href="../wifi.php">Show WiFi Password</a>
      <a href="./requestshutdown.php">Shut down computer</a>
      <a href="./setintro.php">Set introductory text</a>
    </div>
  </div>
  <main class="main">
  <form action="conductorpassword.php" method="post" onsubmit="return validate(this);">
    <h2>Change or Set Conductor Password</h2>
    <p>Set a new password. Or, if you leave the fields blank and click submit, that will clear the password.</p>
    <p>
      <label for="user">User:</label>
      <select name="user" onchange="userfunc(this.form)">
        <option value="new">Create New User</option>
        <?php
        if (file_exists($passwdfile)) {
          $myfile = fopen($passwdfile, "r") or die("Unable to open file!");
          // Output one line until end-of-file
          while(!feof($myfile)) {
           $line =  fgets($myfile);
             list($user, $realm, $hash) = explode(':', $line); //text mangling
             $user = trim($user);
             echo "<option value=\"" . $user . "\">" . $user . "</option>\n";
           }
           fclose($myfile);
        }
        ?>
        <option value="clear">Clear All Users</option>
      </select>
    </p>
    <p id="newuserp">
      <label for "newuser">New User Name</label>
      <input type="text" name="newuser">
    </p>
    <p class="passwdwrapper">
    <span id="testPass" class="confirmMessage">&nbsp;</span>
      <label for="newpass">New Password</label>
      <input type="password" name="newpass"
      onkeyup="checkPass(); return false;"id="pass1">
    </p>
    <p class="passwdwrapper">
      <span id="confirmMessage" class="confirmMessage">&nbsp;</span>
      <label for="confirm">Confirm New Password</label>
      <input type="password" name="confirm"
      onkeyup="checkPass(); return false;" id="pass2">
    </p>
    <p><button type="reset" value="Reset" onclick="clearJunk();">Nevermind</button>
    <BUTTON name="submit" value="submit" type="submit">Change</BUTTON></p>
  </form>
</main>
    </div>
  </body>
  </html>
