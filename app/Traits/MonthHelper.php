<?php

namespace App\Traits;

trait MonthHelper
{
    /**
     * Get array of months with Indonesian names mapped to numbers (1-12)
     */
    public function getIndonesianMonths(): array
    {
        return [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];
    }

    /**
     * Get month data with totals, ensuring all months are included
     */
    public function getMonthlyDataWithIndonesianNames(mixed $data): array
    {
        // Get Indonesian month names
        $labels = $this->getIndonesianMonths();

        // Ensure all months are included
        $data = collect(range(1, 12))->map(function ($label) use ($data) {
            $found = $data->firstWhere('label', $label);

            return $found ? $found->total : 0;
        });

        return [
            'labels' => collect($labels)->flatten()->toArray(),
            'data' => $data->toArray(),
        ];
    }
}
