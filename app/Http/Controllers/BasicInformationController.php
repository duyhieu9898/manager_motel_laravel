<?php

namespace App\Http\Controllers;

use App\BasicInformation;

class BasicInformationController extends Controller
{
    public function __invoke() {
        return BasicInformation::first();
    }
}
