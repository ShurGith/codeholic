<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    return new class extends Migration {
        public function up(): void
        {
            Schema::disableForeignKeyConstraints();
            
            Schema::create('cars', function (Blueprint $table) {
                $table->id();
                $table->foreignId('maker_id')->constrained();
                $table->foreignId('modelo_id')->constrained();
                $table->integer('year');
                $table->unsignedInteger('price');
                $table->string('vin', 255);
                $table->unsignedInteger('mileage');
                $table->foreignId('car_type_id')->constrained();
                $table->foreignId('fuel_type_id')->constrained();
                $table->foreignId('user_id')->constrained();
                $table->foreignId('city_id')->constrained();
                $table->string('address', 255);
                $table->string('phone', 45);
                $table->longText('description')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
            
            Schema::enableForeignKeyConstraints();
        }
        
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('cars');
        }
    };
