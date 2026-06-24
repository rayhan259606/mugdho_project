<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop foreign key if it exists
            if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                try {
                    $table->dropForeign('orders_product_id_foreign');
                } catch (\Exception $e) {
                    // Ignore if not exists
                }
            }
            $table->unsignedBigInteger('product_id')->nullable()->change();
            
            $table->unsignedBigInteger('antique_product_id')->nullable();
            $table->unsignedBigInteger('digital_product_id')->nullable();
            $table->unsignedBigInteger('gadget_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['antique_product_id', 'digital_product_id', 'gadget_id']);
        });
    }
};
