@props([ 'isRadio' =>false, ])
@if($isRadio)
  @foreach($fuelTypes as $fuelType)
    <label class="inline-radio gap-1.5">
      <input type="radio" name="fuel_type_id" value="{{ $fuelType->id }}"
        @checked($attributes->get('value') == $fuelType->id)/>
      {{ $fuelType->name }}
    </label>
  @endforeach
@else
  <select name="fuel_type_id">
    <option value="">Fuel Type</option>
    @foreach($fuelTypes as $fuelType)
      <option value="{{ $fuelType->id }}"
        @selected($attributes->get('value') == $fuelType->id)>{{ $fuelType->name }}</option>
    @endforeach
  </select>
@endif

