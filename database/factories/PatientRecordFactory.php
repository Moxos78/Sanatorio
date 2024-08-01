<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientRecord>
 */
class PatientRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description_case' => $this->faker->sentence,
            'consultation_date' => $this->faker->date,
            'reconsultation_date' => $this->faker->date,
            'repose_schedules' => $this->faker->time,
            'operation_date' => $this->faker->optional()->dateTime,
            'repose_days' => json_encode($this->faker->randomElements(['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'], 2)),
            'recommendations' => $this->faker->text(255), // Limitar a 255 caracteres
            'patient_state' => $this->faker->randomElement(['Estable', 'Grave estable', 'Grave inestable', 'Extrema gravedad']),
            'patient_id' => Patient::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
