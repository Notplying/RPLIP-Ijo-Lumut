<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">

        .title_deg{
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            padding: 40px;
        }

        .table_deg{
            border: 2px solid green;
            margin: auto;
            width: 80%;
            text-align: center;
        }

        .img_size{
            margin: auto;
            width: 150px;
            height: 150px;
        }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

            <h1 class="title_deg">All Orders</h1>

            <div style="padding-left: 40%; padding-bottom: 30px;">
              <form action="{{url('search')}}" method="get">
                @csrf

                <input style="color: black" type="text" name="search" placeholder="Search for something">

                <input type="submit" value="Search" class="btn btn-outline-info">

              </form>
            </div>

            <table class="table_deg">
                <tr>
                    <th style="padding: 10px">Order ID</th>
                    <th style="padding: 10px">Name</th>
                    <th style="padding: 10px">Email</th>
                    <th style="padding: 10px">Address</th>
                    <th style="padding: 10px">Phone</th>
                    <th style="padding: 10px">Product</th>
                    <th style="padding: 10px">Quantity</th>
                    <th style="padding: 10px">Price</th>
                    <th style="padding: 10px">Payment Status</th>
                    <th style="padding: 10px">Delivery Status</th>
                    <th style="padding: 10px">Image</th>
                    <th style="padding: 10px">Action</th>
                </tr>

                @foreach($order as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td><img class="img_size" src="/product_image/{{$order->image}}"></td>
                    @if($order->delivery_status == 'processing')
                    <td><a class="btn btn-danger" onclick="return confirm('Mark this order as delivered?')" href="{{url('/delivered', $order->id)}}">Delivered</a></td>
                    @elseif($order->delivery_status == 'delivered')
                    <td><a class="btn btn-success" href="">Complete</a></td>
                    @else
                    <td><a class="btn btn-info" href="">Cancelled</a></td>
                    @endif
                </tr>
                @endforeach
            </table>
</div>
</div>
      </div>
      <!-- page-body-wrapper ends -->
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>