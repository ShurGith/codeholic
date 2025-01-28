@props(['img' => 'google.png', 'texto' =>'Google' , 'href'=>""] )
<a href="{{ $href }}" class="btn btn-default flex justify-center items-center gap-1">
  <img src="/img/{{ $img }}" alt="" style="width: 20px"/>
  {{ $texto }}
</a>