<select id="modelSelect" name="modelo_id">
  <option value="" style="display: block">Model</option>
  @foreach($models as $model)
    <option value="{{ $model->id }}" data-parent="{{ $model->maker_id }}"
      @selected($attributes->get('value') == $model->id)>
      {{ $model->name }}
    </option>
  @endforeach
</select>

<p class="error-message text-red-500">
{{ $errors->first('modelo_id') }}
</p>