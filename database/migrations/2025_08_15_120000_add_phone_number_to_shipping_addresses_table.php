<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('postal_code');
        });
    }
    public function down()
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->dropColumn('phone_number');
        });
    }
};
