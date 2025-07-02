@extends("app")
@section("content")
 
@include("_particles.search_slider") 

<!-- Content ================================================== --> 

<div id="blog_item">
  <div class="container">
  <h1 class="mb5 zui-highlight">Choose one to start placing your order</h1>
   
   <nav id="list_shortcuts">
    <ul>
    @foreach($types as $type)
    <li> <a title="Chinese" href="{{URL::to('restaurants/type/'.$type->id)}}" data-cuisine="chinese"> <img alt="{{$type->type}}" src="{{ URL::asset('upload/type/'.$type->type_image.'.jpg') }}"> <span>{{$type->type}}</span> </a> </li>
    @endforeach
     

    </ul>
   </nav>
  </div>
  </div>

  <div class="white_bg">
   
    <div class="container m-5">
      <div class="main_title text-center mb-4">
          <h2 class="nomargin_top">Choose from Most Popular</h2>
      </div>
      <div class="row g-4">
          @foreach($popularItems as $i => $restaurant)
              <div class="col-12 col-md-6 p-4">
                  <a class="strip_list d-flex align-items-center p-3  rounded shadow-sm text-decoration-none bg-white h-100" 
                     href="{{ URL::to('restaurants/menu/'.$restaurant->restaurant_slug) }}">
                      <div class="thumb_strip  flex-shrink-0 m-5">
                          <img src="{{ URL::asset('upload/restaurants/'.$restaurant->restaurant_logo.'-s.jpg') }}" 
                               alt="{{ $restaurant->restaurant_name }}" 
                               class="rounded-circle" 
                               style="width: 70px; height: 70px; object-fit: cover;">
                      </div>
                      <div class="desc flex-grow-1">
                          <h3 class="mb-1 text-dark">{{ $restaurant->restaurant_name }}</h3>
                          <div class="type small text-muted mb-1">{{ $restaurant->type }}</div>
                          <div class="location small text-secondary mb-2">{{ $restaurant->restaurant_address }}</div>
                          <div class="rating">
                              @for($x = 0; $x < 5; $x++)
                              @if($x < $restaurant->review_avg)
                              <i class="fa fa-star text-warning"></i>
                          @else
                              <i class="fa fa-star-o text-warning"></i>
                          @endif
                      @endfor
                  </div>
              </div>
          </a>
      </div>
  @endforeach
</div>
</div>
  </div>
 
<!-- End section --> 
<!-- End Content =============================================== --> 

@endsection
