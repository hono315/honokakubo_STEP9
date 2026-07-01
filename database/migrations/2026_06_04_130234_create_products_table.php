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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); //ユーザーID
            $table->foreignId('company_id')->constrained('companies'); //会社ID
            $table->string('product_name', 255); //商品名
            $table->integer('price'); //金額
            $table->integer('stock'); //在庫数
            $table->string('description',255); //説明
            $table->string('image_path',255); //画像
            $table->timestamps(); //作成日・更新日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
