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
        Schema::create('files', function (Blueprint $table) {

            $table->id();

            // Owner of the file
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Original file name (as uploaded by the user)
            $table->string('original_name');

            // Custom file name (users can set this)
            $table->string('custom_name')->nullable();

            // Unique key used to locate the file in S3
            $table->string('s3_key')->unique();

            // MIME type (e.g., application/pdf)
            $table->string('mime_type');

            // File size in bytes
            $table->unsignedBigInteger('size');

            // Whether the file is publicly accessible via token
            $table->boolean('is_public')->default(false);

            // Public access token (used for sharing)
            $table->string('public_token')->nullable()->unique();

            // File scan status (used for antivirus or ML analysis)
            $table->enum('scan_status', ['pending', 'clean', 'infected'])->default('pending');

            // When the scan was completed
            $table->timestamp('scanned_at')->nullable();

            
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
