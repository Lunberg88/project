<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'Combat' => [
          'class' => 'common\components\Combat',
            'exp' => '10',
            'credits' => '0.5',
        ],
    ],
];
