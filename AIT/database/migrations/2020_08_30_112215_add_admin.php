<?php

use App\User;
// use Carbon\Traits\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            'dob' => DateTime::createFromFormat('Y/m/d', '1990/06/05'),
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
