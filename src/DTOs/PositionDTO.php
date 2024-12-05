<?php

namespace Cheesegrits\FilamentGoogleMaps\DTOs;

class PositionDTO {
    public float $lat;
    public float $lng;
    public int $precision;

    /**
     * @throws \Exception
     */
    public function __construct(float|string $lat, float|string $lng, int $precision = 8)
    {
        $this->precision = $precision;

        $this->lat = $this->parseMeasurement($lat, $precision);
        $this->lng = $this->parseMeasurement($lng, $precision);
    }

    /**
     * A string representation of the object
     * @return string
     */
    public function __toString(): string
    {
        return $this->lat . ',' . $this->lng;
    }

    /**
     * An array representation of the object
     * @return array
     */
    public function toArray(): array
    {
        return [
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }

    /**
     * A json representation of the object
     * @return string
     * @throws \JsonException
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }


    /**
     * @throws \Exception
     */
    private function parseMeasurement(float|string $measurement, int|null $precision = null): float
    {
        if (is_string($measurement)) {
            $measurement = (float) $measurement;
        }

        if (!is_float($measurement)) {
            throw new \Exception('Invalid data provided to create PositionDTO: latitude and longitude must be float or a string containing a float');
        }

        if (!$precision)
            return $measurement;

        return round($measurement, $precision);
    }
}
