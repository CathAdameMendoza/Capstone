<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="Content-TYpe" content="text/html; charset=utf-8">
    <meta name="description" content="Online Special Program for Employment of Student">
    <meta name="keywords" content="Online SPES, DOLE, Department of Labor and Employment">
	<title>eSPES | Sign up</title>

	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet">

	<style>
		body {
			background: #333954;
			background-size: 400% 400%;
			height: 100vh;
		}

		.divider:after,
		.divider:before {
			content: "";
			flex: 1;
			height: 1px;
			background: #eee;
		}
	</style>

<style src="signupstyle.css" type="text/css" data-fbcssmodules="css:fb.css.base css:fb.css.dialog css:fb.css.iframewidget css:fb.css.customer_chat_plugin_iframe">
    </style>

<body data-new-gr-c-s-check-loaded="14.1121.0" data-gr-ext-installed="">


 	<div class="container py-5 h-100">
	<div class="row d-flex justify-content-center align-items-center h-100">
	<div class="col col-xl-10">
	<div class="card" style="border-radius: 1rem;">
	<div class="row g-0">

	<div class="col-md-6 col-lg-5 d-none d-md-block position-relative">
	<div class="position-absolute top-50 start-50 translate-middle" style="width: 500px !important; margin-left: 70px !important">
	<img src="spes_logo.png" class="img-fluid" alt="SPES Logo">
	</div> </div>

	<div class="col-md-6 col-lg-7 d-flex align-items-center">
	<div class="card-body p-4 p-lg-5 text-black">
								
	<form id="aep" method="post" onsubmit="check_values();">
	<div class="d-flex align-items-center mb-3 pb-1">
	<img src="dole-logo.png" class="img-fluid" style="width: 100px !important;" alt="Phone image">
	<span class="h1 fw-bold mb-0">Register</span>
	</div>

	<!-- Email input -->
    <div class="form-outline mb-4">
    <div class="">
    <i class="fas fa-caret-down trailing"></i>
    <select name="access_type" class="required form-control form-control-lg border form-icon-trailing">
    <option value="" selected="" disabled="">Im a:</option>
    <option value="0">SPES Applicant</option>
    <option value="1">Employer</option>
    </select>
    </div>
    </div>

	<div class="form-outline mb-4">
	<i class="fas fa-user-alt trailing"></i>
	<input type="text" id="username" name="username" class="form-control form-control-lg border form-icon-trailing" required="">
	<label class="form-label" for="username">Username</label>
	</div>

	<!-- Password input -->
	<div class="form-outline mb-4">
	<i class="fas fa-lock trailing"></i>
	<input type="password" id="password" name="password" class="form-control form-control-lg border form-icon-trailing" required="">
	<label class="form-label" for="password">Password</label>
	</div>

    <hr>
    <div class="form-outline mb-4">
    <i class="fas fa-align-left trailing"></i>
	<input type="text" id="first_name" name="first_name" class="form-control form-control-lg border form-icon-trailing" required="">
	<label class="form-label" for="first_name">First Name</label>
	</div>

	<div class="form-outline mb-4">
    <i class="fas fa-align-center trailing"></i>
	<input type="text" id="middle_name" name="middle_name" class="form-control form-control-lg border form-icon-trailing" required="">
	<label class="form-label" for="middle_name">Middle Name</label>
	</div>

    <div class="form-outline mb-4">
    <i class="fas fa-align-right trailing"></i>
	<input type="text" id="last_name" name="last_name" class="form-control form-control-lg border form-icon-trailing" required="">
	<label class="form-label" for="last_name">Last Name</label>
	</div>
                                    
	<div class="form-outline mb-4">
    <div class="">
    <i class="fas fa-caret-down trailing"></i>
    <select id="sex" name="sex" class="required form-control form-control-lg border form-icon-trailing">
    <option value="" selected="" disabled="">Sex:</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    </select>
    </div></div>

    <div class="form-outline mb-4">
    <i class="fas fa-envelope trailing"></i>
	<input type="email" id="email" name="email" class="form-control form-control-lg border form-icon-trailing" required="">
	<label class="form-label" for="email">Email Address</label>
	</div>

    <div class="form-outline mb-4">
    <i class="fas fa-mobile-alt trailing"></i>
	<input type="text" id="mobile_no" name="mobile_no" class="form-control form-control-lg border form-icon-trailing" required="">
	<label class="form-label" for="mobile_no">Mobile Number</label>
	</div>

	<!-- Submit button -->
	<input type="submit" id="register_butt" class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" value="Sign Up">
	
	<div class="pt-2"></div>
													
	<div class="pt-1 mb-4">
	<div class="divider d-flex align-items-center my-4">
	<p class="text-center fw-bold mx-3 mb-0 text-muted">Already Registered?</p>
	</div>

	<a class="btn btn-primary btn-lg btn-block" 
	style="background-color: #3b5998" href="http://localhost/Capstone/landing.php" role="button">
	<i class="far fa-user me-2"></i>
	Sign In
	</a>		
	</div>

	<div class="divider d-flex align-items-center my-4">
	<a href="#!" class="small text-muted">Copyright © 2023 SPES . All Rights Reserved 
	</div>
									

	</form>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
  	</div>

<!-- </section> -->
<script type="text/javascript">
	
var submit_form = true;
	
$('#aep').validate();
	function check_username(uname){
	if(validateUsername($('#username'))) {
	$.get(' ' + uname, function(data){
		if(data != 1) {
		submit_form = false;
			$('#msg').html('The username already exist. Pease enter another one.');
			$('#msg').show();
			$('#username').attr('style', 'border-color: red !important;');
		} else {
		submit_form = true;
			$('#msg').hide();
			$('#username').attr('style', '');
		}
			});
		} else  {			
			submit_form = false;
		}
	}
	
	function validateUsername(fld) {
	
		var illegalChars = /\W/; // allow letters, numbers, and underscores
 
		if ((fld.val().length < 5) || (fld.val().length > 20)) {
			$('#msg').html('Username must not less than 5 characters and not more than 20 characters.');
			$('#msg').show();
			fld.attr('style', 'border-color: red !important;');
			return false;
		} else if (illegalChars.test(fld.val())) {
			$('#msg').html('Username must be alphanumeric only [A-Z,a-z,0-9].');
			$('#msg').show();
			fld.attr('style', 'border-color: red !important;');
			return false;
		} else {
			$('#msg').hide();
			fld.attr('style', '');
		}
		return true;
	}
	
	function validatepassword(val) {
	
		if (val.length < 5) {
			$('#msg').html('Password must not less than 5 characters');
			$('#msg').show();
			$('#password').attr('style', 'border-color: red !important;');
			submit_form = false;
			return false;
		} else {
			$('#msg').hide();
			$('#password').attr('style', '');
			submit_form = true;
		}
		return true;
	}
	
	$(function() {
		$("#birth_date").datepicker();
		$("#passport_valid_until").datepicker();
		$("#passport_date_issue").datepicker();
		$("#visa_valid_until").datepicker();
		$("#prev_denied_date").datepicker();
		$("#prev_cancelled_date").datepicker();
		$(".wrk_date").datepicker();
	});
    
    function register_aep() {

		$('#loader').show();
		
		var photo					= $('input[name=photo]')[0].files[0];
		var application_form		= $('input[name=application_form]')[0].files[0];
		var contract_employment		= $('input[name=contract_employment]')[0].files[0];
		var employer_mayor_permit	= $('input[name=employer_mayor_permit]')[0].files[0];
		var passport				= $('input[name=passport]')[0].files[0];
		var visa					= $('input[name=visa]')[0].files[0];
		var under_training_program  = $('input[name=under_training_program]')[0].files[0];
		var previous_aep_id			= $('input[name=previous_aep_id]')[0].files[0];
		
		var post_data = new FormData(); 
		post_data.append('photo', photo);
		post_data.append('application_form', application_form);
		post_data.append('contract_employment', contract_employment);
		post_data.append('employer_mayor_permit', employer_mayor_permit);
		post_data.append('passport', passport);
		post_data.append('visa', visa);
		post_data.append('under_training_program', under_training_program);
		post_data.append('previous_aep_id', previous_aep_id);
				
		var post = $("#aep").find("input, select, textarea, checkbox, radio").serialize();
		$.post(post, function(aep_id){
			$('#status_msg').html('Uploading file documents. Please wait.');
			if(aep_id > 0) {
			 	$.ajax({
					url: '/index.php/user/add_docs/' + aep_id,
					data: post_data,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType:'json',
					success: function(data){
					location.href = ' ';
					$('#loader').hide();
				 }
			 	});
			}
		});

	}

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    var butt = ''
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      //testAPI();
      
		FB.api('/me?fields=id,name,email,birthday,education,first_name,last_name,gender,hometown,middle_name', function(me) {
			$('#first_name').val(me.first_name);  
			$('#last_name').val(me.last_name);  
			$('#middle_name').val(me.middle_name);  
			$('#email').val(me.email);  
			$('#sex').val(me.gender);  
			$('#mobile_no').val(me.mobile_no);  
			$('#facebook_id').val(me.id);
			$('#fb_access_token').val(JSON.stringify(response.authResponse)); 
			
			$.get(' ' + me.id, function(data) {
	  			if(data != '0') {
					$('#msg').html('Hi '+ me.first_name + ', you are currently logged to Facebook and connected this account to Online SPES. Click <a href="#" onclick="fb_login(\'' + me.id + '\');">here</a> to login. If you are trying to register for different SPES account, please <a href="https://facebook.com" target="new">logout</a> to Facebook. Thank you!');
					$('#msg').show();
					$('#register_butt').hide();
	  			}
			});
			
	 	});
      
    } 
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '158351504939203',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

	  FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	  });
  };


  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + ', ' + response.id + ', ' + response.accessToken + '!';
    });
  }
  
  function fb_login(id) {

	$.get(' ' + id, function(data) {
	  
	  window.location.replace(' ' + data);
		
	});
		
  }
</script>

<div id="fb-root" class=" fb_reset"><div style="position: absolute; top: -10000px; width: 0px; height: 0px;"><div></div></div></div></body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration></html>