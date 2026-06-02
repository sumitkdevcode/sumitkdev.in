<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f3f4f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Inter', sans-serif;
            padding: 20px;
            box-sizing: border-box;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            background: white;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-radius: 0;
            overflow: hidden;
        }

        .login-header {
            background: black;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .login-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .input-field {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #e5e7eb;
            outline: none;
            font-size: 13px;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }

        .input-field:focus {
            border-color: #000;
        }

        .login-btn {
            width: 100%;
            background: black;
            color: white;
            padding: 10px;
            border: none;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-sizing: border-box;
        }

        .login-btn:hover {
            background: #222;
        }

        .error-msg {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }

        @media (max-width: 480px) {
            .login-header { padding: 15px 15px; }
            .login-header h1 { font-size: 18px; }
            .login-body { padding: 15px; }
            .form-group { margin-bottom: 12px; }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <h1>Admin Panel Login</h1>
        </div>
        <div class="login-body">
            @if(session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}" class="input-field"
                        placeholder="Enter your email" required autofocus autocomplete="username">
                    @if($errors->has('email'))
                        <div class="error-msg">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="input-field" placeholder="Enter your password"
                        required autocomplete="current-password">
                    @if($errors->has('password'))
                        <div class="error-msg">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 border-gray-300 rounded text-black focus:ring-black">
                        <span class="ml-2 text-xs text-gray-400 uppercase tracking-widest">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}"
                        class="text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors">Forgot
                        Password?</a>
                </div>

                <button type="submit" class="login-btn">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>