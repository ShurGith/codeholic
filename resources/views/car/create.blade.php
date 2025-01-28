<x-app-layout title="🚘 Car new Create">
  
  <main>
    <div class="container-small">
      <h1 class="font-bold text-2xl text-zinc-500">Add new car</h1>
      <form action="{{route('car.store')}}" method="POST" enctype="multipart/form-data" class="card add-new-car-form">
        @csrf
        <div class="form-content">
          <div class="form-details">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">
                    Maker</p>
                  <x-select-maker :value="old('maker_id')"/>
                  <p class="error-message text-red-500">
                    {{ $errors->first('maker_id') }}
                  </p>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">Model</p>
                  <x-select-model :value="old('modelo_id')"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">Year</p>
                  <x-select-year :value="old('year')"/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <p class="text-xm font-bold mb-1">Car Type</p>
              <div class="grid grid-cols-4 gap-2 mt-2">
                <x-select-car-type :value="old('car_type_id')" :isRadio=true/>
              </div>
              <p class="error-message text-red-500">
                {{ $errors->first('car_type_id') }}
              </p>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">Price</p>
                  <input name="price" type="number" placeholder="Price" value="{{old('price')}}"/>
                  <p class="error-message text-red-500">
                    {{ $errors->first('price') }}
                  </p>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">Vin Code</p>
                  <input name="vin" placeholder="Vin Code" value="{{old('vin')}}"/>
                  <p class="error-message text-red-500">
                    {{ $errors->first('vin') }}
                  </p>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">Mileage (ml)</p>
                  <input name="mileage" placeholder="Mileage" value="{{old('mileage')}}"/>
                  <p class="error-message text-red-500">
                    {{ $errors->first('mileage') }}
                  </p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <p class="text-xm font-bold mb-1">Fuel Type</p>
              <div class="grid grid-cols-5 gap-2 m-2">
                <x-select-fuel-type :isRadio=true :value="old('fuel_type_id')"/>
              </div>
              <p class="error-message text-red-500">
                {{ $errors->first('fuel_type_id') }}
              </p>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">State/Region</p>
                  <x-select-state :value="old('state_id')"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">City</p>
                  <x-select-city :value="old('city_id')"/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">Address</p>
                  <input name="address" placeholder="Address" value="{{old('address')}}"/>
                  <p class="error-message text-red-500">
                    {{ $errors->first('address') }}
                  </p>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <p class="text-xm font-bold mb-1">Phone</p>
                  <input name="phone" placeholder="Phone" value="{{old('phone')}}"/>
                  <p class="error-message text-red-500">
                    {{ $errors->first('phone') }}
                  </p>
                </div>
              </div>
            </div>
            <div>
              <p class="text-xm font-bold mb-4">Equipment</p>
              <div class="grid grid-cols-3 mb-4 gap-2">
                <x-select-features :options="$options"/>
              </div>
            </div>
            <div class=" form-group">
              <p class="text-xm font-bold mb-1">Detailed Description</p>
              <textarea name="description" rows="10">{{ old('description', $car->description ?? '') }}</textarea>
              <p class="error-message text-red-500">
                {{ $errors->first('description') }}
              </p>
            </div>
            <div class="form-group @error('published_at') has-error @enderror">
              <label>Publish Date</label>
              <input type="date" name="published_at"
                     value="{{ old('published_at') }}">
              <p class="error-message">
                {{ $errors->first('published_at') }}
              </p>
            </div>
          </div>
          <div class="form-images">
            <div class="form-image-upload">
              <div class="upload-placeholder">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" style="width: 48px">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
              </div>
              <input id="carFormImageUpload" type="file" name="images[]" multiple/>
            </div>
            <div id="imagePreviews" class="car-form-images"></div>
          </div>
        </div>
        <div class="p-medium" style="width: 100%">
          <div class="flex justify-end gap-1">
            <button type="button" class="btn btn-default">Reset</button>
            <button class="btn btn-primary º1º ">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </main>

</x-app-layout>