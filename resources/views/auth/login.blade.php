<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="login-register-page">
        <div class="flex w-full flex-col h-screen lg:flex-row">
            <div class="card bg-base-100 grid grow place-items-center">
                <form method="POST" action="{{route('login.auth')}}">
                    @csrf
                    <fieldset class="fieldset w-xs p-4">
                        <legend class="fieldset-legend text-center text-3xl mb-5">Login</legend>

                        <x-error field='failedLogin' />
                        <label class="label">Email</label>
                        <input type="email" name="email" class="input" placeholder="Email" />
                        <x-error field='email' />

                        <label class="label">Password</label>
                        <input type="password" name="password" class="input" placeholder="Password" />
                        <x-error field='password' />

                        <button class="btn btn-primary mt-4">Login</button>

                        <span class="mt-3 text-center">don't have an account? <a href="{{route('register')}}" class="link">Register</a></span>
                    </fieldset>
                </form>
            </div>
            <x-loginStyle />
        </div>
    </div>
</body>
</html>