<?php

namespace App\Http\Controllers;

use App\Models\JadwalPengambilan;
use App\Models\Muzzaki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\FrameDecorator\Table;
use Dompdf\Options;

class DashboardMuzzakiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = Muzzaki::query();

        if(request('search')) {
            $query->where('nama', 'like', '%'. request('search') . '%')
                ->orWhere('alamat', 'like', '%'. request('search') . '%');
        }
        $perPage = request('perPage', 10);
        $data = $query->paginate($perPage);
        return view('pages.muzzaki', [
            "data" => $data
        ]);
    }
    public function api()
    {
        //
        $data = Muzzaki::all();
        return response()->json($data);
        
    }
    public function deleteapi(Request $request)
    {
        $id = $request->id;

        // Hapus JadwalPengambilan berdasarkan muzzaki_id
        $jadwal = JadwalPengambilan::where('muzzaki_id', $id)->first();
        $laporan = Muzzaki::find($id);
        if ($jadwal) {
            $jadwal->delete();
            
            if ($laporan) {
                $laporan->delete();
                return response()->json(['status' => 'Muzzaki berhasil dihapus']);
            } else {
                return response()->json(['status' => 'Muzzaki tidak ditemukan'], 404);
            }
            return response()->json(['status' => 'Jadwal berhasil dihapus']);
        } else {
            
            if ($laporan) {
                $laporan->delete();
                return response()->json(['status' => 'Muzzaki berhasil dihapus']);
            } else {
                return response()->json(['status' => 'Muzzaki tidak ditemukan'], 404);
            }
            return response()->json(['status' => 'Jadwal tidak ditemukan',$jadwal], 404);
        }

        // Hapus Muzzaki berdasarkan ID
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.muzzaki.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ktp' => 'required|string|max:255',
            'jkl' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'linkmaps' => 'required|string|max:255',
        ]);

        // Buat objek baru dari model Muzzaki
        $mustahik = new Muzzaki();

        // Set nilai atribut dari request
        
        $mustahik->nama = $request->nama;
        $mustahik->alamat = $request->alamat;
        $mustahik->ktp = $request->ktp;
        $mustahik->jkl = $request->jkl;
        $mustahik->pekerjaan = $request->pekerjaan;
        $mustahik->linkmaps = $request->linkmaps;

        // Simpan data ke dalam database
        $mustahik->save();

        // Redirect ke halaman yang ditentukan setelah data disimpan
        return redirect()->route('muzzaki.index')->with('success', 'Data mustahik berhasil ditambahkan!');
    
    }
    public function postapi(Request $request)
    {
        $validatedData =Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ktp' => 'required|string|max:255',
            'jkl' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'linkmaps' => 'required|string|max:255',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }
        // Buat objek baru dari model Muzzaki
        $muzzaki = new Muzzaki();

        // Set nilai atribut dari request
        
        $muzzaki->nama = $request->nama;
        $muzzaki->alamat = $request->alamat;
        $muzzaki->ktp = $request->ktp;
        $muzzaki->jkl = $request->jkl;
        $muzzaki->pekerjaan = $request->pekerjaan;
        $muzzaki->linkmaps = $request->linkmaps;

        // Simpan data ke dalam database
        $muzzaki->save();

        // Redirect ke halaman yang ditentukan setelah data disimpan
        return response()->json(['message' => 'Data Muzzaki berhasil ditambahkan'], 201);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Muzzaki $muzzaki)
    {
        //
        return view('pages.muzzaki.show', [
            'data' => $muzzaki
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Muzzaki $muzzaki)
    {
        //
        // dd($muzzaki);
        return view('pages.muzzaki.edit', [
            'data' => $muzzaki
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Muzzaki $muzzaki)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ktp' => 'required|string|max:255',
            'jkl' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'linkmaps' => 'required|string|max:255',
        ]);

        // Buat objek baru dari model Muzzaki
        

        // Simpan data ke dalam database
        $muzzaki->update($validatedData);

        // Redirect ke halaman yang ditentukan setelah data disimpan
        return redirect()->route('muzzaki.index')->with('success', 'Data mustahik berhasil ditambahkan!');
    
    }
    public function updateApi(Request $request, $id)
    {
        // Validasi data yang masuk
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ktp' => 'required|string|max:255',
            'jkl' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'linkmaps' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan respon dengan error
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        // Cari data Muzzaki berdasarkan ID
        $muzzaki = Muzzaki::find($id);
        if (!$muzzaki) {
            return response()->json(['message' => 'Data Muzzaki tidak ditemukan'], 404);
        }

        // Update data Muzzaki dengan data yang divalidasi
        $muzzaki->update($validatedData->validated());

        // Kembalikan respon sukses
        return response()->json(['message' => 'Data Muzzaki berhasil diperbarui'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Muzzaki $muzzaki)
    {
        //
        $muzzaki->delete();

    // Redirect ke halaman yang ditentukan setelah data dihapus
        return redirect()->route('muzzaki.index')->with('success', 'Data muzzaki berhasil dihapus!');
    }
    public function exportPdf()
    {
        $data = Muzzaki::all(); // Ganti YourModel dengan model Anda
        $path = public_path(). '/assets/img/Lazismu.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataimg = file_get_contents($path);
        $image = 'data:image/'. $type . ';base64,' . base64_encode($dataimg);

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $html = view('pages.muzzaki.print', compact('data','image'))->render(); // Sesuaikan dengan view Anda
        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Output PDF ke browser
        return $pdf->stream('muzzaki.pdf');

        // Untuk mendownload PDF secara langsung
        // return $pdf->download('document.pdf');
    }
}
