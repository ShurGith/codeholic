@props(['options'=>  App\Models\Car::getCarFeatures(), 'car' => null ])
@foreach($options as $option)
  <label class="ml-2">
    <input type="checkbox" value="1" name="features[{{ $option }}]"
    @isset($car)
      @checked($car->features[$option])
      @endisset
      @checked(old('features.'.$option, $car?->features->$option))
    />
    {{ ucwords(str_replace('_',' ', $option)) }}
  </label>
@endforeach


