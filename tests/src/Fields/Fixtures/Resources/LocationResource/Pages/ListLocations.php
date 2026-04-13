<?php

declare(strict_types=1);

namespace Cheesegrits\FilamentGoogleMaps\Tests\Fields\Fixtures\Resources\LocationResource\Pages;

use Cheesegrits\FilamentGoogleMaps\Tests\Fields\Fixtures\Resources\LocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\MessageBag;

class ListLocations extends ListRecords
{
    protected static string $resource = LocationResource::class;

    public function getErrorBag(): MessageBag
    {
        $errorBag = parent::getErrorBag();

        return $errorBag instanceof MessageBag ? $errorBag : new MessageBag((array) $errorBag);
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    //    protected function getTableFiltersFormWidth(): string
    //    {
    //        return '4xl';
    //    }
}
