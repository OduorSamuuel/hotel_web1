<!-- resources/views/auth/send-reset-link.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styleform.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>

<div class="container">
    <div class="form-outer">
        <section>
            <form class="page slide-page" action="{{ route('send-reset-link') }}" method="POST" id="resetEmailForm">
                @csrf
                <h3>Reset Password</h3>
                @if(session('status'))
                    <div class="success-message">{{ session('status') }}</div>
                @endif
                @if($errors->any())
                    <div class="error-message">{{ $errors->first() }}</div>
                @endif
                <div class="field">
                    <div class="label">Email</div>
                    <input type="email" name="email" id="emailInput" placeholder="Enter your Email" class="input" value="{{ old('email') }}">
                </div>
                <div class="field">
                    <input type="submit" class="firstNext next" value="Reset Password" name="submit2">
                </div>
            </form>
        </section>
    </div>
</div>

</body>
</html>