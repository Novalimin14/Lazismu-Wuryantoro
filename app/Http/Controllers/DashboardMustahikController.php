<?php

namespace App\Http\Controllers;

use App\Models\TableMustahik;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\FrameDecorator\Table;
use Dompdf\Options;
use Illuminate\Support\Facades\Validator;

class DashboardMustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = TableMustahik::query();

        if(request('search')) {
            $query->where('nama_mus', 'like', '%'. request('search') . '%')
                ->orWhere('alamat', 'like', '%'. request('search') . '%');
        }

        $perPage = request('perPage', 10);
        $data = $query->paginate($perPage);
        return view('pages.table_Mustahik', [
            "data" => $data
        ]);
        
    }
    public function api()
    {
        //
        $data = TableMustahik::all();
        return response()->json($data);
        
    }
    public function deleteapi(Request $request)
    {
        $laporan = TableMustahik::find($request->id);

        if ($laporan) {
            $laporan->delete();
            return response()->json(['status' => 'Berhasil dihapus']);
        } else {
            return response()->json(['status' => 'Laporan tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.mustahik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'nama_mus' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ktp' => 'required|string|max:255',
            'jkl' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jns_mus' => 'required|string|max:255',
            'tipe_mus' => 'required|string|max:255',
            'KTM' => 'required|string|max:255',
            'spres' => 'required|string|max:255',
            'Skel' => 'required|string|max:255',
            'Sktm' => 'required|string|max:255',
            'sprem' => 'required|string',
            'gaji' => 'required|string|max:255',
            'status_2' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            // 'tanggal' => 'required|date',
            'link_maps' => 'nullable|string|max:255',
        ]);
        $mustahik = new TableMustahik();

// Set nilai atribut dari request
        $mustahik->nama_mus = $request->nama_mus;
        $mustahik->alamat = $request->alamat;
        $mustahik->ktp = $request->ktp;
        $mustahik->jkl = $request->jkl;
        $mustahik->pekerjaan = $request->pekerjaan;
        $mustahik->jns_mus = $request->jns_mus;
        $mustahik->tipe_mus = $request->tipe_mus;
        $mustahik->KTM = $request->KTM;
        $mustahik->spres = $request->spres;
        $mustahik->Skel = $request->Skel;
        $mustahik->Sktm = $request->Sktm;
        $mustahik->sprem = $request->sprem;
        $mustahik->gaji = $request->gaji;
        $mustahik->status_2 = $request->status_2;
        $mustahik->keterangan = $request->keterangan;
        // $mustahik->tanggal = $request->tanggal;
        $mustahik->link_maps = $request->link_maps;

        // Simpan data ke dalam database
        $mustahik->save();

        // Redirect ke halaman yang ditentukan setelah data disimpan
        return redirect()->route('table_mustahik.index')->with('success', 'Data mustahik berhasil ditambahkan!');
    
    }
    public function postapi(Request $request)
    {
        //
        // Validasi data yang dikirim
        $validatedData =Validator::make($request->all(),[
            'nama_mus' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'ktp' => 'required|string|max:255',
            'jkl' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jns_mus' => 'required|string|max:255',
            'tipe_mus' => 'required|string|max:255',
            'KTM' => 'required|string|max:255',
            'spres' => 'required|string|max:255',
            'Skel' => 'required|string|max:255',
            'Sktm' => 'required|string|max:255',
            'sprem' => 'required|string',
            'gaji' => 'required|string|max:255',
            'status_2' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            // 'tanggal' => 'required|date',
            'link_maps' => 'nullable|string|max:255',
        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }
        $mustahik = new TableMustahik();

// Set nilai atribut dari request
        $mustahik->nama_mus = $request->nama_mus;
        $mustahik->alamat = $request->alamat;
        $mustahik->ktp = $request->ktp;
        $mustahik->jkl = $request->jkl;
        $mustahik->pekerjaan = $request->pekerjaan;
        $mustahik->jns_mus = $request->jns_mus;
        $mustahik->tipe_mus = $request->tipe_mus;
        $mustahik->KTM = $request->KTM;
        $mustahik->spres = $request->spres;
        $mustahik->Skel = $request->Skel;
        $mustahik->Sktm = $request->Sktm;
        $mustahik->sprem = $request->sprem;
        $mustahik->gaji = $request->gaji;
        $mustahik->status_2 = $request->status_2;
        $mustahik->keterangan = $request->keterangan;
        // $mustahik->tanggal = $request->tanggal;
        $mustahik->link_maps = $request->link_maps;

        // Simpan data ke dalam database
        $mustahik->save();

        // Redirect ke halaman yang ditentukan setelah data disimpan
        return response()->json(['message' => 'Data Mustahik berhasil ditambahkan'], 201);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(TableMustahik $tableMustahik)
    {
        //
        return view('pages.mustahik.show', [
            'data' => $tableMustahik
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TableMustahik $tableMustahik)
    {
        //
        // dd($tableMustahik);
        return view('pages.mustahik.edit', [
            'data' => $tableMustahik
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TableMustahik $tableMustahik)
{
    $validatedData = $request->validate([
        'nama_mus' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'ktp' => 'required|string|max:255',
        'jkl' => 'required|string|max:255',
        'pekerjaan' => 'required|string|max:255',
        'jns_mus' => 'required|string|max:255',
        'tipe_mus' => 'required|string|max:255',
        'KTM' => 'required|string|max:255',
        'spres' => 'required|string|max:255',
        'Skel' => 'required|string|max:255',
        'Sktm' => 'required|string|max:255',
        'sprem' => 'required|string',
        'gaji' => 'required|string|max:255',
        'status_2' => 'required|string|max:255',
        'keterangan' => 'required|string|max:255',
        // 'tanggal' => 'required|date',
        'link_maps' => 'nullable|string|max:255',
    ]);
                                                                                       

    // Update nilai atribut dari request
    $tableMustahik->update($validatedData);

    // Redirect ke halaman yang ditentukan setelah data diupdate
    return redirect()->route('table_mustahik.index')->with('success', 'Data mustahik berhasil diupdate!');
}
public function updateApi(Request $request, $id)
{
    // Validasi data yang masuk
    $validatedData = Validator::make($request->all(), [
        'nama_mus' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'ktp' => 'required|string|max:255',
        'jkl' => 'required|string|max:255',
        'pekerjaan' => 'required|string|max:255',
        'jns_mus' => 'required|string|max:255',
        'tipe_mus' => 'required|string|max:255',
        'KTM' => 'required|string|max:255',
        'spres' => 'required|string|max:255',
        'Skel' => 'required|string|max:255',
        'Sktm' => 'required|string|max:255',
        'sprem' => 'required|string',
        'gaji' => 'required|string|max:255',
        'status_2' => 'required|string|max:255',
        'keterangan' => 'required|string|max:255',
        // 'tanggal' => 'required|date',
        'link_maps' => 'nullable|string|max:255',
    ]);

    // Jika validasi gagal, kembalikan respon dengan error
    if ($validatedData->fails()) {
        return response()->json($validatedData->errors(), 422);
    }

    // Cari data TableMustahik berdasarkan ID
    $tableMustahik = TableMustahik::find($id);
    if (!$tableMustahik) {
        return response()->json(['message' => 'Data Mustahik tidak ditemukan'], 404);
    }

    // Update data TableMustahik dengan data yang telah divalidasi
    $tableMustahik->update($validatedData->validated());

    // Kembalikan respon sukses
    return response()->json(['message' => 'Data Mustahik berhasil diperbarui'], 200);
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(TableMustahik $tableMustahik)
{
    // Hapus data dari database
    $tableMustahik->delete();

    // Redirect ke halaman yang ditentukan setelah data dihapus
    return redirect()->route('table_mustahik.index')->with('success', 'Data mustahik berhasil dihapus!');
}

    public function exportPdf()
    {
        $data = TableMustahik::all(); // Ganti YourModel dengan model Anda

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $html = view('pages.mustahik.print', compact('data'))->render(); // Sesuaikan dengan view Anda
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');

        // Render PDF
        $pdf->render();

        // Output PDF ke browser
        return $pdf->stream('mustahik.pdf');

        // Untuk mendownload PDF secara langsung
        // return $pdf->download('document.pdf');
    }
}

