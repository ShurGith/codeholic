@props(['color' =>'green', 'bgColor'=>'crimson'])
<div style="background:{{$color}}"
     class="bg-slate-300 min-w-96 flex justify-center flex-col items-center my-4 rounded-lg">
  <div {{$title->attributes->class("card-header")}}>{{$title}}  </div>
  {!!  $slot->isEmpty()  ? '<p class="text-white">⚠️ ❗❗Please Write a Text. ❗</p>': $slot !!}
  <div {{$footer->attributes->class("card-footer text-sm")}}>{{ $footer }}</div>
</div>


{{--
<div {{$attributes}} class="{{ $color }} {{$bgColor}}">
  <div class="card-header">{{ $title }}</div>
  {!!  $slot->isEmpty()  ? '<p class="text-red-600">⚠️ ❗❗Please Write a Text. ❗</p>': $slot !!}
  <div {{$footer->attributes->class("card-footer text-sm")}}>{{ $footer }}</div>
</div>
--}}

{{--
<div {{$attributes->merge(['type'=>'card'])->class('card-class')}}>
  <div {{ $title->attributes->class('card-header') }}>
    {{ $title }}
  </div>
  {!!  $slot->isEmpty()  ? '<p class="text-red-600">⚠️ ❗❗Please Write a Text. ❗</p>': $slot !!}
  <div {{$footer->attributes->class("card-footer text-sm")}}>{{ $footer }}</div>
</div>

<div {{
    $attributes
        ->class("card card-text-$color card-bg-$bgColor")
        ->merge(['lang' => 'en'])
}}>
    ...
</div>
--}}
