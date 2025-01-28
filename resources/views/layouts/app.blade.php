@props(['title' => '', 'footerLinks' => ''])

<x-base-layout :$title>
  <x-layouts.header/>
  @session('success')
  <div class="container my-large">
    <div class="success-message">
      {{ session('success') }}
    </div>
  </div>
  @endsession
  
  {{ $slot }}
  <footer>
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    {{ $footerLinks }}
  </footer>
</x-base-layout>

