@php use Carbon\Carbon; @endphp
<x-app-layout title="📝Editing: {{ $car->makeR->name .':'. $car->modelo->name }}">
  
  <main>
    <div class="container-small">
      <h1 class="car-details-page-title text-2xl">Edit Car: {{ $car->getTitle() }}</h1>
      <form
        action="{{ route('car.update', $car) }}"
        method="POST"
        enctype="multipart/form-data"
        class="card add-new-car-form"
      >
        @csrf
        @method('PUT')
        <div class="form-content">
          <div class="form-details">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Maker</label>
                  <x-select-maker :value="old('maker_id', $car->maker_id)"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Model</label>
                  <x-select-model :value="old('model_id', $car->modelo_id)"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Year</label>
                  <x-select-year :value="old('year',$car->year)"/>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label>Car Type</label>
              <div class="grid grid-cols-4 gap-2 mt-2">
                <x-select-car-type :value="old('car_type_id', $car->car_type_id)" :isRadio="true"/>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Price</label>
                  <input name="price" type="number" name="price" placeholder="Price" value="{{  $car->price }}"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Vin Code</label>
                  <input type="text" name="vin" placeholder="VIN" value="{{  $car->vin }}"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Mileage (ml)</label>
                  <input type="number" name="mileage" placeholder="Mileage" value="{{  $car->mileage }}"/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Fuel Type</label>
              <div class="grid grid-cols-5 gap-2 m-2">
                <x-select-fuel-type :value="old('fuel_type_id', $car->fuel_type_id)" :isRadio=true/>
              </div>
              <p class="error-message text-red-500">
                {{ $errors->first('fuel_type_id') }}
              </p>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>State/Region</label>
                  <x-select-state :value="old('state_id', $car->city->state_id)"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>City</label>
                  <x-select-city :value="old('city_id', $car->city_id)"/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="address" placeholder="Address" value="{{  $car->address }}"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Phone</label>
                  <input name="phone" placeholder="Phone" value="{{  $car->phone }}"/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <p class="text-xm font-bold mb-4">Equipement</p>
              <div class="grid grid-cols-3 mb-6 gap-y-4">
                <x-select-features :car="$car"/>
              </div>
            </div>
            <div class="form-group">
              <label>Detailed Description</label>
              <textarea rows="10" name="description">{{ old('description', $car->description) }}</textarea>
            </div>
            <div class="form-group @error('published_at') has-error @enderror">
              <label>Publish Date</label>
              <p class="error-message">
                <input type="date" name="published_at"
                       value="{{ old('published_at', (new Carbon($car->published_at))->format('Y-m-d')) }}">
                {{ $errors->first('published_at') }}
              </p>
            </div>
          </div>
          <div class="form-images">
            <div class="car-form-images">
              @foreach($imagenes as $image)
                <a href="{{ $image->getUrl() }}" target="_blank" class="car-form-image-preview">
                  <img
                    @class(['min-w-48 min-h-48' => $image->position === 1]) src="{{ $image->getUrl() }}" alt="">
                </a>
              @endforeach
            </div>
            <p class="pt-12">
              Manage your images <a href="{{ route('car.images', $car->id) }}">From here</a>
            </p>
          </div>
        </div>
        <div class="p-medium" style="width: 100%">
          <div class="flex justify-end gap-1">
            <button type="button" class="btn btn-default">Reset</button>
            <button class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </main>

</x-app-layout>