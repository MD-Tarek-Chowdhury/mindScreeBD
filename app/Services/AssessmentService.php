<?php

namespace App\Services;

class AssessmentService
{
    protected array $map = [
        'depression' => [3, 5, 10, 13, 16, 17, 21],  // Original 1-indexed values
        'anxiety'    => [2, 4, 7, 9, 15, 19, 20],
        'stress'     => [1, 6, 8, 11, 12, 14, 18],
    ];

    public function calculateResults(array $answers): array
    {
        $results = [];

        foreach ($this->map as $category => $questionNumbers) {
            $score = 0;

            foreach ($questionNumbers as $questionNumber) {
                // Convert 1-indexed question number to 0-indexed array key
                $arrayIndex = $questionNumber - 1;
                $score += $answers[$arrayIndex] ?? 0;
            }

            $finalScore = $score * 2;

            $results[$category] = [
                'score' => $finalScore,
                'level' => $this->getSeverity($category, $finalScore)
            ];
        }

        return $results;
    }

    private function getSeverity(string $category, int $score): string
    {
        // Professional scales for DASS-21
        $scales = [
            'depression' => [9 => 'Normal', 13 => 'Mild', 20 => 'Moderate', 27 => 'Severe', 99 => 'Extremely Severe'],
            'anxiety'    => [7 => 'Normal', 9 => 'Mild', 14 => 'Moderate', 19 => 'Severe', 99 => 'Extremely Severe'],
            'stress'     => [14 => 'Normal', 18 => 'Mild', 25 => 'Moderate', 33 => 'Severe', 99 => 'Extremely Severe'],
        ];

        foreach ($scales[$category] as $threshold => $label) {
            if ($score <= $threshold) return $label;
        }
        return 'Extremely Severe';
    }
}
