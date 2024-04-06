<!-- resources/views/auth/reset-password.blade.php -->
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

<div class="container">
    <div class="form-outer">
        <section>
            <form class="page slide-page" action="{{ route('validate-reset-code') }}" method="POST" id="codeEntryForm">
                @csrf
                <h3>Enter the code sent to your email</h3>
                <div class="error-message" id="codeErrorMessage"></div>
                <div class="field">
                    <textarea id="userCode" name="userCode" rows="4" cols="50" required></textarea>
                </div>
                <div class="field btns">
                    <input type="submit" class="submit" value="Submit">
                </div>
            </form>

            <form class="page slide-page" action="{{ route('reset-password') }}" method="POST" id="passwordResetForm">
                @csrf
                <h3>Set new password</h3>
                <div class="error-message" id="passwordErrorMessage"></div>
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
                   
                </div>
                <div class="field btns">
                    <input type="submit" class="next-1 next" value="Reset" name="reset">
                </div>
            </form>
        </section>
    </div>
</div>
<<!-- Include jQuery and Axios libraries -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const codeEntryForm = document.getElementById("codeEntryForm");
    const passwordResetForm = document.getElementById("passwordResetForm");

    // Check if the URL contains a query parameter for sliding
    const urlParams = new URLSearchParams(window.location.search);
    const shouldSlide = urlParams.get('slideForm') === 'true';

    if (shouldSlide) {
        document.querySelector(".slide-page").style.marginLeft = "-25%";
        // Remove the query parameter from the URL to avoid persisting the sliding effect
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    function handleFormSubmit(form, onSuccess, onError) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(form);
            formData.append('code', document.getElementById('userCode').value); // Add this line to include the code

            axios.post(form.action, formData)
                .then(response => {
                    onSuccess(response.data);
                })
                .catch(error => {
                    onError(error.response.data);
                });
        });
    }

    // Code Entry Form Submission
    handleFormSubmit(codeEntryForm, function (response) {
        if (!shouldSlide) {
            document.querySelector(".slide-page").style.marginLeft = "-25%";
            // Add the query parameter to the URL to trigger the sliding effect on subsequent form submissions
            window.history.replaceState({}, document.title, window.location.pathname + '?slideForm=true');
        }
    }, function (error) {
        console.error(error);

        displayErrorMessage('#codeEntryForm .error-message', 'Error: ' + error.error);
    });

    // Password Reset Form Submission
    handleFormSubmit(passwordResetForm, function (response) {
        if (response.error) {
            displayErrorMessage('#passwordResetForm .error-message', response.error);
        } else {
           // showAlert();
           window.location.href = "{{ route('log') }}";

        }
    }, function (error) {
        console.error(error);

        displayErrorMessage('#passwordResetForm .error-message', 'Error: ' + error.error);
    });

    function displayErrorMessage(selector, message) {
        const errorContainer = document.querySelector(selector);
        errorContainer.innerHTML = message;
        errorContainer.style.display = 'block';

        // Automatically hide the error message after 5 seconds
        setTimeout(() => {
            errorContainer.style.display = 'none';
        }, 5000);
    }

    function showAlert() {
        // Your existing showAlert logic
    }
});


</script>

</body>
</html>
