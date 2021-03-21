<?php

namespace Earmark\Test\Models;

use wsbrendonballantyne\Earmark\Models\Hold;

/**
 * @coversDefaultClass wsbrendonballantyne\EarMark\Models\Hold
 */
class HoldTest extends AbstractTest
{
    /**
     * @covers wsbrendonballantyne\EarMark\Models\Hold::probe()
     */
    public function testHoldClass()
    {
        $this->assertTrue(Hold::probe());
    }

    /** @test */
    public function commandTest()
    {
        $this->artisan('earmark:config')
            ->expectsOutput('EarMark installed successfully.')
            ->assertExitCode(0);
    }
}
