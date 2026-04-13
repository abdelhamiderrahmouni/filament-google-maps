<?php

declare(strict_types=1);

namespace Cheesegrits\FilamentGoogleMaps\Tests\Database\Factories;

use Cheesegrits\FilamentGoogleMaps\Tests\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'lat'               => $this->faker->latitude(),
            'lng'               => $this->faker->longitude(),
            'street'            => $this->faker->streetName(),
            'city'              => $this->faker->city(),
            'state'             => $this->faker->word(),
            'zip'               => $this->faker->postcode(),
            'formatted_address' => $this->faker->address(),
            'processed'         => false,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
    }

    public function withRealAddressAndLatLng(string $country = 'united-states-of-america', ?string $city = null): self
    {
        $address = $this->fakeRealAddress($city);

        return $this->state([
            'lat'               => $address['lat'],
            'lng'               => $address['lng'],
            'street'            => $address['street'],
            'city'              => $address['city'],
            'state'             => $address['state'],
            'zip'               => $address['zip'],
            'formatted_address' => $address['formatted_address'],
        ]);
    }

    public function withRealLatLng(string $country = 'united-states-of-america', ?string $city = null): self
    {
        $address = $this->fakeRealAddress($city);

        return $this->state([
            'lat'               => $address['lat'],
            'lng'               => $address['lng'],
            'street'            => null,
            'city'              => null,
            'state'             => null,
            'zip'               => null,
            'formatted_address' => null,
        ]);
    }

    public function withRealAddress(string $country = 'united-states-of-america', ?string $city = null): self
    {
        $address = $this->fakeRealAddress($city);

        return $this->state([
            'lat'               => null,
            'lng'               => null,
            'street'            => $address['street'],
            'city'              => $address['city'],
            'state'             => $address['state'],
            'zip'               => $address['zip'],
            'formatted_address' => $address['formatted_address'],
        ]);
    }

    private function fakeRealAddress(?string $city = null): array
    {
        $known = [
            'New York, NY' => [
                'lat'               => 40.7128,
                'lng'               => -74.0060,
                'street'            => '350 5th Ave',
                'city'              => 'New York',
                'state'             => 'NY',
                'zip'               => '10118',
                'formatted_address' => '350 5th Ave, New York, NY 10118, USA',
            ],
            'Los Angeles, CA' => [
                'lat'               => 34.0522,
                'lng'               => -118.2437,
                'street'            => '111 S Grand Ave',
                'city'              => 'Los Angeles',
                'state'             => 'CA',
                'zip'               => '90012',
                'formatted_address' => '111 S Grand Ave, Los Angeles, CA 90012, USA',
            ],
            'San Francisco, CA' => [
                'lat'               => 37.7749,
                'lng'               => -122.4194,
                'street'            => '1 Dr Carlton B Goodlett Pl',
                'city'              => 'San Francisco',
                'state'             => 'CA',
                'zip'               => '94102',
                'formatted_address' => '1 Dr Carlton B Goodlett Pl, San Francisco, CA 94102, USA',
            ],
        ];

        return $known[$city] ?? $this->faker->randomElement(array_values($known));
    }
}
