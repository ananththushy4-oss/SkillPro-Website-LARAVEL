<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form-wrapper">
            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Logo" class="logo-image">
                    <span class="logo-text">SkillPro Institute</span>
                </div>
                <h2>Welcome Back!</h2>
                <p>Please select your role and log in to continue.</p>
            </div>

            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="role-selection">
                <button type="button" class="role-btn active" data-role="student">Student</button>
                <button type="button" class="role-btn" data-role="admin">Admin</button>
                <button type="button" class="role-btn" data-role="instructor">Instructor</button>
            </div>

            <form class="login-form" method="POST" action="{{ route('login.submit') }}">
                @csrf

                <input type="hidden" name="role" id="selectedRole" value="Student">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="far fa-eye"></i></span>
                    </div>
                </div>

                <!-- Forgot Password -->
                <div class="forgot-password">
                <a href="{{ route('forgot.password') }}">Forgot your password?</a>  
                </div>

                <button type="submit" class="btn-primary">Sign In</button>

                <div class="signup-link">
                    Don't have an account? <a href="{{ route('register.form') }}">Sign Up</a>
                </div>
            </form>
        </div>

        <div class="background-image" id="role-background"></div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
