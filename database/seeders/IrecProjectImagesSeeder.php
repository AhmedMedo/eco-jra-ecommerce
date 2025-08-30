<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IrecProjectImagesSeeder extends Seeder
{
    public function run()
    {
        $images = [
            // Benban Solar Park
            [
                'project_id' => 1,
                'image_path' => 'projects/benban-solar-park-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'Benban Solar Park - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 1,
                'image_path' => 'projects/benban-solar-park-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Benban Solar Park - Solar Panels',
                'sort_order' => 2,
            ],
            [
                'project_id' => 1,
                'image_path' => 'projects/benban-solar-park-gallery-2.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Benban Solar Park - Infrastructure',
                'sort_order' => 3,
            ],
            
            // Zafarana Wind Farm
            [
                'project_id' => 2,
                'image_path' => 'projects/zafarana-wind-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'Zafarana Wind Farm - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 2,
                'image_path' => 'projects/zafarana-wind-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Zafarana Wind Farm - Wind Turbines',
                'sort_order' => 2,
            ],
            
            // Gulf of Suez Hydroelectric
            [
                'project_id' => 3,
                'image_path' => 'projects/gulf-of-suez-hydro-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'Gulf of Suez Hydroelectric - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 3,
                'image_path' => 'projects/gulf-of-suez-hydro-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Gulf of Suez Hydroelectric - Dam Structure',
                'sort_order' => 2,
            ],
            
            // SolarTech Egypt
            [
                'project_id' => 4,
                'image_path' => 'projects/solartech-egypt-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'SolarTech Egypt - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 4,
                'image_path' => 'projects/solartech-egypt-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'SolarTech Egypt - Solar Panels',
                'sort_order' => 2,
            ],
            
            // Morocco Solar Initiative
            [
                'project_id' => 5,
                'image_path' => 'projects/morocco-solar-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'Morocco Solar Initiative - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 5,
                'image_path' => 'projects/morocco-solar-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Morocco Solar Initiative - Concentrated Solar',
                'sort_order' => 2,
            ],
            
            // Tunisia Wind Energy
            [
                'project_id' => 6,
                'image_path' => 'projects/tunisia-wind-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'Tunisia Wind Energy - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 6,
                'image_path' => 'projects/tunisia-wind-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Tunisia Wind Energy - Offshore Turbines',
                'sort_order' => 2,
            ],
            
            // Algeria Bioenergy Plant
            [
                'project_id' => 7,
                'image_path' => 'projects/algeria-bio-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'Algeria Bioenergy Plant - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 7,
                'image_path' => 'projects/algeria-bio-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Algeria Bioenergy Plant - Processing Facility',
                'sort_order' => 2,
            ],
            
            // Egypt Advanced Solar
            [
                'project_id' => 8,
                'image_path' => 'projects/egypt-advanced-solar-main.jpg',
                'image_type' => 'main',
                'alt_text' => 'Egypt Advanced Solar - Main View',
                'sort_order' => 1,
            ],
            [
                'project_id' => 8,
                'image_path' => 'projects/egypt-advanced-solar-gallery-1.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Egypt Advanced Solar - Bifacial Panels',
                'sort_order' => 2,
            ],
            [
                'project_id' => 8,
                'image_path' => 'projects/egypt-advanced-solar-gallery-2.jpg',
                'image_type' => 'gallery',
                'alt_text' => 'Egypt Advanced Solar - Smart Tracking',
                'sort_order' => 3,
            ],
        ];

        foreach ($images as $image) {
            DB::table('tl_multivendor_irec_project_images')->insert($image);
        }

        $this->command->info('IREC Project Images seeded successfully!');
    }
}
