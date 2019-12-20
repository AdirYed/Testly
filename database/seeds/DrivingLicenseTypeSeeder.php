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
                'name' => 'אופנוע',
            ],
            [
                'code' => 'C',
                'name' => 'רכב משא כבד',
            ],
            [
                'code' => 'C1',
                'name' => 'רכב משא קל',
            ],
            [
                'code' => 'D',
                'name' => 'רכב ציבורי',
            ],
            [
                'code' => '1',
                'name' => 'טרקטור',
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
