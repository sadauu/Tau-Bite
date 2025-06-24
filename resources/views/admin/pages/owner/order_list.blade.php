@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		
		
		<h2>Order List</h2>
         
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Orders Grouped by Address</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($ordersByAddress as $group)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fa fa-map-marker text-primary me-2"></i>
                                        {{ $group->address ?? 'No Address' }}
                                    </span>
                                    <span class="badge bg-primary rounded-pill">{{ $group->total_orders }} orders</span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No data available.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Orders Grouped by Campus</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($ordersByCampus as $group)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fa fa-university text-success me-2"></i>
                                        {{ $group->campus ?? 'No Campus' }}
                                    </span>
                                    <span class="badge bg-success rounded-pill">{{ $group->total_orders }} orders</span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No data available.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</div>
	@if(Session::has('flash_message'))
				    <div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
				        {{ Session::get('flash_message') }}
				    </div>
	@endif
     
<div class="panel panel-default panel-shadow">
    <div class="panel-body">
         
        <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Date</th>
                <th>User Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Menu Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Status</th>                           
                <th class="text-center width-100">Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($order_list as $i => $order)
            <tr>
                <td>{{ date('m-d-Y',$order->created_date)}}</td>
                <td>{{ \App\Models\User::getUserFullname($order->user_id) }}</td>
                <td>{{ \App\Models\User::getUserInfo($order->user_id)->mobile }}</td>
                <td>{{ \App\Models\User::getUserInfo($order->user_id)->email }}</td>
                <td>{{ \App\Models\User::getUserInfo($order->user_id)->address }}</td>
                <td>{{ $order->item_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{getcong('currency_symbol')}}{{ $order->item_price }}</td>
                <td>{{getcong('currency_symbol')}}{{ $order->quantity*$order->item_price }}</td>
                <td>{{ $order->status }}</td>
                <td class="text-center">
                <div class="btn-group">
                                <button type="button" class="btn btn-default-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                    <li><a href="{{ url('admin/orderlist/'.$order->id.'/Pending') }}"><i class="md md-lock"></i> Pending</a></li>
                                    <li><a href="{{ url('admin/orderlist/'.$order->id.'/Processing') }}"><i class="md md-loop"></i> Processing</a></li>
                                    <li><a href="{{ url('admin/orderlist/'.$order->id.'/Completed') }}"><i class="md md-done"></i> Completed</a></li>
                                    <li><a href="{{ url('admin/orderlist/'.$order->id.'/Cancel') }}"><i class="md md-cancel"></i> Cancel</a></li>
                                    <li><a href="{{ url('admin/orderlist/'.$order->id) }}"><i class="md md-delete"></i> Delete</a></li>
                                </ul>
                            </div> 
                
            </td>
                
                 
            </tr>
           @endforeach
             
            </tbody>
        </table>
         
    </div>
    <div class="clearfix"></div>
</div>

</div>

@endsection