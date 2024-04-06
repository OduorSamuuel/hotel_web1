
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styleform.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


</head>
<body>
<div class="alert hide success">
        <span class="fas fa-check-circle"></span>
        <span class="msg">Success: Account created successfully check your email to activate your account!</span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>
    <div class="container">
        <div class="form-outer">
            <section>
                <!-- Form 1: Enter Email -->
                <form class="page slide-page" action="{{ route('check-email') }}" method="POST" id="emailForm">
                    @csrf
                    <h3>Enter your email to continue</h3>
                    <div class="field">
                        <div class="label">Email</div>
                        <input type="email" name="email" id="emailInput" placeholder="Enter your Email" class="input">
                    </div>
                    <div class="field">
                        @if ($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                        <input type="submit" class="firstNext next" value="Continue" name="submit1">
                    </div>
                </form>

               <!-- Form 2: Set Password -->
<!-- Form 2: Set Password -->
<form class="page slide-page" action="{{ route('register') }}" method="POST" id="passwordForm">
    @csrf
    <h3>Set Your Password</h3>
    <div class="error-message"></div> 
    <div class="field">
        <div class="label">Password</div>
        <input type="password" name="password" id="password" required>
        <span toggle="#password" class="eye toggle-password"></span>
    </div>
    <div class="field">
        <div class="label">Confirm Password</div>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <span toggle="#password_confirmation" class="eye toggle-password"></span>
    </div>
    <div class="field">
        <input type="hidden" name="email" id="email" value="">
    </div>
    <div class="field btns">
        <input type="submit" class="next-1 next" value="Signup" name="signup">
    </div>
</form>



<form class="page slide-page" action="{{ route('signin') }}" method="POST" id="signInForm">
    @csrf
    <h3>Sign In</h3>
    <div class="error-message"></div>
    <div class="field">
        <div class="label">Password</div>
        <input type="password" name="password" id="signInPassword" required>
        <span toggle="#signInPassword" class="eye toggle-password1"></span>
    </div>
    <div class="field btns">
        <input type="hidden" name="email" id="signInEmail" value="">
        <input type="submit" class="submit" value="Submit">
    </div>
    <div class="field">
        <p>Forgot Password? <a href="{{route('reset')}}">Reset it here</a></p>
    </div>
</form>



<!-- Form 3: Sign In -->
<form class="page slide-page" action="{{ route('signin') }}" method="POST" id="signInForm">
    @csrf
    <h3>Sign In</h3>
    <div class="error-message"></div>
    <div class="field">
        <div class="label">Password</div>
        <input type="password" name="password" id="signInPassword" required>
        <span toggle="#signInPassword" class="eye toggle-password"></span>
    </div>
    <div class="field btns">
        <input type="hidden" name="email" id="signInEmail" value="">
        <input type="submit" class="submit" value="Submit">
    </div>
</form>

            </section>
        </div>
    </div>

   <!-- Include jQuery library -->
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- ... (your existing HTML code) ... -->
<script src="https://code.ionicframework.com/1.0.0-beta.6/js/ionic.bundle.js"></script>


    <script>
      $(document).on('click', '.toggle-password', function () {
        $(this).toggleClass('active');
        var input = $($(this).attr('toggle'));
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
    $(document).on('click', '.toggle-password1', function () {
        $(this).toggleClass('active');
        var input = $($(this).attr('toggle'));
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
   
    </script>
    <script>
 document.addEventListener("DOMContentLoaded", function () {
    const emailForm = document.getElementById("emailForm");
    const passwordForm = document.getElementById("passwordForm");
    const signInForm = document.getElementById("signInForm");
    const emailInput = document.getElementById("emailInput");

    // Get the sliding state from localStorage or default to false
    let hasSlidedEmailForm = localStorage.getItem('hasSlidedEmailForm') === 'true' || false;


    if (hasSlidedEmailForm) {
        document.querySelector(".slide-page").style.marginLeft = "-50%";
    }

    setTimeout(() => {
        localStorage.removeItem('hasSlidedEmailForm');
    }, 2000);

    window.addEventListener('popstate', function (event) {
       
        localStorage.removeItem('hasSlidedEmailForm');
    });

 
    function handleFormSubmit(form, onSuccess, onError) {
        $(form).submit(function (event) {
            event.preventDefault();

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    onSuccess(response);
                },
                error: function (error) {
                    onError(error);
                }
            });
        });
    }

    // Email Form Submission
    handleFormSubmit(emailForm, function (response) {
        const email = emailInput.value;
        if (!hasSlidedEmailForm) {
            document.getElementsByName('email')[0].value = email;
            document.getElementsByName('email')[1].value = email;
            document.getElementById("signInEmail").value = email;

            if (response.status === 'found') {
                document.querySelector(".slide-page").style.marginLeft = "-50%";
                hasSlidedEmailForm = true;
                localStorage.setItem('hasSlidedEmailForm', 'true');
                setTimeout(() => {
                    localStorage.removeItem('hasSlidedEmailForm');
                }, 10);
            } else {
                document.querySelector(".slide-page").style.marginLeft = "-25%";
            }
        }
    }, function (error) {
        console.error(error);
       
        displayErrorMessage('#emailForm .error-message', 'Error: ' + error.responseJSON.error);
    });

    // Password Form Submission
    handleFormSubmit(passwordForm, function (response) {
        console.log('Password Form Success:', response); 

     
        if (response.error) {
        
            displayErrorMessage('#passwordForm .error-message', response.error);
        } else {
             
           
            showAlert() ;
          
        }
    }, function (error) {
        console.error(error);
        
        displayErrorMessage('#passwordForm .error-message', 'Error: ' + error.responseJSON.error);
    });

   


    handleFormSubmit(signInForm, function (response) {
    console.log('Sign In Form Success:', response); // Debug statement

    if (response.error) {
        displayErrorMessage('#signInForm .error-message', response.error);
    } else {
        if (response.role === 'admin') {
          
            window.location.href = "{{ route('admin.home') }}";
        } else {
          
            window.location.href = "{{ route('home') }}";
        }
    }
}, function (error) {
    console.error(error);

    const errorMessage = error.responseJSON && error.responseJSON.error
        ? 'Error: ' + error.responseJSON.error
        : 'An unexpected error occurred. Please try again.';

    displayErrorMessage('#signInForm .error-message', errorMessage);
});

function displayErrorMessage(selector, message) {
    const errorContainer = document.querySelector(selector);
    errorContainer.textContent = message;

    // You can add additional styling or effects for the error message here
}

    function displayErrorMessage(selector, message) {
        const errorContainer = document.querySelector(selector);
        errorContainer.innerHTML = message;
        errorContainer.style.display = 'block';

        // Automatically hide the error message after 5 seconds
        setTimeout(() => {
            errorContainer.style.display = 'none';
        }, 5000);
    }
});
function showAlert() {
    $('.alert').addClass("show");
    $('.alert').removeClass("hide");
    $('.alert').addClass("showAlert");
    setTimeout(function () {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
        window.location.href = "{{ route('log') }}";
    }, 5000);
  
}

$('.your-button-selector').click(function () {
    showAlert();
});

$('.close-btn').click(function () {
    $('.alert').removeClass("show");
    $('.alert').addClass("hide");
});

  
</script>



</body>
</html>
