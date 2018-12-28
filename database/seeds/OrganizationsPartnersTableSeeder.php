<?php

use Illuminate\Database\Seeder;

class OrganizationsPartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organizations')->insert([ 'id' => '120', 'code' => '7-icctf', 'org_type' => '7', 'short_name' => 'ICCTF', 'full_name' => 'Indonesia Climate Change Trust Fund', ]);
        DB::table('organizations')->insert([ 'id' => '121', 'code' => '7-undp', 'org_type' => '7', 'short_name' => 'UNDP', 'full_name' => 'United Nations Development Programme', ]);
        DB::table('organizations')->insert([ 'id' => '122', 'code' => '7-jica', 'org_type' => '7', 'short_name' => 'JICA', 'full_name' => 'Japan International Cooperation Agency', ]);
        DB::table('organizations')->insert([ 'id' => '123', 'code' => '7-mcai', 'org_type' => '7', 'short_name' => 'MCAI', 'full_name' => 'Millenium Challenge Account Indonesia', ]);
        DB::table('organizations')->insert([ 'id' => '124', 'code' => '6-rwwg', 'org_type' => '6', 'short_name' => 'RWWG', 'full_name' => 'Riau Women Working Group', ]);
        DB::table('organizations')->insert([ 'id' => '125', 'code' => '6-ymi', 'org_type' => '6', 'short_name' => 'YMI', 'full_name' => 'Yayasan Mitra Insani', ]);
        DB::table('organizations')->insert([ 'id' => '126', 'code' => '6-jmg-riau', 'org_type' => '6', 'short_name' => 'JMG Riau', 'full_name' => 'Jaringan Masyarakat Gambut Riau', ]);
        DB::table('organizations')->insert([ 'id' => '127', 'code' => '5-univ-riau', 'org_type' => '5', 'short_name' => 'Univ Riau', 'full_name' => ' Pusat Studi Bencana Universitas Riau', ]);
        DB::table('organizations')->insert([ 'id' => '128', 'code' => '7-fitra-riau', 'org_type' => '7', 'short_name' => 'FITRA RIAU', 'full_name' => 'Forum Indonesia Untuk Transparansi Anggaran - Riau', ]);
        DB::table('organizations')->insert([ 'id' => '129', 'code' => '6-haki', 'org_type' => '6', 'short_name' => 'HaKI', 'full_name' => 'Konsorsium Hutan Kita Institute', ]);
        DB::table('organizations')->insert([ 'id' => '130', 'code' => '6-peta', 'org_type' => '6', 'short_name' => 'PeTA', 'full_name' => 'Perkumpulan Tanah Air', ]);
        DB::table('organizations')->insert([ 'id' => '131', 'code' => '6-jmg-sumsel', 'org_type' => '6', 'short_name' => 'JMG Sumsel', 'full_name' => 'Jaringan Masyarakat Gambut Sumsel', ]);
        DB::table('organizations')->insert([ 'id' => '132', 'code' => '7-walhi-sumsel', 'org_type' => '7', 'short_name' => 'WALHI Sumsel', 'full_name' => 'Wahana Lingkungan Hidup Indonesia - Sumsel', ]);
        DB::table('organizations')->insert([ 'id' => '133', 'code' => '7-inagri', 'org_type' => '7', 'short_name' => 'INAgri', 'full_name' => 'Institute Agroekologi Indonesia', ]);
        DB::table('organizations')->insert([ 'id' => '134', 'code' => '6-kompag', 'org_type' => '6', 'short_name' => 'KOMPAG', 'full_name' => 'Komunitas Masyarakat Pengelola Gambut', ]);
        DB::table('organizations')->insert([ 'id' => '135', 'code' => '5-univ-palangka-raya', 'org_type' => '5', 'short_name' => 'Univ Palangka Raya', 'full_name' => 'P2KLH Universitas Palangka Raya', ]);
        DB::table('organizations')->insert([ 'id' => '136', 'code' => '7-wwf', 'org_type' => '7', 'short_name' => 'WWF', 'full_name' => 'World Wide Fund for Nature', ]);
    }
}
