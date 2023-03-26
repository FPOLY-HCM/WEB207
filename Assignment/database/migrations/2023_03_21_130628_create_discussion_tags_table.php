<?php

use App\Models\Discussion;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discussion_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Discussion::class)->constrained();
            $table->foreignIdFor(Tag::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussion_tag');
    }
};
