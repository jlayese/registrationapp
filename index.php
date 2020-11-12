<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration App</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <section id="registration">

    <div class="container">
      <div class="header">
        <h2>MATH CAMPS</h2>
      </div>
      <form action="" id="reg-form" method="post">   
       

        <div class="form-control">
          <input type="text" id="email" name ="email" placeholder="Enter Email Address" />
          <small class=""></small>
        </div>
        
        <div class="form-control">
          <input type="password" id="password" name ="password" placeholder="Enter Password" autocomplete="OFF"/>
          <small class=""></small>
        </div>

        <button type="submit" name="login" id="login">login</button>

        <div id="error_message" class="ajax_response" style="float:left"></div>
        <div id="success_message" class="ajax_response" style="float:left">
        <p>Data Inserted!</p>
        </div>

      </form>
      <p><a href="registration.php">No Account?</a></p>
    </div>


  </section>

  <script>

  $(document).ready(function(){

    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let actionString = 'login';    
    console.log(actionString)
      function checkEmail(){
				// trim to remove the whitespaces
				let emailval = email.value.trim();	
				if(emailval === '') {
					setErrorFor(email, 'Email cannot be blank');
				}else if (!isEmail(emailval)) {
					setErrorFor(email, 'Not a valid email');
				}else {
					setSuccessFor(email);
				}
			}

      function checkpass(){
				let passval = password.value.trim();
				if(passval === '') {
					setErrorFor(password, 'Password cannot be blank');
				} else {
					setSuccessFor(password);
				}
			}

      function setErrorFor(input, message) {
				const formControl = input.parentElement;
				const small = formControl.querySelector('small');
				formControl.className = 'form-control error';
				small.innerText = message;
       
			}
			
			function setSuccessFor(input) {
				const formControl = input.parentElement;
				formControl.className = 'form-control success';
			}

			function isEmail(email) {
				return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
			}

		$("#email").keyup(function(){
			checkEmail();
		});

    $("#password").keyup(function(){
			checkpass();
		});
    
    $('#login').on('click', function(e){
      e.preventDefault();
      if ($.trim($("#password").val()) === "" || $.trim($("#email").val()) === "") {
        alert('You did not fill out one of the fields.');
        return false;
      } else {

        let email = $("#email").val().trim();
        let password = $("#password").val().trim();

        $.ajax({
            type: 'POST',
            url: "datacrud.php",
            data: {
              email:email,
              password:password,
              action:actionString
            },
            success: function(response){
              console.log(response)
              var msg = "";
                    if(response == 1){
                        window.location = "home.php";
                    }else{
                        msg = "Invalid username and password!";
                    }
                    $("#error_message").html(msg);
            },
					  cache: false,
          });
      }
    });
  });
  </script>
</body>
</html>