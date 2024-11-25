<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Dosen;
use App\Models\DosenWali;
use App\Models\Mahasiswa;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New User',User::Count())
                ->description('New User that have joined')
                ->descriptionIcon('heroicon-m-user-group',IconPosition::Before)
                ->descriptionColor('success'),
            Stat::make('Dosen',Dosen::Count())
                ->description('New Dosen that have joined')
                ->descriptionIcon('heroicon-m-user-group',IconPosition::Before)
                ->descriptionColor('info'),
            Stat::make('DosenWali',DosenWali::Count())
                ->description('New DosenWali that have joined')
                ->descriptionIcon('heroicon-m-user-group',IconPosition::Before)
                ->descriptionColor('warning'),
            Stat::make('Mahasiswa',Mahasiswa::Count())
                ->description('New Mahasiswa that have joined')
                ->descriptionIcon('heroicon-m-user-group',IconPosition::Before)
                ->descriptionColor('gray'),
        ];
    }
}
