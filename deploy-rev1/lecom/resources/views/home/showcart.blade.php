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
            text-align: center;
            padding: 30px;
        }S

        table, th, td{
            border: 1px solid black;

        }

        .th_deg{
            font-size: 30px;
            padding: 5px;
            background-color: green;
        }

        .img_design{
            width: 200px;
            height: 200px;
        }

        .total_deg{
            font-size: 30px;
            text-align: center;
            padding-top: 40px;
        }

      </style>
   </head>
   <body>
   <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
        @if(session()->has('message'))
        
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
        
        @endif
      <div class="center">
        <table>
            <tr>
                <th class="th_deg">Product</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Action</th>
            </tr>
            <?php $totalprice=0; ?>
            @foreach($cart as $c)
            <tr>
                <td>{{$c->product_title}}</td>
                <td>{{$c->quantity}}</td>
                <td>Rp.{{$c->price}}</td>
                <td><img class="img_design" src="/product_image/{{$c->image}}"></td>
                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to remove this product?')"href="{{url('remove_cart', $c->id)}}">Remove</td>
            </tr>
            <?php $totalprice=$totalprice + $c->price; ?>
            @endforeach

            </table>
            <div>
                <h1 class="total_deg">Total Price: Rp.{{$totalprice}}</h1>
            </div>

            <div>
                <h1 style="font-size: 25px; padding: 15px">Proceed to Order</h1>

                <a href="{{url('cash_order')}}" class="btn btn-success">Cash On Delivery</a>
                <!-- <a href="" class="btn btn-success">Pay Using Card</a> -->
            </div>

            </div>

      <div class="cpy_">
         <p class="mx-auto">© 2023 All Rights Reserved By <a href="https://2233322.xyz/">Ijo Lumut</a><br>
         
         </p>
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