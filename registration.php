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
        <h2>MATH CAMPS REGISTRATION FORM</h2>
      </div>
      <form action="" id="reg-form" method="post">   
        <div class="form-control">
          <input type="text" id="firstname" name='firstname' placeholder="Enter First Name" autocomplete="OFF"/>
          <small class=""></small>
        </div>

        <div class="form-control">
          <input type="text" id="lastname" name='lastname' placeholder="Enter Last Name" autocomplete="OFF"/>
          <small class=""></small>
        </div>

        <div class="form-control">
          <input type="text" id="email" name ="email" placeholder="Enter Email Address" autocomplete="OFF"/>
          <small class=""></small>
        </div>
        
        <div class="form-control">
          <input type="password" id="password" name ="password" placeholder="Enter Password" autocomplete="OFF"/>
          <small class=""></small>
        </div>

        <div class="form-control">
          <input type="date" name='date' class="cdate" id="cdate"/>
        </div>

        <div class="form-control">
          <input type="text" name='time' class="ctime" id="ctime"/>
        </div>

        <button type="submit" id="submit">Submit</button>

        <div id="error_message" class="ajax_response" style="float:left"></div>
        <div id="success_message" class="ajax_response" style="float:left">
        <p>Data Inserted!</p>
        </div>

      </form>
      div.
      <p><a href="index.php">Have an account already?</a></p>
    </div>


  </section>

  <script>

  $(document).ready(function(){

    const form = document.getElementById('container');
		const firstname = document.getElementById('firstname');
    const lastname = document.getElementById('lastname');
    const email = document.getElementById('email');
		const password = document.getElementById('password');
    
    function checkFirstname(){
				let fval = firstname.value.trim();   
				if(fval === '' || fval.length === 0) {
					setErrorFor(firstname, 'Firstname cannot be blank');
				} else {
					setSuccessFor(firstname);
				}
			}

			function checkLastname(){
				let lval = lastname.value.trim();
				if(lval === '') {
					setErrorFor(lastname, 'Lastname cannot be blank');
				} else {
					setSuccessFor(lastname);
				}
			}

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
        console.log(formControl)
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

      let dateElement = document.getElementById("cdate");
      document.getElementById('cdate').valueAsDate = new Date();
      dateElement.style.fontSize = '12px';
      dateElement.style.fontFamily = 'Century Gothic';
      
    setInterval(
    function DisplayTime(){
      let timeElement = document.getElementById("ctime");
      let CurrentDate = new Date();
      let hours = CurrentDate.getHours();
      let minutes = CurrentDate.getMinutes();
      let seconds = CurrentDate.getSeconds();
      let DayNight = "PM";
      
      (hours < 12 ) ? DayNight = "AM" : hours = hours - 12;

      if (hours===0) hours = 12;
      if (minutes<=9) minutes = "0"+minutes;
      if (seconds<=9) seconds = "0"+seconds;

      let currentTime = hours+":"+minutes+":"+seconds+" "+DayNight;

      timeElement.style.fontWeight = 'regular';
      timeElement.style.fontFamily = 'Century Gothic';
      timeElement.style.fontSize = '12px';
      timeElement.style.color = '#000';

      timeElement.value = currentTime;
    }, 1000);

    $("#firstname").keyup(function(){
				checkFirstname();
		});
		$("#lastname").keyup(function(){
			checkLastname();
		});
		$("#email").keyup(function(){
			checkEmail();
		});

    $("#password").keyup(function(){
			checkpass();
		});

    $('#submit').on('click', function(e){
      e.preventDefault();
      if ($.trim($("#firstname").val()) === "" || $.trim($("#lastname").val()) === "" || $.trim($("#password").val()) === "" || $.trim($("#email").val()) === "") {
        
        alert('You did not fill out one of the fields.');
        return false;

      } else {

        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let date = $("#cdate").val();
        let time = $("#ctime").val();
        let action = 'register';

        $.ajax({
            type: 'POST',
            url: 'datacrud.php',
            data: {
              firstname : firstname,
              lastname : lastname,
              email : email,
              password : password,
              date : date,
              time : time,
              action : action
            },
            success: function(data){
              $('#reg-form')[0].reset();
                $('.form-control').removeClass('success');
                  //$('#registration').hide('p');
                  $("#success_message").fadeIn();
              setTimeout(function() { 
                $("#success_message").fadeOut();
                window.location.reload(false);
              }, 3000);
			      },
					  cache: false,
          });
      }
    });
  });
  </script>
</body>
</html>