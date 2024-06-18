<!DOCTYPE html>
<html>
<head>
    <title>Data Laporan</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan Anda */
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
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <!-- <img src="{{ asset('assets/img/apple-icon.png') }}" alt="Logo Lazismu"> -->
        <div>
            <h2>LEMBAGA AMIL ZAKAT INFAQ DAN SHODAQOH (LAZIS)</h2>
            <h2>DAERAH WONOGIRI KANTOR LAYANAN KECAMATAN WURYANTORO</h2>
        </div>
        
    </div>
    <h3>Data Laporan</h3>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <!-- Looping data menggunakan Blade directives atau sesuai dengan framework yang Anda gunakan -->
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id_muz }}</td>
                <td>{{ $item->nama_muz }}</td>
                <td>{{ $item->jml_dana }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>