<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SkillPro Institute</title>
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
                <h2>Create Your Account</h2>
                <p>Join us to build your future with SkillPro Institute.</p>
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

            <form class="registration-form" id="registrationForm" action="{{ route('register.submit') }}" method="POST">
                @csrf

                <!-- Role Selection -->
                <div class="role-selection">
                    <label>I am a:</label>
                    <select id="userRole" name="role">
                        <option value="Student" {{ old('role')=='Student' ? 'selected' : '' }}>Student</option>
                        <option value="Admin" {{ old('role')=='Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Instructor" {{ old('role')=='Instructor' ? 'selected' : '' }}>Instructor</option>
                    </select>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <div class="icon-input">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <div class="icon-input">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <div class="icon-input">
                        <i class="fas fa-phone-alt"></i>
                        <input type="tel" id="phoneNumber" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="icon-input password-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('password')"><i class="far fa-eye"></i></span>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <div class="icon-input password-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirmPassword')"><i class="far fa-eye"></i></span>
                    </div>
                </div>

                <!-- Date of Birth -->
                <div class="form-group">
                    <div class="icon-input">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                    </div>
                </div>

                <!-- Forgot Pin -->
                <div class="form-group">
                    <div class="icon-input">
                        <i class="fas fa-key"></i>
                        <input type="text" name="forgot_pin" id="forgotPin" value="{{ old('forgot_pin') }}" placeholder="Forgot Pin (4 digits)">
                    </div>
                </div>

                <!-- Register Code -->
                <div class="form-group" id="registerCodeGroup" style="display:none;">
                    <div class="icon-input">
                        <i class="fas fa-shield-alt"></i>
                        <input type="text" name="register_code" id="registerCode" value="{{ old('register_code') }}" placeholder="Register Code (4 digits)">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">Register</button>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login.form') }}">Sign In</a>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
