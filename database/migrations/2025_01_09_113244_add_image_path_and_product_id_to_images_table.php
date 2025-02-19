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
        Schema::table('images', function (Blueprint $table) {
            if (!Schema::hasColumn('images', 'image_path')) {
                $table->string('image_path');
            }

            if (!Schema::hasColumn('images', 'product_id')) {
                $table->foreignId('product_id')->constrained('products');
            }
        });
    }

    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            if (Schema::hasColumn('images', 'image_path')) {
                $table->dropColumn('image_path');
            }

            if (Schema::hasColumn('images', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
        });
    }
};
