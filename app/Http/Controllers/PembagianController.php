<?php

namespace App\Http\Controllers;

use App\Models\Pembagian;
use App\Models\TableMustahik;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\FrameDecorator\Table;
use Dompdf\Options;

class PembagianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = Pembagian::query();

        if(request('search')) {
            $query->where('pembagian', 'like', '%'. request('search') . '%')
                ->orWhere('keterangan', 'like', '%'. request('search') . '%');
        }

        if(request('bulan_awal') && request('bulan_akhir') && request('tahun')) {
            $bulan_awal = request('bulan_awal');
            $bulan_akhir = request('bulan_akhir');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_awal, $bulan_akhir, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', '>=', $bulan_awal)
                    ->whereMonth('tanggal', '<=', $bulan_akhir);
            });
        }elseif(request('bulan_awal') && request('bulan_akhir')) {
            $bulan_awal = request('bulan_awal');
            $bulan_akhir = request('bulan_akhir');
            $query->where(function ($query) use ($bulan_awal, $bulan_akhir) {
                $query->whereMonth('tanggal', '>=', $bulan_awal)
                ->whereMonth('tanggal', '<=', $bulan_akhir);
                    
            });
        } 
        elseif(request('bulan_awal') && request('tahun')) {
            $bulan_awal = request('bulan_awal');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_awal, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan_awal);
            });
        } elseif(request('bulan_akhir') && request('tahun')) {
            $bulan_akhir = request('bulan_akhir');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_akhir, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan_akhir);
            });
        } 
        elseif(request('bulan_awal')) {
            $bulan_awal = request('bulan_awal');
            $query->whereMonth('tanggal', $bulan_awal);
        }
        elseif(request('bulan_akhir')) {
            $bulan_akhir = request('bulan_akhir');
            $query->whereMonth('tanggal', $bulan_akhir);
        }elseif(request('tahun')) {
            $tahun = request('tahun');
            $query->whereYear('tanggal', $tahun);
        }

        // Gunakan paginate() untuk mendapatkan objek pagination
        $perPage = request('perPage', 10);
        $data = $query->paginate($perPage);

        return view('pages.pembagian.index', [
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  
        $mustahiks = TableMustahik::all();
        return view('pages.pembagian.create', compact('mustahiks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request  ,Pembagian $pembagian)
    {
        //
        $pembagian = Pembagian::create($request->only(['pembagian', 'jml_dana', 'keterangan', 'tanggal']));
        $pembagian->mustahiks()->sync($request->input('mustahik', []));
        return redirect()->route('pembagian.index')->with('success', 'Data pembagian berhasil ditambahkan');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembagian $pembagian)
    {
        //
        return view('pages.pembagian.show', compact('pembagian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembagian $pembagian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembagian $pembagian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembagian $pembagian)
    {
        //
        $pembagian->delete();

    // Redirect ke halaman yang ditentukan setelah data dihapus
        return redirect()->route('pembagian.index')->with('success', 'Data pembagian berhasil dihapus!');
    }
    public function exportPdf()
    {
        $query = Pembagian::query();

        if(request('search')) {
            $query->where('pembagian', 'like', '%'. request('search') . '%')
                ->orWhere('keterangan', 'like', '%'. request('search') . '%');
        }

        if(request('bulan_awal') && request('bulan_akhir') && request('tahun')) {
            $bulan_awal = request('bulan_awal');
            $bulan_akhir = request('bulan_akhir');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_awal, $bulan_akhir, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', '>=', $bulan_awal)
                    ->whereMonth('tanggal', '<=', $bulan_akhir);
            });
        }elseif(request('bulan_awal') && request('bulan_akhir')) {
            $bulan_awal = request('bulan_awal');
            $bulan_akhir = request('bulan_akhir');
            $query->where(function ($query) use ($bulan_awal, $bulan_akhir) {
                $query->whereMonth('tanggal', '>=', $bulan_awal)
                ->whereMonth('tanggal', '<=', $bulan_akhir);
                    
            });
        } 
        elseif(request('bulan_awal') && request('tahun')) {
            $bulan_awal = request('bulan_awal');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_awal, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan_awal);
            });
        } elseif(request('bulan_akhir') && request('tahun')) {
            $bulan_akhir = request('bulan_akhir');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_akhir, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan_akhir);
            });
        } 
        elseif(request('bulan_awal')) {
            $bulan_awal = request('bulan_awal');
            $query->whereMonth('tanggal', $bulan_awal);
        }
        elseif(request('bulan_akhir')) {
            $bulan_akhir = request('bulan_akhir');
            $query->whereMonth('tanggal', $bulan_akhir);
        }elseif(request('tahun')) {
            $tahun = request('tahun');
            $query->whereYear('tanggal', $tahun);
        }
        $pembagian = $query->get(); // 
        

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $html = view('pages.pembagian.print', compact('pembagian'))->render(); // Sesuaikan dengan view Anda
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');

        // Render PDF
        $pdf->render();

        // Output PDF ke browser
        return $pdf->stream('pembagian.pdf');

        // Untuk mendownload PDF secara langsung
        // return $pdf->download('document.pdf');
    }
    public function exportLampiran()
    {
        $query = Pembagian::query();

        if(request('search')) {
            $query->where('pembagian', 'like', '%'. request('search') . '%')
                ->orWhere('keterangan', 'like', '%'. request('search') . '%');
        }

        if(request('bulan_awal') && request('bulan_akhir') && request('tahun')) {
            $bulan_awal = request('bulan_awal');
            $bulan_akhir = request('bulan_akhir');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_awal, $bulan_akhir, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', '>=', $bulan_awal)
                    ->whereMonth('tanggal', '<=', $bulan_akhir);
            });
        }elseif(request('bulan_awal') && request('bulan_akhir')) {
            $bulan_awal = request('bulan_awal');
            $bulan_akhir = request('bulan_akhir');
            $query->where(function ($query) use ($bulan_awal, $bulan_akhir) {
                $query->whereMonth('tanggal', '>=', $bulan_awal)
                ->whereMonth('tanggal', '<=', $bulan_akhir);
                    
            });
        } 
        elseif(request('bulan_awal') && request('tahun')) {
            $bulan_awal = request('bulan_awal');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_awal, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan_awal);
            });
        } elseif(request('bulan_akhir') && request('tahun')) {
            $bulan_akhir = request('bulan_akhir');
            $tahun = request('tahun');
            $query->where(function ($query) use ($bulan_akhir, $tahun) {
                $query->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan_akhir);
            });
        } 
        elseif(request('bulan_awal')) {
            $bulan_awal = request('bulan_awal');
            $query->whereMonth('tanggal', $bulan_awal);
        }
        elseif(request('bulan_akhir')) {
            $bulan_akhir = request('bulan_akhir');
            $query->whereMonth('tanggal', $bulan_akhir);
        }elseif(request('tahun')) {
            $tahun = request('tahun');
            $query->whereYear('tanggal', $tahun);
        }
        $pembagians = $query->get(); // 
        

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $html = view('pages.pembagian.printlampiran', compact('pembagians'))->render(); // Sesuaikan dengan view Anda
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');

        // Render PDF
        $pdf->render();

        // Output PDF ke browser
        return $pdf->stream('pembagian-lampiran.pdf');

        // Untuk mendownload PDF secara langsung
        // return $pdf->download('document.pdf');
    }
}
