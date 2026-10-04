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

                <h1>{{ __('messages.welcome_back_owner') }} </h1>

                <p>
                    {{ __('messages.dashboard_overview') }}
                </p>

            </div>
      
              

             

        </section>

                

        <section class="stats-section">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4> {{ __('messages.total_orders') }} </h4>
                    <h2 id="ordersCount">{{ $totalOrders }}</h2>
                    <span>{{ __('messages.orders_received') }}</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4>{{ __('messages.total_revenue') }}</h4>
                    <h2 id="revenue">{{ number_format($totalRevenue, 2) }} EGP</h2>
                    <span>{{ __('messages.store_earnings') }}</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4>{{ __('messages.products_sold') }}</h4>
                    <h2 id="productsCount">{{ $productsSold }}</h2>
                    <span>{{ __('messages.total_sold_items') }}</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <h4>{{ __('messages.best_seller') }}</h4>
                    <h2 id="bestSeller">{{$bestSeller?->product?->mug_name ?? '-'}}</h2>
                    <span>{{ __('messages.most_ordered_mug') }}</span>
                </div>
            </div>

        </div>

    </div>

</section>

          
<section class="product-management">

    <div class="card-header">
        <h2>{{ __('messages.manage_products') }}</h2>
        <span>{{ __('messages.add_edit_delete_mugs') }}</span>
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
            <label>{{ __('messages.mug_name') }}</label>

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
            <label>{{ __('messages.price') }}</label>

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
            <label>{{ __('messages.category') }}</label>

            <select class="form-select" id="category" name="category_id" required>
                <option value="">{{ __('messages.select_category') }}</option>
               @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}" {{ ($editProduct->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                     {{ $cat->name }}
                  </option>
               @endforeach
            </select>
        </div>


        
        <div class="col-md-6 mb-3">

            <label>{{ __('messages.image') }}</label>

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

                    <p>{{ __('messages.current_image') }}:</p>

                    <img
                       src="{{ $editProduct->image_url ?? '' }}"
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

            <label>{{ __('messages.description') }}</label>

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

            <label>{{ __('messages.capacity') }}</label>

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

            <label>{{ __('messages.how_its_made') }}</label>

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

            <label>{{ __('messages.microwave') }}</label>

            <select
                class="form-select"
                id="microwave"
                name="microwave"
                required
            >

                <option value="">{{ __('messages.choose') }}</option>

                <option
                    value="1"
                    {{ isset($editProduct) && $editProduct->microwave == 1 ? 'selected' : '' }}
                >
                    {{ __('messages.yes') }}
                </option>

                <option
                    value="0"
                    {{ isset($editProduct) && $editProduct->microwave == 0 ? 'selected' : '' }}
                >
                    {{ __('messages.no') }}
                </option>

            </select>

        </div>

    </div>


    

    <button
        type="submit"
        class="btn btn-dark"
        id="saveBtn"
    >
        {{ $editProduct ? __('messages.update_product') : __('messages.save_product') }}
    </button>


    @if($editProduct)

        <a
            href="{{ route('dashboard') }}"
            class="btn btn-secondary"
        >
            {{ __('messages.cancel') }}
        </a>

    @endif

</form>


<hr>




{{ $dataTable->table() }}



</section>

               
        <section class="dashboard-content">

            

            <div class="chart-card">

                <div class="card-header">

                    <h2>{{ __('messages.sales_overview') }}</h2>

                    <span>{{ __('messages.this_week') }}</span>

                </div>

                <canvas id="salesChart"></canvas>

            </div>


            <div class="orders-card">

                <div class="card-header">

                    <h2>{{ __('messages.recent_orders') }}</h2>

                </div>

                                <table>

                    <thead>
                        <tr>
                            <th>{{ __('messages.order_number') }} #</th>
                            <th>{{ __('messages.product') }}</th>
                            <th>{{ __('messages.qty') }}</th>
                            <th>{{ __('messages.total') }}</th>
                        </tr>
                    </thead>

                    <tbody id="ordersTable">
                    @forelse($recentOrders as $item)
                         <tr>

                         <td>
                             #{{ $item->order->id ?? '-' }}
                          </td>

                          <td>
                              {{ $item->product->mug_name ?? '-' }}
                          </td>

                         <td>
                              {{ $item->quantity }}
                          </td>

                         <td>
                              {{ $item->price * $item->quantity}} EGP
                          </td>

                         </tr>

                    @empty

                     <tr>
                         <td colspan="4" class="text-center">
                              {{ __('messages.no_orders_found') }}
                         </td>
                      </tr>

                    @endforelse
                 </tbody>

                </table>

            </div>

        </section>


        <section class="top-products">

            <div class="card-header">

                <h2>{{ __('messages.top_selling_products') }}</h2>

                <span>{{ __('messages.most_popular_mugs') }}</span>

            </div>

            <div class="top-products-grid" id="topProducts">

                @forelse ($topProducts as $item)

        <div class="top-product-card">

          <img src="{{ $item->product->image_url ?? asset('img/placeholder.png') }}"
              alt="{{ $item->product->mug_name ?? '-' }}"
              style="width: 100px; height: 100px; object-fit: cover;">

            <h5>{{ $item->product->mug_name }}</h5>

            <span>{{ $item->total_qty }} {{ __('messages.sold') }}</span>

        </div>

    @empty

        <p class="text-center">{{ __('messages.no_sales_yet') }}.</p>

    @endforelse

                
            </div>

        </section>

        <footer class="dashboard-footer">

            <p>

                {{ __('messages.dashboard_footer') }}
            </p>

        </footer>

    </main>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
       const chartLabels = @json($chartLabels);
       const chartData = @json($chartData);
    </script>


  @push('scripts')
    {{ $dataTable->scripts() }}
  @endpush


    @vite('resources/js/dashboard.js')

@endsection