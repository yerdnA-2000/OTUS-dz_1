<?php

namespace Tests;

use App\QuadraticSolver;
use PHPUnit\Framework\TestCase;

class QuadraticSolverTest extends TestCase
{
    private QuadraticSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new QuadraticSolver();
    }

    public function testNoRoots(): void
    {
        self::assertEmpty($this->solver->solve(1, 0, 1));
    }

    public function testTwoRoots(): void
    {
        self::assertEquals([1, -1], $this->solver->solve(1, 0, -1));
    }

    public function testOneRootMultiplicityTwo(): void
    {
        self::assertEquals([-1], $this->solver->solve(1, 2, 1));
    }

    public function testCoefficientACannotBeZero(): void
    {
        self::expectException(\InvalidArgumentException::class);
        $this->solver->solve(0, 1, 1);
    }

    public function testOtherFloatValues(): void
    {
        foreach ([NAN, INF, -INF] as $value) {
            self::expectException(\InvalidArgumentException::class);
            $this->solver->solve($value, 1, 1);

            self::expectException(\InvalidArgumentException::class);
            $this->solver->solve(1, $value, 1);

            self::expectException(\InvalidArgumentException::class);
            $this->solver->solve(1, 1, $value);
        }
    }
}
