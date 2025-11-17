<?php

use App\Models\User;
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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('has_change_password')->default(false)->after('password');
        });

        $user = User::query()->where('email', '=', config('app.super_admin'))->first();
        if ($user) {
            $user->has_change_password = true;
            $user->save();
        }
        $user = User::query()->where('email', '=', config('app.admin'))->first();
        if ($user) {
            $user->has_change_password = true;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('has_change_password');
        });
    }
};
