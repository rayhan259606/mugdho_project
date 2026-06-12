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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('whatsapp_number_1')->nullable();
            $table->string('whatsapp_number_2')->nullable();
            $table->string('whatsapp_number_3')->nullable();
            $table->string('whatsapp_number_4')->nullable();
            $table->integer('whatsapp_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_number_1',
                'whatsapp_number_2',
                'whatsapp_number_3',
                'whatsapp_number_4',
                'whatsapp_active'
            ]);
        });
    }
};
