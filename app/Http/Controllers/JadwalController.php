<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\JadwalPengambilan;
use App\Models\Muzzaki;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    //
    public function index()
    {
        $jadwals = Jadwal::with('jadwalpengambilans.muzzaki')->get();
        return response()->json($jadwals);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m',
        ]);
        // if (validator()->fails()) {
        //     return response()->json(validator()->errors(), 422);
        // }

        $bulan = $request->bulan;
        $deadline_bulan = Carbon::createFromFormat('Y-m', $bulan)->addMonths(2);

        $jadwal = Jadwal::create([
            'bulan' => $bulan,
            'deadline_bulan' => $deadline_bulan,
        ]);

        return response()->json($jadwal, 201);
    }

    public function addJadwalPengambilan($jadwal_id,$muzzaki_id)
    {
        // Validasi input
        // $validator = Validator::make($request->all(), [
        //     'muzzaki_id' => 'required|exists:muzzaki,id',
        // ]);

        // // Jika validasi gagal
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        // Jika validasi berhasil, buat JadwalPengambilan baru
        $JadwalPengambilan = JadwalPengambilan::create([
            'jadwal_id' => $jadwal_id,
            'muzzaki_id' => $muzzaki_id,
        ]);

        return response()->json($JadwalPengambilan, 201);
    }
    public function deleteapi(Request $request)
    {
        $id = $request->id;

    // Cari dan hapus semua JadwalPengambilan yang terkait dengan Jadwal yang akan dihapus
        $jadwalPengambilan = JadwalPengambilan::where('jadwal_id', $id)->get();
        foreach ($jadwalPengambilan as $jp) {
            $jp->delete();
        }

        // Setelah semua JadwalPengambilan terkait dihapus, baru hapus Jadwal
        $jadwal = Jadwal::find($id);
        if ($jadwal) {
            $jadwal->delete();
            return response()->json(['status' => 'Jadwal berhasil dihapus']);
        } else {
            return response()->json(['status' => 'Jadwal tidak ditemukan'], 404);
        }
    }

    public function show($id)
    {
        $jadwal = Jadwal::with('JadwalPengambilan.jadwal')->findOrFail($id);
        return response()->json($jadwal);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return response()->json(null, 204);
    }
    // Tambahkan di JadwalController

    public function getMustahiks($jadwal_id)
    {
        $jadwal = Jadwal::with('jadwalPengambilans.muzzaki')->findOrFail($jadwal_id);
        
        return response()->json($jadwal->jadwalPengambilans);
    }

    public function updateMustahikChecklist( $pengambilan_id)
    {
        // Temukan pengambilan berdasarkan ID
        $pengambilan = JadwalPengambilan::findOrFail($pengambilan_id);

        // Ubah nilai is_checked berdasarkan kondisi saat ini
        $pengambilan->update([
            'is_checked' => $pengambilan->is_checked == 1 ? 0 : 1,
        ]);
    
        // Return respons dengan data pengambilan yang sudah diupdate
        return response()->json($pengambilan); 
    }
    public function addJadwal($jadwal_id)
    {
        // Ambil jadwal terakhir
        $latestJadwal = Jadwal::find($jadwal_id);

        // Pastikan jadwal ditemukan
        if (!$latestJadwal) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak dapat menemukan jadwal yang tersedia.'
            ], 404);
        }

        // Ambil semua Muzzaki
        $muzzakis = Muzzaki::all();

        // Pastikan ada Muzzaki yang ditemukan
        if ($muzzakis->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada muzzaki yang tersedia.'
            ], 404);
        }

        // Buat JadwalPengambilan untuk setiap Muzzaki
        $createdRecords = [];
        foreach ($muzzakis as $muzzaki) {
            $JadwalPengambilan = JadwalPengambilan::create([
                'jadwal_id' => $jadwal_id,
                'muzzaki_id' => $muzzaki->id,
            ]);
            $createdRecords[] = $JadwalPengambilan;
        }

        return response()->json($createdRecords, 201);
    }


//     protected function schedule(Schedule $schedule)
//     {
//     $schedule->call(function () {
//         $jadwals = Jadwal::all();
//         foreach ($jadwals as $jadwal) {
//             if (Carbon::now()->greaterThan($jadwal->deadline_bulan)) {
//                 $newJadwal = Jadwal::create([
//                     'bulan' => Carbon::now()->format('Y-m'),
//                     'deadline_bulan' => Carbon::now()->addMonths(2),
//                 ]);

//                 foreach ($jadwal->pengambilans as $pengambilan) {
//                     Pengambilan::create([
//                         'jadwal_id' => $newJadwal->id,
//                         'muzzaki_id' => $pengambilan->muzzaki_id,
//                         'is_checked' => false,
//                     ]);
//                 }
//             }
//         }
//     })->daily();
// }

}
