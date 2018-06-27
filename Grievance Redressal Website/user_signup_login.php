<?php
  include 'database.php';
  session_start();
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="user_signup_login_assets/css/style.css">

  
</head>

<body>

  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>User Sign Up</h1>
          
          <form action="user_signup_login.php" method="post">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required name="first_name" />
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text" name="last_name"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Choose User Id<span class="req">*</span>
            </label>
            <input type="text" required name="user_id"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" required name="pass"/>
          </div>
          
          <button type="submit" name="signup" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="user_signup_login.php" method="post">
          
            <div class="field-wrap">
            <label>
              User Id<span class="req">*</span>
            </label>
            <input type="text"required name="user_id"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password"required name="pass"/>
          </div>
          
          <button class="button button-block" name="login"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="user_signup_login_assets/js/index.js"></script>


</body>

</html>

<?php
    
    if(isset($_POST['signup'])) {
      $name = $_POST["first_name"]." ".$_POST["last_name"];
      $id = $_POST["user_id"];
      $pass = $_POST["pass"];
      $d = new database();
      $n = $d->user->insert_data($name, $id, $pass);

      if($n==0) {
        echo "<script>alert('Sorry Username Pre-Exist !!');</script>";
      }
      else if($n==1) {
        echo "<script>alert('Account Created Successfully');</script>";
      }
    }

    if(isset($_POST['login'])) {
      //echo "<script>alert('Please Re-check User-Id & Password');</script>";
      $id = $_POST["user_id"];
      $pass = $_POST["pass"];

      $d = new database();
      $n = $d->user->verify_login($id, $pass);

      if($n==0) {
        echo "<script>alert('Please Re-check User-Id & Password');</script>";
      }
      else if($n==1) {
        $_SESSION['user_id'] = $id;
        header("Location: user_homepage.php");
        exit;
      }

    }

?>
