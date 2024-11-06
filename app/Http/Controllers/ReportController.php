<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Menampilkan income semua waktu
    public function index(){
        $schools = School::orderBy('id', 'asc')->get();

        // Iterasi setiap sekolah untuk menghitung total income
        $schools->map(function ($school) {
            $school->total_income = Sale::whereHas('product', function ($query) use ($school) {
                $query->where('school_id', $school->id);
            })->sum('income');

            return $school;
        });

        // Urutkan berdasarkan total income dari terbesar ke terkecil
        $schools = $schools->sortByDesc('total_income');

        $time = Carbon::now();

        return view('school_report', ['schools' => $schools, 'time' => $time]);
    }

    // Menampilkan income minggu ini
    public function weeklyReport(){
        $schools = School::orderBy('id', 'asc')->get();

        $schools->map(function ($school) {
            $school->total_income = Sale::whereHas('product', function ($query) use ($school) {
                $query->where('school_id', $school->id);
            })->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
              ->sum('income');

            return $school;
        });

        $schools = $schools->sortByDesc('total_income');
        $time = Carbon::now();

        return view('school_weekly_report', ['schools' => $schools, 'time' => $time]);
    }

    // Menampilkan income bulan ini
    public function monthlyReport(){
        $schools = School::orderBy('id', 'asc')->get();

        $schools->map(function ($school) {
            $school->total_income = Sale::whereHas('product', function ($query) use ($school) {
                $query->where('school_id', $school->id);
            })->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
              ->sum('income');

            return $school;
        });

        $schools = $schools->sortByDesc('total_income');
        $time = Carbon::now();

        return view('school_monthly_report', ['schools' => $schools, 'time' => $time]);
    }

    // Menampilkan income tahun ini
    public function yearlyReport(){
        $schools = School::orderBy('id', 'asc')->get();

        $schools->map(function ($school) {
            $school->total_income = Sale::whereHas('product', function ($query) use ($school) {
                $query->where('school_id', $school->id);
            })->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
              ->sum('income');

            return $school;
        });

        $schools = $schools->sortByDesc('total_income');
        $time = Carbon::now();

        return view('school_yearly_report', ['schools' => $schools, 'time' => $time]);
    }
}
