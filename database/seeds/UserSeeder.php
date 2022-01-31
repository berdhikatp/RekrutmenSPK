<?php
use App\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'nim' => '12345',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'nim' => '361855401065',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user')
        ]);

        $user->assignRole('user');

        $pengurus = User::create([
            'name' => 'Pengurus',
            'nim' => '1234',
            'email' => 'pengurus@gmail.com',
            'password' => bcrypt('pengurus')
        ]);

        $pengurus->assignRole('pengurus');
    }
}
