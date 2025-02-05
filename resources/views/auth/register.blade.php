<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter name" required value="{{ old('name') }}" class="@error('name') error-border @enderror">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="abc@gmail.com" required value="{{ old('email') }}" class="@error('email') error-border @enderror">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="******" required class="@error('password') error-border @enderror">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</body>
</html>
