<?php

use App\Http\Controllers\AdminHomeController;
use Illuminate\Support\Facades\Route;


route::get('', [AdminHomeController::class, 'index']);
