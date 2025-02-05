<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="abc@gmail.com" value="{{ old('email') }}" class="@error('email') error-border @enderror" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="******" class="@error('password') error-border @enderror" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Login</button>

            <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
        </form>
    </div>
</body>
</html>
