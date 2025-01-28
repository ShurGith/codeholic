<x-app-layout>
  
  <main>
    <!-- New Cars -->
    <section>
      <div class="container">
        <h2 class="text-2xl text-bold">My Favourite Cars</h2>
        {{ $cars->onEachSide(1)->links('pagination') }}
        <div class="car-items-listing">
          @forelse($cars as $car)
            <x-car-item :car="$car" :isInWatchlist="true"/>
          @empty
            <div class="col-start-2 text-xl"> 🚘 No tienes ningún coche</div>
          @endforelse
        </div>
        
        {{ $cars->onEachSide(1)->links('pagination') }}
      </div>
    </section>
    <!--/ New Cars -->
  </main>

</x-app-layout>