<?php


return [


    'format' => env('COMPRESS_FORMAT', '.zip'),

    'formats' => [
        'zip' => '.zip',
        '7zip' => '.7z',
        'gz' => '.tar.gz'
    ]
];
