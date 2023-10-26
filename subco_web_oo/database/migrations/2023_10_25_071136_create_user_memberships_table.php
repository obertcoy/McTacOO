<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('user_memberships', function (Blueprint $table) {
        //     $table->unsignedBigInteger('user_id')->primary();
        //     $table->unsignedBigInteger('membership_id')->default(1);
        //     $table->unsignedBigInteger('membership_current_points')->default(0);

        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_memberships');
    }
}
