<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .div_center{
            text-align: center;
            padding-top: 40px;
        }

        .font_size{
            font-size: 40px;
            font-weight: bold;
            padding-bottom: 40px;
        }

        .text_color{
            color: black;
            padding-bottom: 40px;
        }

        label{
            display: inline-block;
            width: 200px;
        }

        .div_design{
            padding-bottom: 15px;
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
                <div class="div_center">
                    <h1 class="font_size">Add Product</h1>

                    <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="div_design">
                    <label>Product Title:</label>
                    <input class="text_color" type="text" name="title" placeholder="Enter Product Title" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Description:</label>
                    <input class="text_color" type="text" name="description" placeholder="Enter Product Description" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Price:</label>
                    <input class="text_color" type="number" name="price" placeholder="Enter Product Price" required="">
                    </div>
                    
                    <div class="div_design">
                    <label>Discount Price:</label>
                    <input class="text_color" type="number" name="dis_price" placeholder="Enter Discount Price (if any)">
                    </div>

                    <div class="div_design">
                    <label>Product Quantity:</label>
                    <input class="text_color" type="number" min="0" name="quantity" placeholder="Enter Product Quantity" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Category:</label>
                    <select class="text_color" name="category" required="">
                        <option value="" selected="">Select a Category</option>
                        @foreach($category as $cat)

                        <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>

                        @endforeach
                    </select>
                    </div>

                    <div class="div_design">
                    <label>Product Image:</label>
                    <input type="file" name="image" required="">
                    </div>

                    <div class="div_design">
                    <input type="submit" value="Add Product" class="btn btn-primary">
                    </div>

                </form>
                </div>
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