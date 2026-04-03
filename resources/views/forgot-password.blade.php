<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - SkillPro Institute</title>
    
    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="registration-container">
        <div class="registration-form-wrapper">
            <div class="registration-header">
                <div class="logo">
                    <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Logo" class="logo-image">
                    <span class="logo-text">SkillPro Institute</span>
                </div>
                <h2>Forgot Password</h2>
                <p>Reset your password to access your account.</p>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="registration-form" id="forgotPasswordForm" action="{{ route('forgot.password.submit') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <div class="icon-input">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="icon-input">
                        <i class="fas fa-key"></i>
                        <input type="text" name="forgotPin" placeholder="Forgot Pin (4 digits)" pattern="[0-9]{4}" value="{{ old('forgotPin') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="icon-input password-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="New Password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="icon-input password-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirmPassword')">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Reset Password</button>

                <div class="login-link">
                    Remembered your password? <a href="{{ route('login.form') }}">Sign In</a>
                </div>
            </form>
        </div>
    </div>

    {{-- JS for eye toggle --}}
    <script>
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
