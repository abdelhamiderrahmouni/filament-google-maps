<?php

declare(strict_types=1);

namespace Cheesegrits\FilamentGoogleMaps\Tests\Columns;

use Cheesegrits\FilamentGoogleMaps\Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return array_merge(parent::getPackageProviders($app), [
            ColumnsServiceProvider::class,
        ]);
    }
}
