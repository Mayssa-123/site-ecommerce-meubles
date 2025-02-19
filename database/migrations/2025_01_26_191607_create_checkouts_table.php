<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->unsignedBigInteger('user_id'); // Relier à la table users
            $table->decimal('total_price', 10, 2); // Prix total de la commande
            $table->enum('status', ['pending', 'delivered', 'in progress', 'canceled', 'delayed'])->default('pending')->change();
            $table->string('payment_method'); // Méthode de paiement (ex : carte, PayPal)
            $table->timestamps();

            // Clé étrangère pour relier à la table users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
