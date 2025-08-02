<?php

declare(strict_types=1);

use Cheesegrits\FilamentGoogleMaps\Controllers\FilamentGoogleMapAssets;

Route::get('cheesegrits/filament-google-maps/{file}', FilamentGoogleMapAssets::class);
