<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = Pengeluaran::query();

        if(request('search')) {
            $query->where('nama_muz', 'like', '%'. request('search') . '%')
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

        return view('pages.pengeluaran', [
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'pengeluaran' => 'required|string|max:255',
            'jml_dana' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        // Buat objek baru dari model Laporan
        $pengeluaran = new Pengeluaran();

        // Set nilai atribut dari request
        $pengeluaran->pengeluaran = $request->pengeluaran;
        $pengeluaran->jml_dana = $request->jml_dana;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->tanggal = $request->tanggal;

        // Simpan data ke dalam database
        $pengeluaran->save();

        // Redirect ke halaman yang ditentukan setelah data disimpan
        return redirect()->route('pengeluaran.index')->with('success', 'Data laporan berhasil ditambahkan!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
        return view('pages.pengeluaran.show', compact('pengeluaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
        return view('pages.pengeluaran.edit', compact('pengeluaran'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        //
        $validatedData = $request->validate([
            'pengeluaran' => 'required|string|max:255',
            'jml_dana' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);
    
        // Update nilai atribut dari request
        $pengeluaran->pengeluaran = $request->pengeluaran;
        $pengeluaran->jml_dana = $request->jml_dana;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->tanggal = $request->tanggal;
    
        // Simpan perubahan ke dalam database
        $pengeluaran->save();
    
        // Redirect ke halaman yang ditentukan setelah data diupdate
        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diupdate!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        //  // Hapus data dari database
        $pengeluaran->delete();

        // Redirect ke halaman yang ditentukan setelah data dihapus
        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil dihapus!');

            
    }
    public function exportPdf()
    {
        $query = Pengeluaran::query();

        if(request('search')) {
            $query->where('nama_muz', 'like', '%'. request('search') . '%')
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
        } // Ganti YourModel dengan model Anda
        $data = $query->get();

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $html = view('pages.pengeluaran.print', compact('data'))->render(); // Sesuaikan dengan view Anda
        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Output PDF ke browser
        return $pdf->stream('pengeluaran.pdf');

        // Untuk mendownload PDF secara langsung
        // return $pdf->download('document.pdf');
    }
}
