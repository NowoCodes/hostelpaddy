{{-- Saved Hostel Details --}}

<div class="row mb-3">
  @foreach ($favoriteSharedHostels as $hostel)
    <div class="col">
      <div class="card">
        <div class="row no-gutters">
          <img class="card-pill-img card-img-top img-fluid" src="{{ asset('main/img/hostel.png') }}" alt="">
          <div class="card-img-overlay">
            <form action="{{ route('student.sharedUnfave', [$hostel]) }}" method="POST" class="inline-flex clearfix float-left">
              @csrf
              @method('DELETE')
              <button class="btn">
                <img src="{{ asset('main/img/loved.png') }}" alt="Card image cap">
              </button>
            </form>
          </div>
          <div class="col">
            <span class="card-body fs-6">
              <p class="card-text">1 Room Duplex Hostel</p>
              <p>Host: Ademola Tunji</p>
              <p>Bedroom, wardrobe, bathroom...</p>
              <p>Surlere Lagos.</p>
              <p class="">#5,000/monthly</p>
            </span>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
