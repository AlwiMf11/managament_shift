<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            ['name' => 'Budi Santoso', 'position' => 'Operator Produksi', 'department' => 'Produksi', 'phone' => '081234567801'],
            ['name' => 'Siti Aminah', 'position' => 'Quality Control', 'department' => 'Quality Assurance', 'phone' => '081234567802'],
            ['name' => 'Agus Prasetyo', 'position' => 'Teknisi Mesin', 'department' => 'Maintenance', 'phone' => '081234567803'],
            ['name' => 'Rina Wulandari', 'position' => 'Staff Gudang', 'department' => 'Logistik', 'phone' => '081234567804'],
            ['name' => 'Dedi Setiawan', 'position' => 'Operator Produksi', 'department' => 'Produksi', 'phone' => '081234567805'],
            ['name' => 'Yuni Kartika', 'position' => 'Admin Produksi', 'department' => 'Produksi', 'phone' => '081234567806'],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
