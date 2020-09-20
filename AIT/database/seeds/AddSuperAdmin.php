<?php

use App\User;
use Illuminate\Database\Seeder;

class AddSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
    }
}
