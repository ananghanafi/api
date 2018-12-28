<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('provinces')->insert(['province_id' => '11', 'short_name' => 'Aceh', 'long_name' => 'Aceh', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '12', 'short_name' => 'Sumut', 'long_name' => 'Sumatera Utara', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '13', 'short_name' => 'Sumbar', 'long_name' => 'Sumatera Barat', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '14', 'short_name' => 'Riau', 'long_name' => 'Riau', 'is_enabled' => 1,]);
        DB::table('provinces')->insert(['province_id' => '15', 'short_name' => 'Jambi', 'long_name' => 'Jambi', 'is_enabled' => 1,]);
        DB::table('provinces')->insert(['province_id' => '21', 'short_name' => 'Sumsel', 'long_name' => 'Sumatera Selatan', 'is_enabled' => 1,]);
        DB::table('provinces')->insert(['province_id' => '22', 'short_name' => 'Bengkulu', 'long_name' => 'Bengkulu', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '23', 'short_name' => 'Lampung', 'long_name' => 'Lampung', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '24', 'short_name' => 'Babel', 'long_name' => 'Kepulauan Bangka Belitung', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '25', 'short_name' => 'Kepri', 'long_name' => 'Kepulauan Riau', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '31', 'short_name' => 'DKI', 'long_name' => 'DKI Jakarta', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '32', 'short_name' => 'Jabar', 'long_name' => 'Jawa Barat', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '33', 'short_name' => 'Jateng', 'long_name' => 'Jawa Tengah', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '34', 'short_name' => 'DIY', 'long_name' => 'DI Yogyakarta', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '35', 'short_name' => 'Jatim', 'long_name' => 'Jawa Timur', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '36', 'short_name' => 'Banten', 'long_name' => 'Banten', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '41', 'short_name' => 'Kalbar', 'long_name' => 'Kalimantan Barat', 'is_enabled' => 1,]);
        DB::table('provinces')->insert(['province_id' => '42', 'short_name' => 'Kalteng', 'long_name' => 'Kalimantan Tengah', 'is_enabled' => 1,]);
        DB::table('provinces')->insert(['province_id' => '43', 'short_name' => 'Kalsel', 'long_name' => 'Kalimantan Selatan', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '44', 'short_name' => 'Kaltim', 'long_name' => 'Kalimantan Timur', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '45', 'short_name' => 'Kaltara', 'long_name' => 'Kalimantan Utara', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '51', 'short_name' => 'Sulut', 'long_name' => 'Sulawesi Utara', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '52', 'short_name' => 'Sulteng', 'long_name' => 'Sulawesi Tengah', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '53', 'short_name' => 'Sulsel', 'long_name' => 'Sulawesi Selatan', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '54', 'short_name' => 'Sultara', 'long_name' => 'Sulawesi Tenggara', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '55', 'short_name' => 'Gorontalo', 'long_name' => 'Gorontalo', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '56', 'short_name' => 'Sulbar', 'long_name' => 'Sulawesi Barat', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '61', 'short_name' => 'Bali', 'long_name' => 'Bali', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '62', 'short_name' => 'NTB', 'long_name' => 'Nusa Tenggara Barat', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '63', 'short_name' => 'NTT', 'long_name' => 'Nusa Tenggara Timur', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '71', 'short_name' => 'Maluku', 'long_name' => 'Maluku', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '72', 'short_name' => 'Malut', 'long_name' => 'Maluku Utara', 'is_enabled' => 0,]);
        DB::table('provinces')->insert(['province_id' => '73', 'short_name' => 'Papua', 'long_name' => 'Papua', 'is_enabled' => 1,]);
        DB::table('provinces')->insert(['province_id' => '74', 'short_name' => 'Papua Barat', 'long_name' => 'Papua Barat', 'is_enabled' => 0,]);
    }
}
