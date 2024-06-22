<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Muzzaki;
use App\Models\TableMustahik;
use App\Models\Pengeluaran;
use App\Models\Pembagian;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Validator;

class DashboardLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Laporan::query();

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

        return view('pages.laporan', [
            "data" => $data
        ]);
    }
    public function api()
    {
        //
        $data = Laporan::all();
        return response()->json($data);
        
    }
    public function deleteapi(Request $request)
    {
        $laporan = Laporan::find($request->id);

        if ($laporan) {
            $laporan->delete();
            return response()->json(['status' => 'Berhasil dihapus']);
        } else {
            return response()->json(['status' => 'Laporan tidak ditemukan'], 404);
        }
    }

    public function getInfo()
    {
        //
        $muzzaki = Muzzaki::count();
        $pemasukan = Laporan::sum('jml_dana');
        $pembagian = Pembagian::sum('jml_dana');
        $mustahik = TableMustahik::count();
        $pengeluaran = Pengeluaran::sum('jml_dana') + $pembagian;
        $total = $pemasukan - $pengeluaran ;
        
        return response()->json([
            'Pemasukan' => $pemasukan,
            'Pengeluaran' => $pengeluaran,
            'Total' => $total,
            'Jumlah-Muzzaki' => $muzzaki,
            'Jumlah-Mustahik' => $mustahik,
        ]);
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $namamuz = Muzzaki::all();
        return view('pages.laporan.create',[
            "namamuz" => $namamuz
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validatedData = $request->validate([
            // 'muzzaki_id' => 'required|string|max:255',
            'kwitansi' => 'required|string|max:255',
            'nama_muz' => 'required|string|max:255',
            'jml_dana' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        // Buat objek baru dari model Laporan
        $laporan = new Laporan();
        // Set nilai atribut dari request
        $muzzaki = Muzzaki::where('nama', $request->nama_muz)->first();
        if ($muzzaki) {
            $laporan->muzzaki_id = $muzzaki->id;
            $laporan->nama_muz = $request->nama_muz;
            $request->merge(['muzzaki_id' => $muzzaki->id]);
        } else {
            // Handle ketika nama tidak ditemukan, misalnya dengan memberikan nilai default atau memberikan pesan kesalahan
            // Contoh:
            $laporan->muzzaki_id = null;
            // atau
            return response()->json(['error' => 'Nama muzzaki tidak ditemukan'], 404);
        }
        $laporan->kwitansi = $request->kwitansi;
        // $laporan->nama_muz = $request->nama_muz;
        $laporan->jml_dana = $request->jml_dana;
        $laporan->keterangan = $request->keterangan;
        $laporan->tanggal = $request->tanggal;

        // Simpan data ke dalam database
        $laporan->save();

        // Redirect ke halaman yang ditentukan setelah data disimpan
        return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil ditambahkan!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
        
        return view('pages.laporan.show',[
            'data'=>$laporan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        $namamuz = Muzzaki::all();
        // dd($laporan);
        return view('pages.laporan.edit',[
            'data'=>$laporan,
            'namamuz'=>$namamuz]);
    }

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Laporan $laporan)
{
    // Validasi data dari request
    $validateData = $request->validate([
        'kwitansi' => 'required|string|max:255',
        'nama_muz' => 'required|string|max:255',
        'jml_dana' => 'required|integer',
        'keterangan' => 'required|string|max:255',
        'tanggal' => 'required|date'
    ]);
    
    $muzzaki = Muzzaki::where('nama', $request->nama_muz)->first();
        if ($muzzaki) {
            $validateData = array_merge($validateData, ['muzzaki_id' => $muzzaki->id]);
        } else {
            // Handle ketika nama tidak ditemukan, misalnya dengan memberikan nilai default atau memberikan pesan kesalahan
            // Contoh:
            $validateData = array_merge($validateData, ['muzzaki_id' => null]);
            // atau
            return response()->json(['error' => 'Nama muzzaki tidak ditemukan'], 404);
        }
    $laporan->update($validateData);
    
    return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil diupdate!');
}
public function updateApi(Request $request, $id)
    {
        // Validasi data yang masuk
        $validator = Validator::make($request->all(), [
            'kwitansi' => 'required|string|max:255',
            'nama_muz' => 'required|string|max:255',
            'jml_dana' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date'
        ]);

        // Jika validasi gagal, kembalikan respon dengan error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cari data Laporan berdasarkan ID
        $laporan = Laporan::find($id);
        if (!$laporan) {
            return response()->json(['message' => 'Data Laporan tidak ditemukan'], 404);
        }

        // Cari Muzzaki berdasarkan nama
        $muzzaki = Muzzaki::where('nama', $request->nama_muz)->first();
        if ($muzzaki) {
            $request->merge(['muzzaki_id' => $muzzaki->id]);
        } else {
            $validator = array_merge($validator, ['muzzaki_id' => null]);
            // return response()->json(['error' => 'Nama Muzzaki tidak ditemukan'], 404);
        }

        // Update data Laporan dengan data yang telah divalidasi
        $laporan->update($request->all());

        // Kembalikan respon sukses
        return response()->json(['message' => 'Data Laporan berhasil diperbarui'], 200);
    }



/**
 * Remove the specified resource from storage.
 */
public function destroy(Laporan $laporan)
{
    // Hapus data dari database
    $laporan->delete();

    // Redirect ke halaman yang ditentukan setelah data dihapus
    return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil dihapus!');
}

    public function exportPdf()
    {
        $query = Laporan::query();

    if(request('search')) {
        $query->where(function($query) {
            $query->where('nama_muz', 'like', '%'. request('search') . '%')
                  ->orWhere('keterangan', 'like', '%'. request('search') . '%');
        });
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
    } elseif(request('bulan_awal') && request('bulan_akhir')) {
        $bulan_awal = request('bulan_awal');
        $bulan_akhir = request('bulan_akhir');
        $query->where(function ($query) use ($bulan_awal, $bulan_akhir) {
            $query->whereMonth('tanggal', '>=', $bulan_awal)
                  ->whereMonth('tanggal', '<=', $bulan_akhir);
        });
    } elseif(request('bulan_awal') && request('tahun')) {
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
    } elseif(request('bulan_awal')) {
        $bulan_awal = request('bulan_awal');
        $query->whereMonth('tanggal', $bulan_awal);
    } elseif(request('bulan_akhir')) {
        $bulan_akhir = request('bulan_akhir');
        $query->whereMonth('tanggal', $bulan_akhir);
    } elseif(request('tahun')) {
        $tahun = request('tahun');
        $query->whereYear('tanggal', $tahun);
    }
    $data = $query->get();
        
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $html = view('pages.laporan.print', compact('data'))->render(); // Sesuaikan dengan view Anda
        $pdf->loadHtml($html);
        

        // Render PDF
        $pdf->render();

        // Output PDF ke browser
        return $pdf->stream('laporan.pdf');

        // Untuk mendownload PDF secara langsung
        // return $pdf->download('document.pdf');
    }
    public function postapi(Request $request)
{
        // Validasi data yang diterima dari permintaan
        $validator = Validator::make($request->all(), [
            'muzzaki_id' => 'nullable|string|max:255',
            'kwitansi' => 'required|string|max:255',
            'nama_muz' => 'required|string|max:255',
            'jml_dana' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat objek baru dari model Laporan
        $laporan = new Laporan();

        // Set nilai atribut dari permintaan
        $laporan->muzzaki_id = $request->muzzaki_id;
        $laporan->kwitansi = $request->kwitansi;
        $laporan->nama_muz = $request->nama_muz;
        $laporan->jml_dana = $request->jml_dana;
        $laporan->keterangan = $request->keterangan;
        $laporan->tanggal = $request->tanggal;

        // Simpan data ke dalam database
        $laporan->save();

        // Mengembalikan respons dalam format JSON
        return response()->json(['message' => 'Data laporan berhasil ditambahkan'], 201);
    }
}
