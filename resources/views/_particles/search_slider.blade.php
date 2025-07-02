@php

$total_restaurant = \App\Models\Restaurants::getTotalRestaurants();
$total_people_served = \App\Models\Restaurants::getTotalPeopleServed();
$total_registered_users =     \App\Models\User::getTotalUsers();
@endphp

<div id="banner">
  <section>
    <div id="subheader">
      <div id="sub_content" class="animated zoomIn">
        <h1>Place Your Order And Get It Delivered Now!</h1>
        <div class="container-4">
          <form action="{{ url('restaurants/search') }}" method="POST" id="search-form" class="my-4">
            @csrf
            <div class="position-relative">
              <input 
                type="search" 
                class="form-control " 
                placeholder="Search cafeteria name or address..." 
                name="search_keyword" 
                id="search_keyword" 
                required
              >
              <button type="submit" 
                class="btn position-absolute top-50 end-0 translate-middle-y me-3 p-0 border-0 bg-transparent"
                id="search-btn"
              >
                <i class="fa fa-search text-white fs-5"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="hidden-xs" id="count">
      <ul>
        <li><span class="number">{{$total_restaurant}}</span> Cafeteria</li>
        <li><span class="number">{{$total_people_served}}</span> People Served</li>
        <li><span class="number">{{$total_registered_users}}</span> Registered Users</li>
      </ul>
    </div>
  </section>
  <div class="flex-banner">
    <ul class="slides">
      <li><img src="{{ URL::asset('upload/'.getcong('home_slide_image1'))}}" alt=""></li>
      <li><img src="{{ URL::asset('upload/'.getcong('home_slide_image2'))}}" alt=""></li>
      <li><img src="{{ URL::asset('upload/'.getcong('home_slide_image3'))}}" alt=""></li>
        
    </ul>
  </div>
</div>