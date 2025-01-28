@props(['title' => '', 'bodyClass' => '', 'socialAuth' => true])
<x-app-layout title="Login" bodyClass="page-login" :socialAuth="false">
  <main>
    <div class="container-small page-login">
      <div class="flex" style="gap: 5rem">
        <div class="auth-page-form">
          <div class="text-center">
            <a href="/">
              <img src="/img/logoipsum-265.svg" alt=""/>
            </a>
          </div>
          <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ request('token') }}">
            <div class="form-group @error('email') has-error @enderror">
              <input type="email" readonly name="email" value="{{ request('email') }}"/>
              <div class="error-message">
                {{ $errors->first('email') }}
              </div>
            </div>
            <div class="form-group @error('password') has-error @enderror">
              <input type="password" placeholder="New Password" name="password"/>
              <div class="error-message">
                {{ $errors->first('password') }}
              </div>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Repeat New Password" name="password_confirmation"/>
            </div>
            <button class="btn btn-primary btn-login w-full">
              Reset Password
            </button>
          </form>
          @if ($socialAuth)
            <x-layouts.SocialsButtons/>
          @endif
          @isset($footerLink)
            <div class="login-text-dont-have-account">
              {{ $footerLink }}
            </div>
          @endisset
        </div>
        <div class="auth-page-image">
          <img src="/img/car-png-39071.png" alt="" class="img-responsive"/>
        </div>
      </div>
    </div>
  </main>
</x-app-layout>
