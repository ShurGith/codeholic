<select id="year" name="year">
  <option value="">Year</option>
  @for($i=date('Y'); $i>= App\Models\Car::getMinYear(); $i--)
    <option value="{{ $i }}"
      @selected($attributes->get('value') == $i)>{{ $i }}</option>
  @endfor
</select>
<p class="error-message text-red-500">
  {{ $errors->first('year') }}
</p>