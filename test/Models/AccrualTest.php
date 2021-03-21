<?php

namespace Earmark\Test\Models;

use wsbrendonballantyne\Earmark\Models\Accrual;

/**
 * @coversDefaultClass wsbrendonballantyne\EarMark\Models\Accrual
 */
class AccrualTest extends AbstractTest
{
    public function testData()
    {
        $test = new Accrual;
        $test->save();
        $this->assertTrue((Accrual::count() == 1));
    }

    /**
     * @covers wsbrendonballantyne\EarMark\Models\Accrual::probe()
     */
    public function testAccrualClass()
    {
        $this->assertTrue(Accrual::probe());
    }
}
