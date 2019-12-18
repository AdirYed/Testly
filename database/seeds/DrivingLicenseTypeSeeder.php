<?php

use App\DrivingLicenseType;
use Illuminate\Database\Seeder;

class DrivingLicenseTypeSeeder extends Seeder
{
    public function run()
    {
        $drivingLicenseTypes = [
            [
                'code' => 'A2',
                'name' => 'אופנוע עד 125 סמ״ק',
            ],
            [
                'code' => 'A1',
                'name' => 'אופנוע עד 400 סמ״ק',
            ],
            [
                'code' => 'A',
                'name' => 'אופנוע',
            ],
            [
                'code' => 'B',
                'name' => 'רכב פרטי',
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
                'code' => 'D3',
                'name' => 'מיניבוס פרטי עד 5 טון',
            ],
            [
                'code' => 'D2',
                'name' => 'מיניבוס ציבורי עד 5 טון',
            ],
            [
                'code' => 'D1',
                'name' => 'מונית',
            ],
            [
                'code' => 'D',
                'name' => 'אוטובוס',
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
