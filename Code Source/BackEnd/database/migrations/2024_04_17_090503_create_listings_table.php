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
        Schema::create('listings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('recruiter_id')->references('id')->on('recruiters');
            $table->foreignUuid('company_id')->references('id')->on('companies');
            $table->string('title');
            $table->longText('overview');
            $table->longText('responsibilities');
            $table->longText('requirements');
            $table->string('location');
            $table->unsignedBigInteger('salary');
            $table->string('employment_type');
            $table->date('post_date');
            $table->string('status')->default('Pending');
            $table->date('expiration_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
