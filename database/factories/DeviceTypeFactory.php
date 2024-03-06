<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DeviceType;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeviceType>
 */
class DeviceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DeviceType::class;
    public function definition(): array
    {
        $deviceTipe = ["Router", "Computer", "Firewall", "Acces Point"];
        foreach ($deviceTipe as $key => $value) {
            # code...
            return [
                //
                'type_name' => $value,
            ];
        }
    }
}
