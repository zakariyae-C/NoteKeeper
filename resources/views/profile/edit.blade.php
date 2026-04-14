@extends('layouts.app')

@section('title', 'Note details')
@section('content')
    <x-backBtn />
    <div class="login-register-page place-items-center text-center">
        <form method="POST" action="{{ route('profile.update', $user->id) }}" class="">
            @csrf
            @method('PUT')
            <fieldset class="fieldset w-xs p-4 lg:w-200 ">
                <legend class="fieldset-legend text-center text-3xl mb-8">Profile Info</legend>

                <x-success />
                <label class="label text-base">Name</label>
                <input type="text" name="name" class="input w-full" value="{{ $user->name }}" placeholder="Name"
                    required />
                <x-error field='name' />

                <label class="label text-base">Email</label>
                <input type="email" name="email" class="input w-full" value="{{ $user->email }}" placeholder="Email"
                    required />
                <x-error field='email' />

                <label class="label text-base">Current password</label>
                <input type="password" name="current_password" class="input w-full" placeholder="Current password" />
                <x-error field='current_password' />

                <label class="label text-base">New password</label>
                <input type="password" name="password" class="input w-full" placeholder="New Password" />
                <x-error field='password' />

                <label class="label text-base">Confirmed password</label>
                <input type="password" name="password_confirmation" class="input w-full" placeholder="Confirm Password" />
                <x-error field='password_confirmation' />

                <button class="btn pr-btn mt-4 ">Update</button>

            </fieldset>
        </form>
    </div>
@endsection
