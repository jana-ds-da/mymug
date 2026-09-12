<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->renameColumn('Order_id', 'order_id');
            $table->renameColumn('Product_id', 'product_id');
        });
    }
 
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->renameColumn('order_id', 'Order_id');
            $table->renameColumn('product_id', 'Product_id');
        });
    }
};