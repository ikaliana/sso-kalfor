<?php

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert(
            ['name' => 'Quisioner Builder', 'client_id' => 2, 'address' => '/builder'],
            ['name' => 'Report', 'client_id' => 2, 'address' => '/report'],
            ['name' => 'Data Collection', 'client_id' => 2, '/collect' => ''],
            ['name' => 'Dashboard', 'client_id' => 2, 'address' => '/dashboard'],
            ['name' => 'Data Survey', 'client_id' => 2, 'address' => '/survey'],
        );

        DB::table('modules')->insert(
            ['name' => 'Dashboard', 'client_id' => 3, 'address' => '/dashboard'],
            ['name' => 'Program', 'client_id' => 3, 'address' => '/program'],
            ['name' => 'Event', 'client_id' => 3, 'address' => '/event'],
            ['name' => 'Absensi', 'client_id' => 3, '/absensi' => ''],
            ['name' => 'Presentasi', 'client_id' => 3, 'address' => '/presentasi'],
            ['name' => 'Gambar', 'client_id' => 3, 'address' => '/gambar'],
            ['name' => 'TOR', 'client_id' => 3, 'address' => '/tor'],
            ['name' => 'Notula', 'client_id' => 3, 'address' => '/notula'],
            ['name' => 'ID Card', 'client_id' => 3, 'address' => '/idcard'],
            ['name' => 'Lokasi Program', 'client_id' => 3, 'address' => '/lokasi'],
            ['name' => 'Program data Peta', 'client_id' => 3, 'address' => '/peta'],
            ['name' => 'Penerima Manfaat', 'client_id' => 3, 'address' => '/manfaat'],
            ['name' => 'Program Data Input', 'client_id' => 3, 'address' => '/input'],
            ['name' => 'Kompilasi Data', 'client_id' => 3, 'address' => '/kompilasi'],
            ['name' => 'Laporan', 'client_id' => 3, 'address' => '/laporan'],
        );
    }
}
