<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Range
    |--------------------------------------------------------------------------
    |
    |
    */

    'model' => wsbrendonballantyne\Earmark\Models\EarMark::class,

    'columns' => [
        'digit' => 'digit',
        'group' => 'prefix',
    ],

    'hold_model' => wsbrendonballantyne\Earmark\Models\Hold::class,
    'accrual' => wsbrendonballantyne\Earmark\Models\Accrual::class,

];
