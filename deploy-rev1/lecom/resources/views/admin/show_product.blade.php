<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .center{
            margin: auto;
            width: 60%;
            border: 2px solid green;
            text-align: center;
            margin-top: 40px;
        }

        .font_size{
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            padding-top: 40px;
        }
        
        .img_size{
            width: 150px;
            height: 150px;
        }

        .th_color{
            background-color: #4CAF50;
            color: white;
        }

        .th_deg{
            padding: 30px;
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

              @if(session()->has('message'))

                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session()->get('message') }}
                </div>

              @endif

            <h2 class="font_size">All Products</h2>

            <table class="center">
                <tr class="th_color">
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Description</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Category</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Discount Price</th>
                    <th class="th_deg">Product Image</th>
                    <th class="th_deg">Delete</th>
                    <th class="th_deg">Edit</th>
                </tr>
                @foreach($product as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->discount_price}}</td>
                    <td><img class="img_size" src="/product_image/{{$product->image}}"></td>
                    <td><a class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')" href="{{url('delete_product', $product->id)}}">Delete</a></td>
                    <td><a class="btn btn-success" href="{{url('edit_product', $product->id)}}">Edit</a></td>
                </tr>

                @endforeach
            </table>

            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>