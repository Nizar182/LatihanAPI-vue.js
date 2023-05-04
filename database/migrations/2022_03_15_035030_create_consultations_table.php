<?php

use App\Models\Society;
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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Society::class);
            $table->foreignId('doctor_id')->nullable()->constrained('medicals');
            $table->enum('status', ['accepted', 'declined', 'pending'])->default('pending');
            $table->string('current_symthoms')->nullable();
            $table->string('dieases_history')->nullable();
            $table->text('doctor_note')->nullable();
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
        Schema::dropIfExists('consultations');
    }
};
