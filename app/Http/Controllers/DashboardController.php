<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Category;



class DashboardController extends Controller
{  
    public function index(Request $request){
       
      $products = Product::latest()->get();
      $categories = Category::all();


      $editProduct = null;
       if ($request->has('edit')) {
           $editProduct = Product::find((int) $request->query('edit'));
        }



        

     


       $totalOrders = Order::count();
       
       $totalRevenue = Order::sum('total');

       $productsSold = OrderItem::sum('quantity');

       $bestSeller = OrderItem::select(
           'product_id',
           DB::raw('SUM(quantity) as total_quantity')
          )
          ->groupBy('product_id')
          ->orderByDesc('total_quantity')
          ->with('product')
          ->first();;  


       $bestSellerName = $bestSeller?->product?->mug_name ?? '-';




       
        
       $salesRaw = Order::select(
          DB::raw('DATE(created_at) as date'),
          DB::raw('SUM(total) as total')
       )


       ->where('created_at', '>=' , Carbon::now()->subDays(6)->startOfDay())
       ->groupBy(DB::raw('DATE(created_at)'))
       ->orderBy('date')
       ->get()
       ->keyBy('date');

        $chartLabels = [];
        $chartData = [];

       

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            $chartLabels[] = Carbon::now()->subDays($i)->format('D');

            $chartData[] = $salesRaw->has($date) ? (float) $salesRaw[$date]->total : 0;
        }


        $recentOrders = OrderItem::with('order', 'product')
             ->latest()
             ->take(10)
             ->get();




        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'))
           ->groupBy('product_id')
           ->orderByDesc('total_qty')
           ->with('product')
           ->take(5)
           ->get();   


      return view('dashboard', compact(
             'products',
             'editProduct',
             'totalOrders',
             'totalRevenue',
             'productsSold',
             'bestSeller',
             'chartLabels',
             'chartData',
             'recentOrders',
             'topProducts',
             'categories'

          ));
        


    }







    


    
}
