<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')->constrained('organisations')->unique();
            $table->string('group_id')->nullable();
            $table->string('batch_id')->nullable();
            $table->foreignId('category_id')->constrained('categories')->unique();
            $table->string('weightage');
            $table->boolean('is_correct')->default(0);
            $table->enum("validity", ["Active", "Inactive", "Deleted"])->default('Active');
            $table->dateTime('starts_on');
            $table->dateTime('ends_on');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users')->nullable();
            $table->foreignId('deleted_by')->constrained('users')->nullable();
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
        Schema::dropIfExists('user_accounts');
    }
};
