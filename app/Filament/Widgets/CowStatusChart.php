<?php

namespace App\Filament\Widgets;

use App\Models\Cow;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use http\QueryString;

class CowStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Cows status';
    public ?string $filter = 'Normal';
    protected int | string | array $columnSpan=2;
    protected function getData(): array
    {
        $dataNormal = Trend::query(Cow::where('cow_status',1))
            ->between(
                start: now()->subMonth(),
                end: now(),
            )
            ->perDay()
            ->count('cow_status');
        $dataAbnormal = Trend::query(Cow::where('cow_status',0))
            ->between(
                start: now()->subMonth(),
                end: now(),
            )
            ->perDay()
            ->count('cow_status');


        return [
            'datasets' => [
                [
                    'label' => 'Normal Cows',
                    'data' => $dataNormal->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor'=>'#008585',
                    'pointBackgroundColor'=>'#008585',
                    'pointBorderColor'=>'#008585'
                ],
                [
                    'label' => 'Abnormal Cows',
                    'data' => $dataAbnormal->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor'=>'#f50538',
                    'pointBackgroundColor'=>'#f50538',
                    'pointBorderColor'=>'#f50538'
                ],

            ],
            'labels' => $dataNormal->map(fn (TrendValue $value) => $value->date),
        ];

    }


    protected function getType(): string
    {
        return 'line';
    }
}
