<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'fuelType' => [
        'gasoline', 'flex fuel', 'diesel', 'gas/electric hybrid', 'plug-in hybrid',
        'electric', 'natural gas', 'not applicable'
    ],
    'driveTrain' => [
        'fwd', 'rwd', 'awd', '4wd', '4x4', '4x2', 'other'
    ],
    'transmission' => [
        'automatic', 'manual', 'cvt', 'semi automatic', 'automatic 1 speed', 'automatic 2 speed'
        , 'automatic 3 speed', 'automatic 4 speed', 'automatic 5 speed', 'automatic 6 speed'
        , 'automatic 7 speed', 'automatic 8 speed', 'automatic 9 speed', 'manual 3 speed',
        'manual 4 speed', 'manual 5 speed', 'manual 6 speed', 'manual 7 speed', 'cvt 7 speed',
        'other', 'other 7 speed', 'a'
    ],
    'vehicleType' => [
        'Coupe', 'Sedan', 'SUV', 'Crossover', 'Pickup Truck', 'Hatchback', 'Convertible',
        'Minivan', 'Passenger Van', 'Conversion Van', 'Wagon', 'Motorcycles & Scooters',
        'Powersports', 'Boats & Watercraft', 'RVs & Campers', 'Camper Van', 'Hearse',
        'Kit Car', 'Limousine', 'Wheelchair Vans', 'Trailers', 'Chassis', 'Box Truck', 'Bus',
        'Cargo Van', 'Coach Bus', 'Day Cab', 'Dump Truck', 'Flatbed Truck', 'Heavy Duty Truck (Class 7-8)',
        'Medium Duty Truck (Class 4-6)', 'Sleeper Cab', 'Stepvan Truck', 'Utility-Service Truck',
        'Heavy-Construction Equipment', 'Farm Equipment', 'Aircraft', 'Parts & Accessories', 'Other'
    ],
    'categorySearch' => [
        'vehicleType' => 'vehicle type',
        'transmission' => 'transmission',
        'driveTrain' => 'drivetrain',
        'fuelType' => 'fuel type'
    ],
    'status' => [
        0 => 'deactivate',
        10 => 'activate'
    ],
    'offerStatus' => [
        0 => 'offer deactivate',
        10 => 'offer activate'
    ]
];
