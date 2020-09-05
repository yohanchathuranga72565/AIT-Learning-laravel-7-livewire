<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $add = User::create([
            'name' => 'Nadith Manawadu',
            'email' => 'nadith_manawadu@yahoo.com',
            'password' => bcrypt('abcd1234'),
        ]);
        $add->attachRole('administrator');

        $add->admin()->create([
            'name' => 'Nadith Manawadu',
            'email' => 'nadith_manawadu@yahoo.com',
            'address' => 'AIT Institute, Kumarakanda, Dodanduwa',
            'age' => 35,
            'gender' => 'Male',
            'phone_number' => '0770683621',
        ]);

        return $add;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('name','Nadith Manawadu')->delete();
    }
}
