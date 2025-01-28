@props([ 'isRadio' =>false,  ])
@if($isRadio)
  @foreach($types as $type)
    <label class="inline-radio gap-1.5">
      <input type="radio" name="car_type_id" value="{{ $type->id }}"
        @checked($attributes->get('value') == $type->id)/>
      {{ $type->name }}
    </label>
  @endforeach
@else
  <select name="car_type_id">
    <option value="">Type</option>
    @foreach($types as $type)
      <option value="{{ $type->id }}"
        @selected($attributes->get('value') == $type->id) >{{ $type->name }}</option>
    @endforeach
  </select>
@endif

