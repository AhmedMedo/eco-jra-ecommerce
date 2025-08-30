<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IrecProjectCertificationsSeeder extends Seeder
{
    public function run()
    {
        $certifications = [
            // Benban Solar Park
            [
                'project_id' => 1,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKAES10000',
                'issuance_date' => '2024-04-01',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            [
                'project_id' => 1,
                'certification_type' => 'GCC',
                'certification_number' => 'GCC-ES-2024-001',
                'issuance_date' => '2024-04-01',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'GCC Authority',
            ],
            
            // Zafarana Wind Farm
            [
                'project_id' => 2,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKAES10001',
                'issuance_date' => '2024-03-15',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            [
                'project_id' => 2,
                'certification_type' => 'EU',
                'certification_number' => 'EU-WIND-2024-001',
                'issuance_date' => '2024-03-15',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'EU Commission',
            ],
            
            // Gulf of Suez Hydroelectric
            [
                'project_id' => 3,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKAES10002',
                'issuance_date' => '2024-02-20',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            
            // SolarTech Egypt
            [
                'project_id' => 4,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKAES10003',
                'issuance_date' => '2024-01-10',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            [
                'project_id' => 4,
                'certification_type' => 'GCC',
                'certification_number' => 'GCC-ES-2024-002',
                'issuance_date' => '2024-01-10',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'GCC Authority',
            ],
            
            // Morocco Solar Initiative
            [
                'project_id' => 5,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKAMA10000',
                'issuance_date' => '2024-03-01',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            [
                'project_id' => 5,
                'certification_type' => 'EU',
                'certification_number' => 'EU-SOLAR-2024-001',
                'issuance_date' => '2024-03-01',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'EU Commission',
            ],
            
            // Tunisia Wind Energy
            [
                'project_id' => 6,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKATN10000',
                'issuance_date' => '2024-02-15',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            
            // Algeria Bioenergy Plant
            [
                'project_id' => 7,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKAAL10000',
                'issuance_date' => '2024-01-25',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            
            // Egypt Advanced Solar
            [
                'project_id' => 8,
                'certification_type' => 'IREC',
                'certification_number' => 'DAKAES10004',
                'issuance_date' => '2024-04-15',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'evident.app',
            ],
            [
                'project_id' => 8,
                'certification_type' => 'GCC',
                'certification_number' => 'GCC-ES-2024-003',
                'issuance_date' => '2024-04-15',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'GCC Authority',
            ],
            [
                'project_id' => 8,
                'certification_type' => 'EU',
                'certification_number' => 'EU-SOLAR-2024-002',
                'issuance_date' => '2024-04-15',
                'expiry_date' => '2024-12-31',
                'verified_by' => 'EU Commission',
            ],
        ];

        foreach ($certifications as $certification) {
            DB::table('tl_multivendor_irec_project_certifications')->insert($certification);
        }

        $this->command->info('IREC Project Certifications seeded successfully!');
    }
}
