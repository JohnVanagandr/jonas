<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Añadir URL y límite (stock) a la tabla de regalos
        Schema::table('gifts', function (Blueprint $table) {
            $table->string('url')->nullable()->after('description');
            $table->integer('stock')->default(1)->after('url'); // 1 por defecto para mantener el comportamiento actual
        });

        // 2. Crear la tabla intermedia (Muchos a Muchos)
        Schema::create('gift_guest', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_id')->constrained()->onDelete('cascade');
            $table->foreignId('guest_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // 3. (Opcional pero recomendado) Migrar los datos existentes de gifts.guest_id a la nueva tabla pivote
        DB::statement('INSERT INTO gift_guest (gift_id, guest_id, created_at, updated_at) SELECT id, guest_id, now(), now() FROM gifts WHERE guest_id IS NOT NULL');

        // 4. Eliminar la llave foránea y luego la columna
        Schema::table('gifts', function (Blueprint $table) {
            // Primero rompemos la restricción usando el nombre de la columna en un arreglo
            $table->dropForeign(['guest_id']); 
            
            // Ahora sí podemos eliminar la columna libremente
            $table->dropColumn('guest_id');
        });
    }

    public function down(): void
    {
        Schema::table('gifts', function (Blueprint $table) {
            $table->foreignId('guest_id')->nullable()->constrained()->onDelete('set null');
        });

        Schema::dropIfExists('gift_guest');

        Schema::table('gifts', function (Blueprint $table) {
            $table->dropColumn(['url', 'stock']);
        });
    }
};