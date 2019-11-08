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
            ],
            [
                'code' => 'A',
                'name' => 'רכב אופנוע',
            ],
            [
                'code' => '1',
                'name' => 'רכב טרקטור',
            ],
            [
                'code' => 'C1',
                'name' => 'רכב משא קל',
            ],
            [
                'code' => 'C',
                'name' => 'רכב משא כבד',
            ],
            [
                'code' => 'D',
                'name' => 'רכב ציבורי',
            ],
            [
                'code' => 'A3',
                'name' => 'אופניים חשמליים',
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
