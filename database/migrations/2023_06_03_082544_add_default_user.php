<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user1 = new User();
        $user1->name = 'Aristide KARBOU';
        $user1->email = 'aristidetiger12@gmail.com';
        $user1->email_verified_at = Carbon::now();
        $user1->password = Hash::make('SignalGoAdmin');
        $user1->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where('name', 'Aristide KARBOU')->delete();
    }
};
