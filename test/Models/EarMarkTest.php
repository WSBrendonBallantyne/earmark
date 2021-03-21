<?php

namespace Earmark\Test\Models;

use wsbrendonballantyne\Earmark\Models\EarMark;

/**
 * @coversDefaultClass wsbrendonballantyne\EarMark\Models\EarMark
 */
class EarMarkTest extends AbstractTest
{
    /**
     * @covers wsbrendonballantyne\EarMark\Models\EarMark::probe()
     */
    public function testEarMarkClass()
    {
        $this->assertTrue(EarMark::probe());
    }

    public function testRefill()
    {
        $earmark = new \wsbrendonballantyne\Earmark\Http\Controllers\Serial;
        $data = $earmark->get();
        $earmark->get(30);
        $earmark->unset($data);
        $data = $earmark->get(30);
        $earmark->get(30);
        $earmark->unset($data);
        $earmark->increment();
        $this->assertEquals(30, count($earmark->get(30)));
    }
}
