<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->string('movie_id');
            $table->string('title');
            $table->string('auditorium');
            $table->dateTime('start_time');
            $table->json('available_seats');
            $table->json('reserved_seats')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('showtimes');
    }
};
