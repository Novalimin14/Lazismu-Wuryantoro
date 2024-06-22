<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan</title>
    <style>
        /* CSS umum */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .header-container img {
            width: 100px; /* Sesuaikan ukuran gambar sesuai kebutuhan */
            margin-right: 20px;
        }
        .header-container h2 {
            margin: 0;
            text-align: center
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            font-size: 10px; /* Ukuran font lebih kecil */
        }
        th {
            background-color: #f2f2f2;
        }

        /* CSS untuk cetak */
        @media print {
            body {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
            .print-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 297mm; /* Lebar halaman A4 dalam mode landscape */
                height: 210mm; /* Tinggi halaman A4 dalam mode landscape */
                transform: rotate(-90deg) translateX(-100%); /* Rotasi halaman ke landscape */
                transform-origin: top left; /* Mengatur titik rotasi */
                overflow-x: auto; /* Memungkinkan scroll horizontal jika terlalu lebar */
            }
            .print-container table {
                transform: rotate(90deg); /* Rotasi tabel balik ke vertikal */
                width: 100%; /* Lebar tabel saat diputar */
            }
            .print-container th, .print-container td {
                font-size: 8px; /* Ukuran font lebih kecil untuk cetak */
            }
        }
    </style>
</head>
@foreach($pembagians as $pembagian)
<body>
    <div class="print-container">
        <h3>Lampiran Tasharuf {{ $loop->iteration }}</h3>
        <h4> Tanggal : {{ $pembagian->tanggal }}</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mustahik</th>
                    <th>Alamat</th>
                    <th>Nomor KTP</th>
                    <th>Jenis Kelamin</th>
                    <th>Pekerjaan</th>
                    <th>Jenis Mustahik</th>
                    <th>Tipe Mustahik</th>
                    <th>Kartu Tanda Mahasiswa</th>
                    <th>Surat Prestasi</th>
                    <th>Surat Kelurahan (Usaha)</th>
                    <th>Surat Keterangan Tidak Mampu</th>
                    <th>Surat Pernyataan Kesanggupan</th>
                    <th>Gaji</th>
                    <th>Status (Keluarga) Mustahik</th>
                    <th>Keterangan</th>
                    
                    
                </tr>
            </thead>
            <tbody>
            
                @foreach($pembagian->mustahiks as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_mus }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->ktp }}</td>
                    <td>{{ $item->jkl }}</td>
                    <td>{{ $item->pekerjaan }}</td>
                    <td>{{ $item->jns_mus }}</td>
                    <td>{{ $item->tipe_mus }}</td>
                    <td>{{ $item->KTM }}</td>
                    <td>{{ $item->spres }}</td>
                    <td>{{ $item->Skel }}</td>
                    <td>{{ $item->Sktm }}</td>
                    <td>{{ $item->sprem }}</td>
                    <td>{{ $item->gaji }}</td>
                    <td>{{ $item->status_2 }}</td>
                    <td>{{ $item->keterangan }}</td>
                    
                    
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</body>
@endforeach
</html>
