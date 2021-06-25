<div class="container mt-5">
  <h1 class="display-4">Listed Hostels</h1>
  <br>
  <h5>Find a hostel near you</h5>

  @include('partials.student.search-bar')

  <div class="row">
    @foreach ($hostels as $hostel)
      <div class="col-6 col-md-4 col-lg-3 mb-3">
        <div class="card">
          <img class="card-img-top img-fluid px-2 pt-2" src="{{ asset('main/img/hostel2.png') }}" alt="Card image">
          <div class="card-img-overlay">
            <form action="{{ route('student.fave', [$hostel]) }}" method="POST" class="inline-flex float-right">
              @csrf
              @method('PUT')
              <button>
                <i class="fa-2x fas fa-heart {{ auth('student')->user()->hasFavorited($hostel) ? 'text-danger' : 'text-white' }}"></i>
              </button>
            </form>
          </div>

          <div class="px-3 pb-3" style="position: relative;">
            <sub class="mb-1">{{ $hostel->city }}, {{ $hostel->state }}</sub>
            <br>
            <span class="card-title font-weight-bold">{{ $hostel->hostel_name }}</span>
            <br>
            <span class="card-text">{{ $hostel->description }}</span>
            <br>
            <span class="card-text font-weight-bold">N{{ $hostel->amount }}
            <sub>{{ $hostel->period }}</sub></span>
            <a href="{{ route('info', [$hostel]) }}" class="stretched-link"></a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  {{ $hostels->links() }}

</div>
