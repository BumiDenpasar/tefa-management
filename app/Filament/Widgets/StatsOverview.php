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
 
         $previousMonthSales = Sale::whereMonth('created_at', now()->subMonth()->month)
         ->sum('amount');
         
        $currentMonthSales = Sale::whereMonth('created_at', now()->month)
        ->sum('amount');

        $currentMonthProfit = Sale::whereMonth('created_at', now()->month)
        ->sum('income');

        $previousMonthProfit = Sale::whereMonth('created_at', now()->subMonth()->month)
        ->sum('income');

        $profitGrowth = $previousMonthProfit > 0 ? (($currentMonthProfit - $previousMonthProfit) / $previousMonthProfit) * 100 : 100;
        
        $salesGrowth = $previousMonthSales > 0 ? (($currentMonthSales - $previousMonthSales) / $previousMonthSales) * 100 : 100;

         
        return [
            Stat::make('Total Product', number_format($totalProduct)),
            Stat::make('Total Sales', number_format($totalProductsSold))
            ->description($salesGrowth.'% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color($salesGrowth > 0 ? "success" : "danger"),

            Stat::make('Total Income', 'Rp ' . number_format($totalRevenue))
            ->description($profitGrowth.'% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color($salesGrowth > 0 ? "success" : "danger"),
            
            Stat::make('This Month Sales', number_format($currentMonthSales)),
            Stat::make('Previous Month Sales', number_format($previousMonthSales)),
            Stat::make('Previous Month Income', 'Rp ' . number_format($previousMonthProfit)),

            
        ];
    }
}
