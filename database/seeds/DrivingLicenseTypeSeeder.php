<?php

use App\DrivingLicenseType;
use Illuminate\Database\Seeder;

class DrivingLicenseTypeSeeder extends Seeder
{
    public function run()
    {
        $drivingLicenseTypes = [
            [
                'code' => 'B',
                'name' => 'רכב פרטי',
                'icon' => 'car',
//                'image_url' => '',
            ],
            [
                'code' => 'A',
                'name' => 'אופנוע',
                'icon' => 'motorcycle',
//                'image_url' => '',
            ],
            [
                'code' => 'C',
                'name' => 'רכב משא כבד',
                'icon' => 'truck-moving',
//                'image_url' => '',
            ],
            [
                'code' => 'C1',
                'name' => 'רכב משא קל',
                'icon' => 'truck',
//                'image_url' => '',
            ],
            [
                'code' => 'D',
                'name' => 'רכב ציבורי',
                'icon' => 'bus',
//                'image_url' => '',
            ],
            [
                'code' => '1',
                'name' => 'טרקטור',
                'icon' => 'tractor',
//                'image_url' => '',
            ],
            [
                'code' => 'A3',
                'name' => 'אופניים חשמליים',
                'icon' => 'bicycle',
//                'image_url' => '',
            ],
        ];

        $now = now();

        foreach ($drivingLicenseTypes as &$drivingLicenseType) {
            $drivingLicenseType += [
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DrivingLicenseType::insert($drivingLicenseTypes);
    }
}
