<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null');
            $table->text('complaint_text');
            $table->text('reply_text')->nullable();
            $table->foreignId('replied_by')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('reply_pelapor', ['0', '1'])->default('0');
            $table->timestamp('date_replied_by')->nullable();
            $table->timestamp('date_reply_pelapor')->nullable();
            $table->enum('status', ['pending', 'forwarded', 'processed', 'completed'])->default('pending');
            $table->timestamp('pending')->nullable();
            $table->timestamp('forwarded_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('complaints');
    }
};