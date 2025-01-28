@php use App\Models\Car; @endphp
@props([
   'bgcolor' => 'bg-red-600',
   'texto'  =>  'Pendiente',
])
<x-app-layout title="🚖 Mis Coches">
  <main>
    <div class="container">
      <h1 class="text-xl font-bold text-gray-500 py-6">Los coches de {{$user->name}} </h1>
      <div class="card p-medium">
        <div class="table-responsive">
          <table class="table">
            <thead>
            <tr class="bg-gray-200">
              <th class="text-center bg-gray-100 py-4">Image</th>
              <th class="text-center bg-gray-100 py-4">Title</th>
              <th class="text-center bg-gray-100 py-4">Date Creation</th>
              <th class="text-center bg-gray-100 py-4">Published</th>
              <th class="text-center bg-gray-100 py-4">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cars as $car)
              @php
                if($car->published_at !=='null' ){
                  $bgcolor = "bg-green-600";
                  $texto =  date('d-m-Y', $car->published_at);
                  }
              @endphp
              <tr class="border-b">
                <td class="py-2 place-content-center place-items-center">
                  <img
                    src="{{ Car::getImgSrc($car) }}" alt=""
                    class="my-cars-img-thumbnail"/>
                </td>
                <td class="text-center">{{ $car->getTitle() }} </td>
                <td class="text-center">{{ $car->getCreateDate() }}</td>
                <td class="place-content-center place-items-center">
                  <div
                    class="max-w-fit px-2 py-1 text-xs text-center rounded text-white {{ $bgcolor }}">{{ $texto }}</div>
                </td>
                <td class="place-content-center place-items-center">
                  <div class=" max-w-content flex justify-center">
                    <a href="{{route('car.show', $car->id)}}" class="btn btn-edit inline-flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                           style="width: 12px; margin-right: 5px">
                        <path
                          d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                        <circle cx="12" cy="12" r="3"/>
                      </svg>
                      see
                    </a>
                    <a href="{{ route('car.edit', $car->id) }}" class="btn btn-edit inline-flex items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                           stroke="currentColor"
                           style="width: 12px; margin-right: 5px">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                      </svg>
                      edit
                    </a>
                    <a href="{{route('car.images', $car->id)}}" class="btn btn-edit inline-flex items-center ">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                           stroke="currentColor" style="width: 12px; margin-right: 5px">
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                        />
                      </svg>
                      images
                    </a>
                    <form method="post" action="{{ route('car.destroy', $car->id) }}">
                      @csrf
                      @method('delete')
                      
                      <button onclick="return confirm('Are you sure you want to delete this car?')"
                              class="btn btn-delete inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" style="width: 12px; margin-right: 5px">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                        delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
        </div>
        @empty
          <div>
            You don't have any cars yet. <a href="{{ route('car.create') }}">Add new car</a>
          </div>
          @endforelse
          </tbody>
          </table>
    {{ $cars->onEachSide(1)->links('pagination') }}
  </main>
</x-app-layout>
