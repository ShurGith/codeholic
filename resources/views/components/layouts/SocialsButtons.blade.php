<div class="grid grid-cols-2 gap-1 social-auth-buttons">
  <x-partials.SocialButton href=" {{ route('login.oauth', 'google') }}"/>
  <x-partials.SocialButton img="facebook.png" texto="Facebook" href=" {{ route('login.oauth', 'facebook') }}"/>
  <x-partials.SocialButton img="youtube.png" texto="Youtube"/>
  <x-partials.SocialButton img="laravel.png" texto="Laravel"/>
</div>