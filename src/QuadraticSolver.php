<?php

namespace App;

class QuadraticSolver {

    /**
     * @return float[]
     */
    public function solve(float $a, float $b, float $c): array
    {
        $this->validateFloats($a, $b, $c);

        if ($a == 0) {
            throw new \InvalidArgumentException("Coefficient 'a' cannot be zero.");
        }

        $discriminant = $b * $b - 4 * $a * $c;

        if ($discriminant == 0) {
            return [-$b / (2 * $a)];
        }
        if ($discriminant > 0) {
            return [
                (-$b + sqrt($discriminant)) / (2 * $a),
                (-$b - sqrt($discriminant)) / (2 * $a),
            ];
        }

        return [];
    }

    private function validateFloats(...$values): void
    {
        foreach ($values as $value) {
            if (is_infinite($value) || is_nan($value)) {
                throw new \InvalidArgumentException("Coefficients are invalid.");
            }
        }
    }
}
