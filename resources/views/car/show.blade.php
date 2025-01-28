@php use App\Models\Car; @endphp
<x-app-layout title="View Car">
  <main>
    <div class="container">
      <h1 class="car-details-page-title text-2xl">
        {{$car->maker->name.' '. $car->modelo->name .' - '.  $car->year }} </h1>
      <div class="car-details-region">
        {{$car->city->name}} - {{ $difDays}} days ago
      </div>
      <div class="car-details-content">
        <div class="car-images-and-description">
          <div class="car-images-carousel">
            <div class="car-image-wrapper">
              <img src="{{  Car::getImgSrc($car) }}" alt="" class="car-active-image"
                   id="activeImage"/>
            </div>
            <div class="car-image-thumbnails">
              @if($car->images->count()>1)
                @foreach($car->images as $image)
                  <img src="{{  $image->getUrl()}}" alt=""/>
                @endforeach
              @endif
            </div>
            @if($car->images->count()>1)
              <button class="carousel-button prev-button" id="prevButton">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 64px">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                </svg>
              </button>
              <button class="carousel-button next-button" id="nextButton">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" style="width: 64px">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                </svg>
              </button>
            @endif
          </div>
          <div class="card car-detailed-description">
            <h2 class="car-details-title">Detailed Description</h2>
            {{ $car->description }}
          </div>
          <div class="card car-detailed-description">
            <h2 class="car-details-title">Car Specifications</h2>
            <ul class="car-specifications grid grid-cols-3 gap-2">
              @foreach($options as $option)
                <li>
                  <p class="{{ $car->features?->$option ? 'text-green-700' : 'text-red-300'}} ">
                    {{ $car->features?->$option ? '✅' : '🛑' }} {{ ucwords(str_replace('_',' ', $option)) }}
                  </p>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="car-details card">
          <div class="flex items-center justify-between">
            <p class="car-details-price">$ {{ number_format($car->price,0,"'",'.' )}}</p>
            <button class="btn-heart">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                style="width: 20px"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                />
              </svg>
            </button>
          </div>
          <div class="car-details-table mt-2 border-y-2 border-gray-200">
            <div class="flex gap-2 pb-4 pt-4">
              <p>Maker: </p>
              <p>{{ $car->maker->name }}</p>
            </div>
            <div class="flex gap-2 pb-4">
              <p>Model: </p>
              <p>{{ $car->modelo->name }}</p>
            </div>
            <div class="flex gap-2 pb-4">
              <p>Year: </p>
              <p>{{ $car->year }}</p>
            </div>
            <div class="flex gap-2 pb-4">
              <p>Car Type: </p>
              <p>{{ $car->carType->name }}</p>
            </div>
            <div class="flex gap-2 pb-4">
              <p>Fuel Type: </p>
              <p>{{ $car->fuelType->name }}</p>
            </div>
            <div class="flex gap-2 pb-4">
              <p>Milage: </p>
              <p>{{ $car->mileage }}</p>
            </div>
            <div class="flex gap-2 pb-4">
              <p>VIN: </p>
              <p>{{ $car->vin }}</p>
            </div>
          </div>
          <div class="flex gap-1 my-medium">
            <img src="/img/avatar.png" alt="" class="car-details-owner-image"/>
            <div>
              <h3 class="car-details-owner">{{ $car->user->name }}</h3>
              <div class="flex text-muted gap-2">{{ $totals .' car'. ($totals > 1 ? 's' : '' )}}
                <a href="{{ route('car.index') }}">see all</a></div>
            </div>
          
          </div>
          <a onclick="miFuncion()"
             class="car-details-phone">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              style="width: 16px"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"
              />
            </svg>
            <span id="telmask">+{{ Str::mask($car->phone, '*', -6) }}</span>
            <span class="car-details-phone-view">view full number</span>
          </a>
        </div>
      </div>
    </div>
  </main>
</x-app-layout>

<script>
const telM = document.getElementById('telmask')

function miFuncion() {
telM.innerText = "+{{ $car->phone }}"
}
</script>