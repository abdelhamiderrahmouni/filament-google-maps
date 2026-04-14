<?php

declare(strict_types=1);

namespace Cheesegrits\FilamentGoogleMaps\Helpers;

class FieldHelper
{
    public static function getTopComponent($component)
    {
        $parentComponent = $component->getContainer()->getParentComponent();

        return $parentComponent ? static::getTopComponent($parentComponent) : $component;
    }

    public static function getFlatFields($topComponent): array
    {
        $flatFields = $topComponent->getContainer()->getFlatFields();

        foreach ($topComponent->getContainer()->getComponents() as $component) {
            foreach ($component->getChildComponentContainers() as $container) {
                if ($container->isHidden()) {
                    continue;
                }

                $flatFields = array_merge($flatFields, $container->getFlatFields());
            }
        }

        return $flatFields;
    }

    public static function getFieldId(string $field, $component): ?string
    {
        $topComponent = self::getTopComponent($component);
        $flatFields   = static::getFlatFields($topComponent);

        if (array_key_exists($field, $flatFields)) {
            return $flatFields[$field]->getId();
        }

        return null;
    }
}
