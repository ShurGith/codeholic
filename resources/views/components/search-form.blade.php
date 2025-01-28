<!-- Find a car form -->
<section class="find-a-car mb-4">
  <div class="container">
    <form
      action="{{ route('car.search') }}"
      method="GET"
      class="find-a-car-form card flex p-medium"
    >
      <div class="flex flex-col w-full">
        <div class="grid grid-cols-7 gap-2 items-center">
          <div>
            <x-select-maker/>
          </div>
          <div>
            <x-select-model/>
          </div>
          <div>
            <x-select-state/>
          </div>
          <div>
            <x-select-city/>
          </div>
          <div>
            <x-select-car-type/>
          </div>
          <div>
            <x-select-fuel-type/>
          </div>
          <button type="button" class="btn btn-find-a-car-reset">
            Reset
          </button>
        </div>
        <div class="grid grid-cols-6 gap-2  items-center">
          <div>
            <input type="number" placeholder="Year From" name="year_from"/>
          </div>
          <div>
            <input type="number" placeholder="Year To" name="year_to"/>
          </div>
          <div>
            <input type="number" placeholder="Price From" name="price_from"/>
          </div>
          <div>
            <input type="number" placeholder="Price To" name="price_to"/>
          </div>
          <div>
            <x-select-mileage/>
          </div>
          <button class="btn btn-primary ">
            Search
          </button>
        </div>
      </div>
    </form>
  </div>
</section>
<!--/ Find a car form -->