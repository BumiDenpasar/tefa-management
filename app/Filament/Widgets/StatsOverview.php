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
         $totalProductsSold = Sale::sum('jumlah');

         // Hitung total penjualan
         $totalProduct = Product::count();
 
         // Hitung total pemasukan
         $totalRevenue = Sale::sum('pemasukan');
 
         $previousMonthSales = Sale::whereMonth('created_at', now()->subMonth()->month)
         ->sum('jumlah');
         
        $currentMonthSales = Sale::whereMonth('created_at', now()->month)
        ->sum('jumlah');

        $currentMonthProfit = Sale::whereMonth('created_at', now()->month)
        ->sum('pemasukan');

        $previousMonthProfit = Sale::whereMonth('created_at', now()->subMonth()->month)
        ->sum('pemasukan');

        $profitGrowth = $previousMonthProfit > 0 ? (($currentMonthProfit - $previousMonthProfit) / $previousMonthProfit) * 100 : 100;
        
        $salesGrowth = $previousMonthSales > 0 ? (($currentMonthSales - $previousMonthSales) / $previousMonthSales) * 100 : 100;

         
        return [
            Stat::make('Total Produk', number_format($totalProduct)),
            Stat::make('Total Produk Terjual', number_format($totalProductsSold))
            ->description($salesGrowth.'% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color($salesGrowth > 0 ? "success" : "danger"),

            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalRevenue))
            ->description($profitGrowth.'% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color($salesGrowth > 0 ? "success" : "danger"),
            
            Stat::make('Produk Terjual Bulan Ini', number_format($currentMonthSales)),
            Stat::make('Produk Terjual Bulan Lalu', number_format($previousMonthSales)),
            Stat::make('Pemasukan Bulan Lalu', 'Rp ' . number_format($previousMonthProfit)),

            
        ];
    }
}
