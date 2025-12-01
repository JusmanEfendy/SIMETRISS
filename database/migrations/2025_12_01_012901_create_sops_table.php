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
        Schema::create('sops', function (Blueprint $table) {
            $table->id();
            $table->string('id_sop')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('nomor_sk')->unique();
            $table->enum('type', ['NonAP', 'AP']);
            $table->string('id_unit');
            $table->string('sop_name');
            $table->text('desc');
            $table->date('approval_date');
            $table->date('start_date');
            $table->date('exp');
            $table->integer('days_left');
            $table->string('file_path');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Expired'])->default('Pending');
            $table->string('revision');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sops');
    }
};
