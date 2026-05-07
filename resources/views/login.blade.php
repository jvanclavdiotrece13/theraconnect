<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheraConnect - Sign In</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .auth-card {
            background: white;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(217, 119, 87, 0.05);
            width: 100%;
            max-width: 400px;
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

        /* TheraConnect Alert Styling[cite: 1] */
        .alert {
            border-radius: 15px;
            border: none;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="auth-card shadow-lg">
        <h2 class="auth-logo">TheraConnect</h2>
        <p class="text-center text-muted mb-4">Sign in to the Clinician Dashboard</p>

        <!-- Display Login Failures[cite: 1] -->
        @if ($errors->has('login_error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ $errors->first('login_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Display Registration Success[cite: 1] -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form action="/login-submit" method="POST">
            @csrf <!-- CRITICAL: Prevents 419 Page Expired Error[cite: 1] -->
            
            <div class="mb-3">
                <!-- value="{{ old('email') }}" keeps the field filled after a failure[cite: 1] -->
                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
            </div>
            
            <div class="mb-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            
            <button type="submit" class="btn-auth">Log In</button>
        </form>
        
        <div class="auth-footer">
            Don't have an account? <a href="/register">Sign Up</a>
        </div>
    </div>

    <!-- Required for alert close buttons and transitions[cite: 1] -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>