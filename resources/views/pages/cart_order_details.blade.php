@extends("app")

@section('head_title', 'Order Details' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 
<div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
    <div class="overlay">
      <div class="container">
        <h1>Your Order Details</h1>
      </div>
    </div>
  </div>

 <div class="restaurant_list_detail">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-7 col-xs-12">
          <div class="box_style_2" id="order_process">
          <h2 class="inner">Your Order Details</h2>
          
          <form action="{{ url('order_details') }}" method="POST" class="" id="order_details">
            @csrf
            @method('POST')
            <div class="message">
              @if ($errors->any())
              <ul class="alert alert-danger errors">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          @endif
          
                    @if (count($errors) > 0)
                          <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                          </div>
                    @endif
            </div>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">             
                {{ Session::get('flash_message') }}
            </div>
        @endif

          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}" placeholder="First name">
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control" id="last_name" value="{{$user->last_name}}" name="last_name" placeholder="Last name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label>Telephone/mobile</label>
                <input type="text" id="mobile" name="mobile" value="{{$user->mobile}}" class="form-control" placeholder="Telephone/mobile">
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Your email">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="campus">Campus/Hostel</label>
            <select id="campus" name="campus" class="form-control">
                <option value="">-- Select Campus/Hostel --</option>
                <option value="East Campus" {{ old('campus', $user->campus) == 'East Campus' ? 'selected' : '' }}>East Campus</option>
                <option value="West Hostel" {{ old('campus', $user->campus) == 'West Hostel' ? 'selected' : '' }}>West Hostel</option>
                <option value="Oko Community" {{ old('oko', $user->campus) == 'Oko Community' ? 'selected' : '' }}>Oko Community</option>
            </select>
            @if ($errors->has('campus'))
                <small class="text-danger">{{ $errors->first('campus') }}</small>
            @endif
        </div>
        
        <hr>
        
        <div class="form-group">
            <label for="address_option">Delivery Point</label>
            <select class="form-control" name="address" id="address_option">
                <option value="">-- Select Address --</option>
                {{-- Options will be populated by JS --}}
            </select>
            @if ($errors->has('address'))
                <small class="text-danger">{{ $errors->first('address') }}</small>
            @endif
        </div>
        
             
      
        </div>
        <!-- End box_style_1 --> 
        </div>
    <div class="col-md-3 col-sm-5 col-xs-12 side-bar">   
    <div id="cart_box">
          <h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
          
          <table class="table table_summary">
            <tbody>
              @foreach(\App\Models\Cart::where('user_id',Auth::id())->orderBy('id')->get() as $n=>$cart_item)
              <tr>
                <td><a href="{{URL::to('delete_item/'.$cart_item->id)}}" class="remove_item"><i class="fa fa-minus-circle"></i></a> <strong>{{$cart_item->quantity}}x</strong> {{$cart_item->item_name}} </td>
                <td><strong class="pull-right">{{getcong('currency_symbol')}}{{$cart_item->item_price}}</strong></td>
              </tr>
              @endforeach
               
            </tbody>
          </table>
           
          <!-- Edn options 2 -->
          
          <hr>
          @if(DB::table('cart')->where('user_id', Auth::id())->sum('item_price')>0)
          <table class="table table_summary">
            <tbody>
              
              <tr>
                <td class="total"> TOTAL <span class="pull-right">{{getcong('currency_symbol')}}{{$price = DB::table('cart')
                ->where('user_id', Auth::id())
                ->sum('item_price')}}</span></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <h3>Delivery Now!</h3>
          <hr>
          <form method="GET" action="{{ url('/pay') }}">
    <button type="submit" class="btn_full">Confirm Your Order</button>
</form>


        </div>

          </form> 
          @else
            <a class="btn_full" href="#">Empty Cart</a> </div>
          @endif
        <!-- End cart_box -->                                                                               
    <div id="help" class="box_style_2"> 
      <i class="fa fa-life-bouy"></i>
        <h4>{{getcong_widgets('need_help_title')}}</h4>
        <a href="tel://{{getcong_widgets('need_help_phone')}}" class="phone">{{getcong_widgets('need_help_phone')}}</a> <small>{{getcong_widgets('need_help_time')}}</small> 
      </div>
        </div>
                
      </div>
    </div>
  </div>
 

  
  @endsection
  
  @push('scripts')
  <script>
      const addressOptions = {
          "East Campus": [
              "Capeferia",
              "Rev James Abolarin Hostel Male",
              "Rev James Abolarin Hostel Females",
              "Faculty ICT",
              "Faculty Bookstore",
              "Clinic",
              "Gate",
              "Staff Quarter",
              "Works"
          ],
          "West Hostel": [
              "Capeteria",
              "Faculty of Management",
              "Pool",
              "Field",
              "Chartet",
              "Law Faculty Gate",
              "Taico Gate"
          ],
  
          "Oko Community": [
            "OMC"
          ]
      };
  
      function populateAddressOptions() {
          const campus = document.getElementById('campus').value;
          const addressSelect = document.getElementById('address_option');
          addressSelect.innerHTML = '<option value="">-- Select Address --</option>';
          if (addressOptions[campus]) {
              addressOptions[campus].forEach(function(addr) {
                  addressSelect.innerHTML += `<option value="${addr}">${addr}</option>`;
              });
          }
      }
  
      document.getElementById('campus').addEventListener('change', populateAddressOptions);
  
      // Optionally, populate on page load if campus is pre-selected
      document.addEventListener('DOMContentLoaded', function() {
          populateAddressOptions();
          // Optionally, set the selected address if editing
          @if(old('address', $user->address))
              document.getElementById('address_option').value = "{{ old('address', $user->address) }}";
          @endif
      });
  </script>
  @endpush


