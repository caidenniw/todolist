<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Dive</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0ea5e9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }
        
        .particle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            background: radial-gradient(circle at 30% 30%, rgba(56, 189, 248, 0.4), rgba(14, 165, 233, 0.1));
            animation: float 20s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0.3;
            }
            25% { 
                transform: translateY(-150px) translateX(50px) scale(1.2);
                opacity: 0.5;
            }
            50% { 
                transform: translateY(-100px) translateX(-50px) scale(0.8);
                opacity: 0.4;
            }
            75% { 
                transform: translateY(-200px) translateX(100px) scale(1.1);
                opacity: 0.6;
            }
        }
        
        .auth-container {
            max-width: 400px;
            width: 100%;
            position: relative;
            z-index: 10;
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(30px);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .logo-text {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -2px;
        }
        
        .logo-subtitle {
            color: #64748b;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        .auth-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.375rem;
        }
        
        .auth-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.375rem;
            font-size: 0.8125rem;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }
        
        .form-control.is-invalid {
            border-color: #ef4444;
        }
        
        .invalid-feedback {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        .btn-primary {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(14, 165, 233, 0.5);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }
        
        .divider span {
            background: white;
            padding: 0 1rem;
            color: #94a3b8;
            font-size: 0.875rem;
            position: relative;
        }
        
        .auth-link {
            text-align: center;
            color: #64748b;
            font-size: 0.875rem;
        }
        
        .auth-link a {
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 600;
        }
        
        .auth-link a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .auth-card {
                padding: 1.5rem;
            }
            
            .logo-text {
                font-size: 2rem;
            }
            
            .auth-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    
    <!-- Animated Bubbles -->
    <div class="particle" style="width: 120px; height: 120px; top: 10%; left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="width: 80px; height: 80px; top: 20%; left: 85%; animation-delay: 3s;"></div>
    <div class="particle" style="width: 150px; height: 150px; top: 60%; left: 80%; animation-delay: 6s;"></div>
    <div class="particle" style="width: 100px; height: 100px; top: 75%; left: 15%; animation-delay: 9s;"></div>
    
    <div class="auth-container">
        <div class="auth-card">
            <div class="logo">
                <div class="logo-text">Dive</div>
                <div class="logo-subtitle">Dive into focused work</div>
            </div>
            
            <h2 class="auth-title">Create account</h2>
            <p class="auth-subtitle">Start organizing your tasks today</p>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}"
                           placeholder="John Doe" 
                           required 
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}"
                           placeholder="you@example.com" 
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Minimum 8 characters" 
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" 
                           name="password_confirmation" 
                           class="form-control" 
                           placeholder="Re-enter your password" 
                           required>
                </div>
                
                <button type="submit" class="btn-primary">
                    Create Account
                </button>
            </form>
            
            <div class="divider">
                <span>or</span>
            </div>
            
            <div class="auth-link">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>

</body>
</html>
