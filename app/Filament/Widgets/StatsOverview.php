<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Sale;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = true;

    protected function getStats(): array
    {
         // Hitung jumlah produk terjual
         $totalProductsSold = Sale::sum('amount');

         // Hitung total penjualan
         $totalProduct = Product::count();
 
         // Hitung total pemasukan
         $totalRevenue = Sale::sum('income');
 
         $currentMonthProfit = Sale::whereMonth('created_at', now()->month)
         ->sum('income');
 
         
        $currentMonthSales = Sale::whereMonth('created_at', now()->month)
        ->sum('amount');

        $currentMonthProfit = Sale::whereMonth('created_at', now()->month)
        ->sum('income');

        $previousMonthProfit = Sale::whereMonth('created_at', now()->subMonth()->month)
        ->sum('income');

         
        return [
            Stat::make('Total Product', number_format($totalProduct)),
            Stat::make('Total Sales', number_format($totalProductsSold)),

            Stat::make('Total Income', 'Rp ' . number_format($totalRevenue)),
            
            Stat::make('This Month Sales', number_format($currentMonthSales)),
            Stat::make('This Month Income', number_format($currentMonthProfit)),
            Stat::make('Previous Month Income', 'Rp ' . number_format($previousMonthProfit)),

            
        ];
    }
}
