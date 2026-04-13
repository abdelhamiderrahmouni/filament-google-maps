<?php

declare(strict_types=1);

namespace Cheesegrits\FilamentGoogleMaps\Tests\Fields\Fixtures\Resources\GeocompleteResource\Pages;

use Cheesegrits\FilamentGoogleMaps\Tests\Fields\Fixtures\Resources\GeocompleteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\MessageBag;

class ListGeocompletes extends ListRecords
{
    protected static string $resource = GeocompleteResource::class;

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
