<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="login-register-page">
        <div class="flex w-full flex-col h-screen lg:flex-row">
            <x-loginStyle />
            <div class="card bg-base-100 grid grow place-items-center">
                <form method="POST" action="{{route('register.store')}}">
                    @csrf
                    <fieldset class="fieldset w-xs p-4">
                        <legend class="fieldset-legend text-center text-3xl mb-5">Register</legend>

                        <label class="label">Name</label>
                        <input type="text" name="name" class="input" placeholder="Name" required/>
                        <x-error field='name' />

                        <label class="label">Email</label>
                        <input type="email" name="email" class="input" placeholder="Email" required/>
                        <x-error field='email' />

                        <label class="label">Password</label>
                        <input type="password" name="password" class="input" placeholder="Password" required/>
                        <x-error field='password' />

                        <button class="btn btn-primary mt-4">Register</button>

                        <span class="mt-3 text-center">have an account? <a href="{{route('login')}}" class="link">Log in</a></span>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
</html>