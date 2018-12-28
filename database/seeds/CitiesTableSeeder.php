<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cities')->insert(['city_id' => '1401', 'province_id' => '14', 'short_name' => 'Kab. Kampar', 'long_name' => 'Kab. Kampar', ]);
        DB::table('cities')->insert(['city_id' => '1402', 'province_id' => '14', 'short_name' => 'Kab. Bengkalis', 'long_name' => 'Kab. Bengkalis', ]);
        DB::table('cities')->insert(['city_id' => '1403', 'province_id' => '14', 'short_name' => 'Kab. Indragiri Hulu', 'long_name' => 'Kab. Indragiri Hulu', ]);
        DB::table('cities')->insert(['city_id' => '1404', 'province_id' => '14', 'short_name' => 'Kab. Indragiri Hilir', 'long_name' => 'Kab. Indragiri Hilir', ]);
        DB::table('cities')->insert(['city_id' => '1405', 'province_id' => '14', 'short_name' => 'Kab. Pelalawan', 'long_name' => 'Kab. Pelalawan', ]);
        DB::table('cities')->insert(['city_id' => '1406', 'province_id' => '14', 'short_name' => 'Kab. Rokan Hulu', 'long_name' => 'Kab. Rokan Hulu', ]);
        DB::table('cities')->insert(['city_id' => '1407', 'province_id' => '14', 'short_name' => 'Kab. Rokan Hilir', 'long_name' => 'Kab. Rokan Hilir', ]);
        DB::table('cities')->insert(['city_id' => '1408', 'province_id' => '14', 'short_name' => 'Kab. Siak', 'long_name' => 'Kab. Siak', ]);
        DB::table('cities')->insert(['city_id' => '1409', 'province_id' => '14', 'short_name' => 'Kab. Kuantan Singingi', 'long_name' => 'Kab. Kuantan Singingi', ]);
        DB::table('cities')->insert(['city_id' => '1410', 'province_id' => '14', 'short_name' => 'Kota Pekanbaru', 'long_name' => 'Kota Pekanbaru', ]);
        DB::table('cities')->insert(['city_id' => '1411', 'province_id' => '14', 'short_name' => 'Kota Dumai', 'long_name' => 'Kota Dumai', ]);
        DB::table('cities')->insert(['city_id' => '1412', 'province_id' => '14', 'short_name' => 'Kab. Kepulauan Meranti', 'long_name' => 'Kab. Kepulauan Meranti', ]);
        DB::table('cities')->insert(['city_id' => '1501', 'province_id' => '15', 'short_name' => 'Kab. Batanghari', 'long_name' => 'Kab. Batanghari', ]);
        DB::table('cities')->insert(['city_id' => '1502', 'province_id' => '15', 'short_name' => 'Kab. Bungo', 'long_name' => 'Kab. Bungo', ]);
        DB::table('cities')->insert(['city_id' => '1503', 'province_id' => '15', 'short_name' => 'Kab. Merangin', 'long_name' => 'Kab. Merangin', ]);
        DB::table('cities')->insert(['city_id' => '1504', 'province_id' => '15', 'short_name' => 'Kab. Tanjung Jabung Barat', 'long_name' => 'Kab. Tanjung Jabung Barat', ]);
        DB::table('cities')->insert(['city_id' => '1505', 'province_id' => '15', 'short_name' => 'Kab. Kerinci', 'long_name' => 'Kab. Kerinci', ]);
        DB::table('cities')->insert(['city_id' => '1506', 'province_id' => '15', 'short_name' => 'Kab. Muaro Jambi', 'long_name' => 'Kab. Muaro Jambi', ]);
        DB::table('cities')->insert(['city_id' => '1507', 'province_id' => '15', 'short_name' => 'Kab. Tebo', 'long_name' => 'Kab. Tebo', ]);
        DB::table('cities')->insert(['city_id' => '1508', 'province_id' => '15', 'short_name' => 'Kab. Sarolangun', 'long_name' => 'Kab. Sarolangun', ]);
        DB::table('cities')->insert(['city_id' => '1509', 'province_id' => '15', 'short_name' => 'Kab. Tanjung Jabung Timur', 'long_name' => 'Kab. Tanjung Jabung Timur', ]);
        DB::table('cities')->insert(['city_id' => '1510', 'province_id' => '15', 'short_name' => 'Kota Jambi', 'long_name' => 'Kota Jambi', ]);
        DB::table('cities')->insert(['city_id' => '1511', 'province_id' => '15', 'short_name' => 'Kota Sungai Penuh', 'long_name' => 'Kota Sungai Penuh', ]);
        DB::table('cities')->insert(['city_id' => '2101', 'province_id' => '21', 'short_name' => 'Kab. Musi Banyuasin', 'long_name' => 'Kab. Musi Banyuasin', ]);
        DB::table('cities')->insert(['city_id' => '2102', 'province_id' => '21', 'short_name' => 'Kab. OKI', 'long_name' => 'Kab. Ogan Komering Ilir', ]);
        DB::table('cities')->insert(['city_id' => '2103', 'province_id' => '21', 'short_name' => 'Kab. OKU', 'long_name' => 'Kab. Ogan Komering Ulu', ]);
        DB::table('cities')->insert(['city_id' => '2104', 'province_id' => '21', 'short_name' => 'Kab. Muara Enim', 'long_name' => 'Kab. Muara Enim', ]);
        DB::table('cities')->insert(['city_id' => '2105', 'province_id' => '21', 'short_name' => 'Kab. Lahat', 'long_name' => 'Kab. Lahat', ]);
        DB::table('cities')->insert(['city_id' => '2106', 'province_id' => '21', 'short_name' => 'Kab. Musi Rawas', 'long_name' => 'Kab. Musi Rawas', ]);
        DB::table('cities')->insert(['city_id' => '2107', 'province_id' => '21', 'short_name' => 'Kab. Banyuasin', 'long_name' => 'Kab. Banyuasin', ]);
        DB::table('cities')->insert(['city_id' => '2108', 'province_id' => '21', 'short_name' => 'Kab. Ogan Ilir', 'long_name' => 'Kab. Ogan Ilir', ]);
        DB::table('cities')->insert(['city_id' => '2109', 'province_id' => '21', 'short_name' => 'Kab. OKU Selatan', 'long_name' => 'Kab. Ogan Komering Ulu Selatan', ]);
        DB::table('cities')->insert(['city_id' => '2110', 'province_id' => '21', 'short_name' => 'Kab. OKU Timur', 'long_name' => 'Kab. Ogan Komering Ulu Timur', ]);
        DB::table('cities')->insert(['city_id' => '2111', 'province_id' => '21', 'short_name' => 'Kota Palembang', 'long_name' => 'Kota Palembang', ]);
        DB::table('cities')->insert(['city_id' => '2112', 'province_id' => '21', 'short_name' => 'Kota Lubuk Linggau', 'long_name' => 'Kota Lubuk Linggau', ]);
        DB::table('cities')->insert(['city_id' => '2113', 'province_id' => '21', 'short_name' => 'Kota Prabumulih', 'long_name' => 'Kota Prabumulih', ]);
        DB::table('cities')->insert(['city_id' => '2114', 'province_id' => '21', 'short_name' => 'Kota Pagar Alam', 'long_name' => 'Kota Pagar Alam', ]);
        DB::table('cities')->insert(['city_id' => '2115', 'province_id' => '21', 'short_name' => 'Kab. Empat Lawang', 'long_name' => 'Kab. Empat Lawang', ]);
        DB::table('cities')->insert(['city_id' => '2116', 'province_id' => '21', 'short_name' => 'Kab. PALI', 'long_name' => 'Kab. Penukal Abab Lematang Ilir', ]);
        DB::table('cities')->insert(['city_id' => '2117', 'province_id' => '21', 'short_name' => 'Kab. Musi Rawas Utara', 'long_name' => 'Kab. Musi Rawas Utara', ]);
        DB::table('cities')->insert(['city_id' => '4101', 'province_id' => '41', 'short_name' => 'Kab. Sambas', 'long_name' => 'Kab. Sambas', ]);
        DB::table('cities')->insert(['city_id' => '4102', 'province_id' => '41', 'short_name' => 'Kab. Mempawah', 'long_name' => 'Kab. Mempawah', ]);
        DB::table('cities')->insert(['city_id' => '4103', 'province_id' => '41', 'short_name' => 'Kab. Sanggau', 'long_name' => 'Kab. Sanggau', ]);
        DB::table('cities')->insert(['city_id' => '4104', 'province_id' => '41', 'short_name' => 'Kab. Sintang', 'long_name' => 'Kab. Sintang', ]);
        DB::table('cities')->insert(['city_id' => '4105', 'province_id' => '41', 'short_name' => 'Kab. Kapuas Hulu', 'long_name' => 'Kab. Kapuas Hulu', ]);
        DB::table('cities')->insert(['city_id' => '4106', 'province_id' => '41', 'short_name' => 'Kab. Ketapang', 'long_name' => 'Kab. Ketapang', ]);
        DB::table('cities')->insert(['city_id' => '4107', 'province_id' => '41', 'short_name' => 'Kab. Bengkayang', 'long_name' => 'Kab. Bengkayang', ]);
        DB::table('cities')->insert(['city_id' => '4108', 'province_id' => '41', 'short_name' => 'Kab. Landak', 'long_name' => 'Kab. Landak', ]);
        DB::table('cities')->insert(['city_id' => '4109', 'province_id' => '41', 'short_name' => 'Kab. Melawi', 'long_name' => 'Kab. Melawi', ]);
        DB::table('cities')->insert(['city_id' => '4110', 'province_id' => '41', 'short_name' => 'Kota Pontianak', 'long_name' => 'Kota Pontianak', ]);
        DB::table('cities')->insert(['city_id' => '4111', 'province_id' => '41', 'short_name' => 'Kota Singkawang', 'long_name' => 'Kota Singkawang', ]);
        DB::table('cities')->insert(['city_id' => '4112', 'province_id' => '41', 'short_name' => 'Kab. Sekadau', 'long_name' => 'Kab. Sekadau', ]);
        DB::table('cities')->insert(['city_id' => '4113', 'province_id' => '41', 'short_name' => 'Kab. Kayong Utara', 'long_name' => 'Kab. Kayong Utara', ]);
        DB::table('cities')->insert(['city_id' => '4114', 'province_id' => '41', 'short_name' => 'Kab. Kubu Raya', 'long_name' => 'Kab. Kubu Raya', ]);
        DB::table('cities')->insert(['city_id' => '4201', 'province_id' => '42', 'short_name' => 'Kab. Kapuas', 'long_name' => 'Kab. Kapuas', ]);
        DB::table('cities')->insert(['city_id' => '4202', 'province_id' => '42', 'short_name' => 'Kab. Barito Selatan', 'long_name' => 'Kab. Barito Selatan', ]);
        DB::table('cities')->insert(['city_id' => '4203', 'province_id' => '42', 'short_name' => 'Kab. Barito Utara', 'long_name' => 'Kab. Barito Utara', ]);
        DB::table('cities')->insert(['city_id' => '4204', 'province_id' => '42', 'short_name' => 'Kab. Kotawaringin Timur', 'long_name' => 'Kab. Kotawaringin Timur', ]);
        DB::table('cities')->insert(['city_id' => '4205', 'province_id' => '42', 'short_name' => 'Kab. Kotawaringin Barat', 'long_name' => 'Kab. Kotawaringin Barat', ]);
        DB::table('cities')->insert(['city_id' => '4206', 'province_id' => '42', 'short_name' => 'Kab. Pulang Pisau', 'long_name' => 'Kab. Pulang Pisau', ]);
        DB::table('cities')->insert(['city_id' => '4207', 'province_id' => '42', 'short_name' => 'Kab. Gunung Mas', 'long_name' => 'Kab. Gunung Mas', ]);
        DB::table('cities')->insert(['city_id' => '4208', 'province_id' => '42', 'short_name' => 'Kab. Barito Timur', 'long_name' => 'Kab. Barito Timur', ]);
        DB::table('cities')->insert(['city_id' => '4209', 'province_id' => '42', 'short_name' => 'Kab. Sukamara', 'long_name' => 'Kab. Sukamara', ]);
        DB::table('cities')->insert(['city_id' => '4210', 'province_id' => '42', 'short_name' => 'Kab. Katingan', 'long_name' => 'Kab. Katingan', ]);
        DB::table('cities')->insert(['city_id' => '4211', 'province_id' => '42', 'short_name' => 'Kab. Lamandau', 'long_name' => 'Kab. Lamandau', ]);
        DB::table('cities')->insert(['city_id' => '4212', 'province_id' => '42', 'short_name' => 'Kab. Seruyan', 'long_name' => 'Kab. Seruyan', ]);
        DB::table('cities')->insert(['city_id' => '4213', 'province_id' => '42', 'short_name' => 'Kab. Murung Raya', 'long_name' => 'Kab. Murung Raya', ]);
        DB::table('cities')->insert(['city_id' => '4214', 'province_id' => '42', 'short_name' => 'Kota Palangkaraya', 'long_name' => 'Kota Palangkaraya', ]);
        DB::table('cities')->insert(['city_id' => '4301', 'province_id' => '43', 'short_name' => 'Kab. Banjar', 'long_name' => 'Kab. Banjar', ]);
        DB::table('cities')->insert(['city_id' => '4302', 'province_id' => '43', 'short_name' => 'Kab. Tanah Laut', 'long_name' => 'Kab. Tanah Laut', ]);
        DB::table('cities')->insert(['city_id' => '4303', 'province_id' => '43', 'short_name' => 'Kab. Barito Kuala', 'long_name' => 'Kab. Barito Kuala', ]);
        DB::table('cities')->insert(['city_id' => '4304', 'province_id' => '43', 'short_name' => 'Kab. Tapin', 'long_name' => 'Kab. Tapin', ]);
        DB::table('cities')->insert(['city_id' => '4305', 'province_id' => '43', 'short_name' => 'Kab. Hulu Sungai Selatan', 'long_name' => 'Kab. Hulu Sungai Selatan', ]);
        DB::table('cities')->insert(['city_id' => '4306', 'province_id' => '43', 'short_name' => 'Kab. Hulu Sungai Tengah', 'long_name' => 'Kab. Hulu Sungai Tengah', ]);
        DB::table('cities')->insert(['city_id' => '4307', 'province_id' => '43', 'short_name' => 'Kab. Hulu Sungai Utara', 'long_name' => 'Kab. Hulu Sungai Utara', ]);
        DB::table('cities')->insert(['city_id' => '4308', 'province_id' => '43', 'short_name' => 'Kab. Tabalong', 'long_name' => 'Kab. Tabalong', ]);
        DB::table('cities')->insert(['city_id' => '4309', 'province_id' => '43', 'short_name' => 'Kab. Kotabaru', 'long_name' => 'Kab. Kotabaru', ]);
        DB::table('cities')->insert(['city_id' => '4310', 'province_id' => '43', 'short_name' => 'Kab. Tanah Bumbu', 'long_name' => 'Kab. Tanah Bumbu', ]);
        DB::table('cities')->insert(['city_id' => '4311', 'province_id' => '43', 'short_name' => 'Kab. Balangan', 'long_name' => 'Kab. Balangan', ]);
        DB::table('cities')->insert(['city_id' => '4312', 'province_id' => '43', 'short_name' => 'Kota Banjarmasin', 'long_name' => 'Kota Banjarmasin', ]);
        DB::table('cities')->insert(['city_id' => '4313', 'province_id' => '43', 'short_name' => 'Kota Banjarbaru', 'long_name' => 'Kota Banjarbaru', ]);
        DB::table('cities')->insert(['city_id' => '7301', 'province_id' => '73', 'short_name' => 'Kab. Jayapura', 'long_name' => 'Kab. Jayapura', ]);
        DB::table('cities')->insert(['city_id' => '7302', 'province_id' => '73', 'short_name' => 'Kab. Biak Numfor', 'long_name' => 'Kab. Biak Numfor', ]);
        DB::table('cities')->insert(['city_id' => '7303', 'province_id' => '73', 'short_name' => 'Kab. Kepulauan Yapen', 'long_name' => 'Kab. Kepulauan Yapen', ]);
        DB::table('cities')->insert(['city_id' => '7304', 'province_id' => '73', 'short_name' => 'Kab. Merauke', 'long_name' => 'Kab. Merauke', ]);
        DB::table('cities')->insert(['city_id' => '7305', 'province_id' => '73', 'short_name' => 'Kab. Jayawijaya', 'long_name' => 'Kab. Jayawijaya', ]);
        DB::table('cities')->insert(['city_id' => '7306', 'province_id' => '73', 'short_name' => 'Kab. Paniai', 'long_name' => 'Kab. Paniai', ]);
        DB::table('cities')->insert(['city_id' => '7307', 'province_id' => '73', 'short_name' => 'Kab. Nabire', 'long_name' => 'Kab. Nabire', ]);
        DB::table('cities')->insert(['city_id' => '7308', 'province_id' => '73', 'short_name' => 'Kab. Puncak Jaya', 'long_name' => 'Kab. Puncak Jaya', ]);
        DB::table('cities')->insert(['city_id' => '7309', 'province_id' => '73', 'short_name' => 'Kab. Mimika', 'long_name' => 'Kab. Mimika', ]);
        DB::table('cities')->insert(['city_id' => '7310', 'province_id' => '73', 'short_name' => 'Kab. Keerom', 'long_name' => 'Kab. Keerom', ]);
        DB::table('cities')->insert(['city_id' => '7311', 'province_id' => '73', 'short_name' => 'Kab. Sarmi', 'long_name' => 'Kab. Sarmi', ]);
        DB::table('cities')->insert(['city_id' => '7312', 'province_id' => '73', 'short_name' => 'Kab. Asmat', 'long_name' => 'Kab. Asmat', ]);
        DB::table('cities')->insert(['city_id' => '7313', 'province_id' => '73', 'short_name' => 'Kab. Mappi', 'long_name' => 'Kab. Mappi', ]);
        DB::table('cities')->insert(['city_id' => '7314', 'province_id' => '73', 'short_name' => 'Kab. Boven Digul', 'long_name' => 'Kab. Boven Digul', ]);
        DB::table('cities')->insert(['city_id' => '7315', 'province_id' => '73', 'short_name' => 'Kab. Yahukimo', 'long_name' => 'Kab. Yahukimo', ]);
        DB::table('cities')->insert(['city_id' => '7316', 'province_id' => '73', 'short_name' => 'Kab. Pegunungan Bintang', 'long_name' => 'Kab. Pegunungan Bintang', ]);
        DB::table('cities')->insert(['city_id' => '7317', 'province_id' => '73', 'short_name' => 'Kab. Supiori', 'long_name' => 'Kab. Supiori', ]);
        DB::table('cities')->insert(['city_id' => '7318', 'province_id' => '73', 'short_name' => 'Kab. Waropen', 'long_name' => 'Kab. Waropen', ]);
        DB::table('cities')->insert(['city_id' => '7319', 'province_id' => '73', 'short_name' => 'Kab. Tolikara', 'long_name' => 'Kab. Tolikara', ]);
        DB::table('cities')->insert(['city_id' => '7320', 'province_id' => '73', 'short_name' => 'Kota Jayapura', 'long_name' => 'Kota Jayapura', ]);
        DB::table('cities')->insert(['city_id' => '7321', 'province_id' => '73', 'short_name' => 'Kab. Mamberamo Raya', 'long_name' => 'Kab. Mamberamo Raya', ]);
        DB::table('cities')->insert(['city_id' => '7322', 'province_id' => '73', 'short_name' => 'Kab. Dogiyai', 'long_name' => 'Kab. Dogiyai', ]);
        DB::table('cities')->insert(['city_id' => '7323', 'province_id' => '73', 'short_name' => 'Kab. Lanny Jaya', 'long_name' => 'Kab. Lanny Jaya', ]);
        DB::table('cities')->insert(['city_id' => '7324', 'province_id' => '73', 'short_name' => 'Kab. Mamberamo Tengah', 'long_name' => 'Kab. Mamberamo Tengah', ]);
        DB::table('cities')->insert(['city_id' => '7325', 'province_id' => '73', 'short_name' => 'Kab. Nduga', 'long_name' => 'Kab. Nduga', ]);
        DB::table('cities')->insert(['city_id' => '7326', 'province_id' => '73', 'short_name' => 'Kab. Puncak', 'long_name' => 'Kab. Puncak', ]);
        DB::table('cities')->insert(['city_id' => '7327', 'province_id' => '73', 'short_name' => 'Kab. Yalimo', 'long_name' => 'Kab. Yalimo', ]);
        DB::table('cities')->insert(['city_id' => '7328', 'province_id' => '73', 'short_name' => 'Kab. Intan Jaya', 'long_name' => 'Kab. Intan Jaya', ]);
        DB::table('cities')->insert(['city_id' => '7329', 'province_id' => '73', 'short_name' => 'Kab. Deiyai', 'long_name' => 'Kab. Deiyai', ]);
    }
}
