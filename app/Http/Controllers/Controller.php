<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OAT;

#[OAT\Info(
    version: '1.0.0',
    description: 'Laradevs API Documentation',
    title: 'Laradevs API'
)]

#[OAT\Tag(
    name: 'Developers',
    description: 'API Endpoints of Developers'
)]
abstract class Controller
{
    //
}
