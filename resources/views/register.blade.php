<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheraConnect - Register</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --thera-primary: #d97757;
            --thera-bg: #fdfaf7;
            --thera-input-fill: #fff2ec;
        }
        
        body { 
            background-color: var(--thera-bg); 
            font-family: 'Inter', sans-serif; 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 40px 20px;
        }

        .auth-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(217, 119, 87, 0.05);
            width: 100%;
            max-width: 440px;
            margin: auto;
        }

        .auth-logo {
            color: var(--thera-primary);
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 15px;
            padding: 12px 20px;
            border: 1px solid #fce8dd;
            background-color: var(--thera-input-fill);
            color: #4a4a4a;
            transition: all 0.2s ease-in-out;
            height: auto;
            min-height: 44px;
            display: flex;
            align-items: center;
        }

        .form-control::placeholder {
            color: #8fa1b1;
            font-weight: 400;
        }

        .form-control:focus {
            background-color: #ffe8dd;
            border-color: var(--thera-primary);
            box-shadow: 0 0 0 0.25rem rgba(217, 119, 87, 0.1);
            outline: none;
        }

        .btn-auth {
            background-color: var(--thera-primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
        }

        .btn-auth:hover {
            background-color: #c4664a;
            color: white;
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.95rem;
            color: #888;
        }

        .auth-footer a {
            color: var(--thera-primary);
            text-decoration: none;
            font-weight: 600;
        }

        .requirement-list {
            font-size: 0.85rem;
            padding-left: 5px;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .alert {
            border-radius: 15px;
            border: none;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="auth-card shadow-lg">
        <h2 class="auth-logo">TheraConnect</h2>
        <p class="text-center text-muted mb-4">Create your Clinician Account</p>

        <!-- Laravel Validation Errors (Refined UI) -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center mb-1">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Check the following:</strong>
                </div>
                <ul class="mb-0 ps-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form action="/register-submit" method="POST">
            @csrf 
            
            <div class="mb-3">
                <input type="text" name="full_name" class="form-control" placeholder="Full Name" value="{{ old('full_name') }}" required>
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
            </div>
            
            <div class="mb-2">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            
            <div class="requirement-list text-start">
                <ul class="list-unstyled mb-0">
                    <li id="char-length" class="text-danger py-1">
                        <i class="bi bi-dot"></i> At least 8 characters
                    </li>
                    <li id="pw-match" class="text-danger py-1">
                        <i class="bi bi-dot"></i> Passwords must match
                    </li>
                </ul>
            </div>

            <div class="mb-4">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>
            
            <button type="submit" class="btn-auth shadow-sm">Sign Up</button>
        </form>
        
        <div class="auth-footer">
            Already have an account? <a href="/login">Sign In</a>
        </div>
    </div>

    <!-- Bootstrap JS for dismissible alerts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');
        const charRequirement = document.getElementById('char-length');
        const matchRequirement = document.getElementById('pw-match');

        function validate() {
            // Check Length
            if (password.value.length >= 8) {
                charRequirement.classList.replace('text-danger', 'text-success');
                charRequirement.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> At least 8 characters';
            } else {
                charRequirement.classList.replace('text-success', 'text-danger');
                charRequirement.innerHTML = '<i class="bi bi-dot"></i> At least 8 characters';
            }

            // Check Match
            if (password.value === confirm.value && password.value !== '') {
                matchRequirement.classList.replace('text-danger', 'text-success');
                matchRequirement.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Passwords match';
            } else {
                matchRequirement.classList.replace('text-success', 'text-danger');
                matchRequirement.innerHTML = '<i class="bi bi-dot"></i> Passwords must match';
            }
        }

        password.addEventListener('input', validate);
        confirm.addEventListener('input', validate);
    </script>
</body>
</html>