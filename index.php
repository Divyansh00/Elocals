<?php
  //load the main screen only when the user is logged in else redirect to login page
  session_start();
  if(isset($_SESSION['login']))
  {
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Welcome to eLocals</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #666666;">

	<div class="limiter">

		<div class="container-login100">

			<div class="wrap-login100">

        <!--Form to enter the details-->
				<form class="login100-form validate-form" id="myForm" action="refer.php" method="POST">                    

          <button type="button" class="btn btn-default btn-sm" style="position: absolute;top: 10px;right: 10px;border: none;border-radius: 8px; background-color: #d9534f; color: #fff;font-family: Montserrat-Bold;" id="logout" onclick="location.href = 'logout.php';">
            <span class="glyphicon glyphicon-log-out"></span> LOGOUT
          </button>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="mobile" id="mobile">
            <span class="focus-input100"></span>
            <span class="label-input100">Mobile Number</span>
          </div>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="code" id="code">
            <span class="focus-input100"></span>
            <span class="label-input100">Referral Code</span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="submit">Get Cashback</button>
          </div>
          
          <!--response from the server will be shown here-->
          <div class="text-center p-t-46 p-b-20" id="ack"></div>
          
          <!--Share the referral code recieved on varous social networking sites-->
          <div class="text-center p-t-46 p-b-20" id="share">
            <span class="txt2">Share your code</span>
          </div>

          <div id="tweet" class="login100-form-social flex-c-m">
            <a class="login100-form-social-item flex-c-m bg1 m-r-5" href="<?php echo 'http://www.facebook.com/sharer.php?u=http://www.elocals.in'; ?>">
              <i class="fa fa-facebook-f" aria-hidden="true"></i>
            </a>

            <a class="login100-form-social-item flex-c-m bg2 m-r-5" href="http://www.twitter.com/intent/tweet?text=<?php if(isset($_SESSION['referral_code'])) echo $_SESSION["referral_code"]; ?>">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>

            <a class="login100-form-social-item flex-c-m bg2 m-r-5" href="https://www.linkedin.com/shareArticle?mini=true&url=http://www.elocals.in&title=Referal Code&summary=<?php if(isset($_SESSION['referral_code'])) echo $_SESSION["referral_code"]; ?>&source=LinkedIn">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
          </div>

        </form>

        <div class="login100-more" id="bg" style="background-image: url('images/elocal_new.jpg'); background-size:cover; overflow-y: hidden ;"></div>

      </div>

    </div>

  </div>

  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
  <!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>       
  <!--===============================================================================================-->		
  <script src="js/main.js"></script>
  <script type="text/javascript" src="js/my_script.js"></script>

</body>

</html>

<?php
  }
  else
    header('location: login.php');
?>
