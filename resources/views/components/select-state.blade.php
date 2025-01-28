<select id="stateSelect" name="state_id">
  <option value="">State/Region</option>
  @foreach($states as $state)
    <option value="{{ $state->id }}"
      @selected($attributes->get('value') == $state->id)>{{ $state->name }}</option>
  @endforeach
</select>
<p class="error-message text-red-500">
{{ $errors->first('state_id') }}
</p>