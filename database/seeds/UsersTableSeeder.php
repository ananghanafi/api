<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // default admin user, pass: 123456
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@brg.go.id',
            'password' => '$2y$12$pc9qbO.SMhxWiDIBf72i7u58EV/rVnKAjEdbcQv8RvyX72gVsytnq',
            'api_token' => 'my1R14O2veiY4xJlRdQsz9l86oTj/SItWvHcV8MpvqI=',
        ]);
        DB::table('users')->insert([
            'id' => '2',
            'name' => 'nazir',
            'email' => 'nazir@brg.go.id',
            'password' => '$2y$12$pc9qbO.SMhxWiDIBf72i7u58EV/rVnKAjEdbcQv8RvyX72gVsytnq',
            'api_token' => 'my1R24O2veiY4xJlRdQsz9l86oTj/SItWvHcV8MpvqI=',
        ]);
        DB::table('users')->insert([
            'id' => '3',
            'name' => 'hartono',
            'email' => 'hartono@brg.go.id',
            'password' => '$2y$12$pc9qbO.SMhxWiDIBf72i7u58EV/rVnKAjEdbcQv8RvyX72gVsytnq',
            'api_token' => 'my1R34O2veiY4xJlRdQsz9l86oTj/SItWvHcV8MpvqI=',
        ]);

    }
}
