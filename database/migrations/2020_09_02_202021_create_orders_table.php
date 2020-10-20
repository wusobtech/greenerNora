<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('admin_id')->index()->nullable();
            $table->unsignedBigInteger('payment_id')->index()->nullable();
            $table->double('totalamount', 10, 2);
            $table->string('ref_no');
            $table->string('payment_method');
            $table->string('status')->default('Pending');
            $table->date('orderdate');
            $table->date('deliverydate')->nullable();
            $table->string('user_email');
            $table->string('name');
            $table->string('country');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->integer('postcode');
            $table->string('phone');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
