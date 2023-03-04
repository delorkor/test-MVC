<?php
return [
    'GET' => [
          // API
        'api\/users\/([0-9]+)\/orders'=>'api/orders/orders/$1',
        'api\/users\/([0-9]+)' => 'api/users/view/$1',
        'api\/users' => 'api/users/index',
        // WEB
        'users\/([0-9]+)' => 'web/users/view/$1',
        'users' => 'web/users/index',
        '' => 'web/main/index',
    ],
    'POST' => [
        // API
        // 'api\/users\/([0-9]+)\/orders'=>'api/orders/orders/$1',
        // // 'users\/([0-9]+)' => 'api/users/view/$1'
        'api\/orders'=>'api/orders/create',
        'api\/users' => 'api/users/create',
    ],
    'PUT' => [

    ],
    'DELETE' => [
        'api\/users\/([0-9]+)' => 'api/users/delete/$1',
    ],
];