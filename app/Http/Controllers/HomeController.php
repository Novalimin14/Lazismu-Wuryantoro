<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\TableMustahik;
use App\Models\Muzzaki;
use App\Models\Pengeluaran;
use App\Models\Pembagian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $muzzaki = Muzzaki::count();
        $laporan = Laporan::sum('jml_dana');
        $pembagian = Pembagian::sum('jml_dana');
        $mustahik = TableMustahik::count();
        $pengeluaran = Pengeluaran::sum('jml_dana') + $pembagian;
        $total = $laporan - $pengeluaran;

        // Mengambil data pemasukan per bulan
        $monthlyIncome = Laporan::selectRaw('MONTH(created_at) as month, SUM(jml_dana) as total')
                                ->whereYear('created_at', date('Y'))
                                ->groupBy('month')
                                ->pluck('total', 'month')->toArray();

        // Mengisi bulan yang tidak ada transaksi dengan 0
        $monthlyIncome = array_replace(array_fill(1, 12, 0), $monthlyIncome);

        return view('home', [
            'laporan' => $laporan,
            'pengeluaran' => $pengeluaran,
            'total' => $total,
            'muzzaki' => $muzzaki,
            'mustahik' => $mustahik,
            'monthlyIncome' => $monthlyIncome,
        ]);
    }

    
}
