<style>
    .header-container img{
        width: 100px;
        height: 100px;
    }
    
@media (max-width: 768px) {
    .header-container img{
        width: 80px;
        height: 80px;
    }
    .header-container h2{
        font-size: 20px;
    }
  }
</style>
<div class="container col-md-10 text-center mb-5 header-container">
    <div class="row ">
        <div class="col-12">
            @if(isset(auth()->user()->business->logo))
                <img src="{{ asset('storage/' . auth()->user()->business->logo) }}" class="rounded-circle" alt="employee-image">
            @else
                <i class="far fa-home" style="font-size: 80px"></i>
            @endif
            <h2 class="fw-bold mt-1 text-white my-1">{{auth()->user()->business->name}}</h2>
        </div>
        {{-- <div class="col-md-2">
            @if(isset(auth()->user()->business->logo))
                <img src="{{ asset('storage/' . auth()->user()->business->logo) }}" class="rounded-circle" alt="employee-image">
            @else
                <i class="far fa-home" style="font-size: 80px"></i>
            @endif
        </div>
        <div class="col-md-10">
            <h2 class="fw-bold text-white my-1">{{auth()->user()->business->name}}</h2>
            <p class="mb-0 text-white">{{auth()->user()->business->motto}}</p>
            <p class="mb-0 text-white">Address : {{auth()->user()->business->address}}</p>
            <p class="mb-1 text-white">Contact : {{auth()->user()->business->phone1 .", " .auth()->user()->business->phone2}}</p>
        </div> --}}
    </div>
    <!-- <h5 class="text-white">Admin Section</h5> -->
</div>