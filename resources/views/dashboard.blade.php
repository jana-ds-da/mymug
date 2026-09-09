@extends('layouts.app')

@section('title','dashboard')
@section('css')
   <link rel='stylesheet' href={{ asset('css/dashboard.css') }}>
@endsection  

@section('content')



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Owner Dashboard | My Mug</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>



    <main class="dashboard">



        <section class="welcome-section">

            <div>

                <h1>Welcome Back, Owner </h1>

                <p>
                    Here's an overview of your mug store performance today.
                </p>

            </div>

            <button class="logout-btn">

                Logout

            </button>

        </section>

                

        <section class="stats-section">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4> Total Orders </h4>
                    <h2 id="ordersCount">{{ $totalOrders }}</h2>
                    <span>Orders received</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4>Total Revenue</h4>
                    <h2 id="revenue">{{ number_format($totalRevenue, 2) }} EGP</h2>
                    <span>Store earnings</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4>Products Sold</h4>
                    <h2 id="productsCount">{{ $productsSold }}</h2>
                    <span>Total sold items</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4>Best Seller</h4>
                    <h2 id="bestSeller">{{$bestSeller?->product?->mug_name ?? '-'}}</h2>
                    <span>Most ordered mug</span>
                </div>
            </div>

        </div>

    </div>

</section>

          
<section class="product-management">

    <div class="card-header">
        <h2>Manage Products</h2>
        <span>Add, Edit & Delete Mugs</span>
    </div>
    <div id="messageBox" class="alert alert-success d-none"></div>
    <form
    id="productForm"
    class="product-form"
    action="{{ $editProduct
        ? route('products.update', $editProduct->id)
        : route('products.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    @if($editProduct)
        @method('PUT')
    @endif

    <input
        type="hidden"
        id="productId"
        value="{{ $editProduct->id ?? '' }}"
    >

    <div class="row">

        
        <div class="col-md-6 mb-3">
            <label>Mug Name</label>

            <input
                type="text"
                class="form-control"
                id="name"
                name="mug_name"
                value="{{ $editProduct->mug_name ?? '' }}"
                required
            >
        </div>


        
        <div class="col-md-6 mb-3">
            <label>Price</label>

            <input
                type="number"
                class="form-control"
                id="price"
                name="price"
                value="{{ $editProduct->price ?? '' }}"
                required
            >
        </div>


        
        <div class="col-md-6 mb-3">
            <label>Category</label>

            <select class="form-select" id="category" name="category_id" required>
                <option value="">Select Category</option>
               @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}" {{ ($editProduct->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                     {{ $cat->name }}
                  </option>
               @endforeach
            </select>
        </div>


        
        <div class="col-md-6 mb-3">

            <label>Image</label>

            <input
                type="file"
                id="image"
                accept="image/*"
                class="form-control"
                name="image"
                {{ $editProduct ? '' : 'required' }}
            >

            
            @if($editProduct && $editProduct->image_path)

                <div class="mt-2">

                    <p>Current Image:</p>

                    <img
                        src="{{ asset( $editProduct->image_path) }}"
                        width="180"
                        style="border-radius:12px;"
                        alt="{{ $editProduct->mug_name }}"
                    >

                </div>

            @endif

        </div>


        
        <div class="col-12 mb-3">

            <img
                id="imagePreview"
                src=""
                style="
                    display:none;
                    width:180px;
                    border-radius:12px;
                    border:2px solid #ddd;
                    padding:5px;
                "
            >

        </div>


        
        <div class="col-md-6 mb-3">

            <label>Description</label>

            <input
                type="text"
                class="form-control"
                id="description"
                name="description"
                value="{{ $editProduct->description ?? '' }}"
                required
            >

        </div>


        
        <div class="col-md-6 mb-3">

            <label>Capacity</label>

            <input
                type="text"
                class="form-control"
                id="capacity"
                name="capacity"
                value="{{ $editProduct->capacity ?? '' }}"
                required
            >

        </div>


        
        <div class="col-md-6 mb-3">

            <label>How it's made</label>

            <input
                type="text"
                class="form-control"
                id="howItsMade"
                name="how_its_made"
                value="{{ $editProduct->how_its_made ?? '' }}"
                required
            >

        </div>


        
        <div class="col-md-6 mb-3">

            <label>Microwave</label>

            <select
                class="form-select"
                id="microwave"
                name="microwave"
                required
            >

                <option value="">Choose</option>

                <option
                    value="1"
                    {{ isset($editProduct) && $editProduct->microwave == 1 ? 'selected' : '' }}
                >
                    Yes
                </option>

                <option
                    value="0"
                    {{ isset($editProduct) && $editProduct->microwave == 0 ? 'selected' : '' }}
                >
                    No
                </option>

            </select>

        </div>

    </div>


    

    <button
        type="submit"
        class="btn btn-dark"
        id="saveBtn"
    >
        {{ $editProduct ? 'Update Product' : 'Save Product' }}
    </button>


    @if($editProduct)

        <a
            href="{{ route('dashboard') }}"
            class="btn btn-secondary"
        >
            Cancel
        </a>

    @endif

</form>


<hr>



<table id='productsTable' class="table table-hover align-middle">

    <thead>

        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Actions</th>
            
        </tr>

    </thead>


    <tbody>

        
    </tbody>

</table>

</section>

               
        <section class="dashboard-content">

            

            <div class="chart-card">

                <div class="card-header">

                    <h2>Sales Overview</h2>

                    <span>This Week</span>

                </div>

                <canvas id="salesChart"></canvas>

            </div>


            <div class="orders-card">

                <div class="card-header">

                    <h2>Recent Orders</h2>

                </div>

                <table>

                    <thead>
                    @forelse($recentOrders as $item)
                         <tr>

                         <td>
                             #{{ $item->order->id }}
                          </td>

                          <td>
                              {{ $item->product->mug_name }}
                          </td>

                         <td>
                              {{ $item->quantity }}
                          </td>

                         <td>
                              {{ $item->price * $item->quantity}} EGP
                          </td>

                         </tr>

                    @empty     

                    </thead>

                    <tbody id="ordersTable">
                     <tr>
                         <td colspan="4" class="text-center">
                              No Orders Found.
                         </td>
                      </tr>
                        
                    @endforelse  
                 </tbody>

                </table>

            </div>

        </section>


        <section class="top-products">

            <div class="card-header">

                <h2>Top Selling Products</h2>

                <span>Most popular mugs</span>

            </div>

            <div class="top-products-grid" id="topProducts">

                @forelse ($topProducts as $item)

        <div class="top-product-card">

            <img
                src="{{ asset( $item->product->image_path) }}"
                alt="{{ $item->product->mug_name }}"
                width="80"
            >

            <h5>{{ $item->product->mug_name }}</h5>

            <span>{{ $item->total_qty }} sold</span>

        </div>

    @empty

        <p class="text-center">No sales yet.</p>

    @endforelse

                
            </div>

        </section>

        <footer class="dashboard-footer">

            <p>

                My Mug Dashboard. 
            </p>

        </footer>

    </main>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
       const chartLabels = @json($chartLabels);
       const chartData = @json($chartData);
    </script>


    @vite('resources/js/dashboard.js')

@endsection