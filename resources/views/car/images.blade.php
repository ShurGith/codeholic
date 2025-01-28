<x-app-layout title="🚖🖼️ {{ $car->getTitle() }}">
  <main>
    <div>
      <div class="container">
        <h1 class="text-xl font-bold text-gray-500 py-6">
          Manage Images for {{ $car->getTitle() }}
        </h1>
        <div class="car-images-wrapper ">
          <form action="{{ route('car.updateImages', $car) }}"
                method="POST" class="card p-medium form-update-images">
            @csrf
            @method('PUT')
            <div class="table-responsive place-items-center max-w-content">
              <table class="table max-w-screen-sm max-w-32 ">
                <thead>
                <tr class="border-b text-left">
                  <th>❌</th>
                  <th>Image</th>
                  <th class="max-w-min w-16 ">Position</th>
                </tr>
                </thead>
                <tbody>
                @forelse($images as $image)
                  @php
                    if (!str_starts_with($image->image_path, 'http')) {
                          $image->image_path = Storage::url($image->image_path);
                    }
                  @endphp
                  <tr class="border-b h-20">
                    <td>
                      <input type="checkbox" name="delete_images[]" id="delete_image_{{ $image->id }}"
                             value="{{ $image->id }}">
                    </td>
                    <td>
                      <img src="{{ $image->image_path }}" alt="" class="my-cars-img-thumbnail"/>
                    </td>
                    <td>
                      <input type="number" name="positions[{{ $image->id }}]"
                             value="{{ old('positions.'.$image->id, $image->position) }}">
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center p-large"> There are no images</td>
                  </tr>
                @endforelse
                </tbody>
              </table>
            </div>
            <div class="flex w-full justify-center pt-6 gap-4 ">
              <button class="btn btn-primary">Update Images</button>
              <a class="btn btn-secondary text-white bg-gray-700 hover:bg-gray-500"
                 href="{{ route('car.index') }}">Volver</a>
            </div>
          </form>
          <form action="{{ route('car.addImages', $car) }}"
                enctype="multipart/form-data"
                method="POST"
                class="card form-images p-medium mb-large">
            @csrf
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
            
            <div class="p-medium">
              <div class="flex justify-end">
                <button class="btn btn-primary">Add Images</button>
              </div>
            </div>
          </form>
        </div>
      
      </div>
    </div>
  </main>
</x-app-layout>
