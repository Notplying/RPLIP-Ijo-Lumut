<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="/images/favicon.png" type="">
      <title>Ijo Lumut</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <style type="text/css">
        .center{
            margin: auto;
            width: 70%;
            padding: 10px;
            text-align: center;
        }

        table, th, td{
            border: 1px solid green;
        }

        .th_deg{
            background-color: green;
            color: white;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .img_size{
            margin: auto;
            width: 150px;
            height: 150px;
        }

      </style>
   </head>
   <body>

         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
        <div class="center">

            <table>
                <tr>
                    <th class="th_deg">Product Name</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Payment Status</th>
                    <th class="th_deg">Delivery Status</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Action</th>
                </tr>
                @foreach ($order as $o)
                <tr>
                    <td>{{$o->product}}</td>
                    <td>{{$o->quantity}}</td>
                    <td>{{$o->price}}</td>
                    <td>{{$o->payment_status}}</td>
                    <td>{{$o->delivery_status}}</td>
                    <td><img class="img_size" src="/product_image/{{$o->image}}"></td>
                    <td>
                        @if($o->delivery_status=='processing')
                            <a onclick="return confirm('Are you sure you want to cancel this order?')" class="btn btn-danger" href="{{url('cancel_order', $o->id)}}">Cancel Order</a>
                        @elseif($o->delivery_status=='delivered')
                            <a class="btn btn-success">Order Delivered</a>
                        @else
                            <a class="btn btn-info">Order Cancelled</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>

        </div>


      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>