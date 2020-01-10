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
                'image_url' => 'assets/driving-licenses/B.jpg',
            ],
            [
                'code' => 'A',
                'name' => 'אופנוע',
                'icon' => 'motorcycle',
                'image_url' => 'assets/driving-licenses/A.jpg',
            ],
            [
                'code' => 'C',
                'name' => 'רכב משא כבד',
                'icon' => 'truck-moving',
                'image_url' => 'assets/driving-licenses/C.jpg',
            ],
            [
                'code' => 'C1',
                'name' => 'רכב משא קל',
                'icon' => 'truck',
                'image_url' => 'assets/driving-licenses/C1.jpg',
            ],
            [
                'code' => 'D',
                'name' => 'רכב ציבורי',
                'icon' => 'bus',
                'image_url' => 'assets/driving-licenses/D.jpg',
            ],
            [
                'code' => '1',
                'name' => 'טרקטור',
                'icon' => 'tractor',
                'image_url' => 'assets/driving-licenses/1.jpg',
            ],
            [
                'code' => 'A3',
                'name' => 'אופניים חשמליים',
                'icon' => 'bicycle',
                'image_url' => 'assets/driving-licenses/A3.jpg',
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
