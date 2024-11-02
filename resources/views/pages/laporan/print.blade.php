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
            align-items: flex-start;
            justify-content: center;
            padding: 20px 0;
        }
        .col {
            flex-direction: column;
        }
        .col img {
            width: 80px; /* Sesuaikan ukuran gambar */
            margin-right: 10px; /* Sesuaikan margin */
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
    <div class="col">
          
    <div class="">
        <div>
            <h4>LEMBAGA AMIL ZAKAT INFAQ DAN SHODAQOH (LAZIS)</h4>
            <h4>DAERAH WONOGIRI KANTOR LAYANAN KECAMATAN WURYANTORO</h4>
        </div>
        
    </div>
        

    </div>
    
    <h3>Data Laporan</h3>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah Dana</th>
                <th>Jumlah Beras</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalDana = 0;
                $totalBeras = 0;
            @endphp

            @foreach ($data as $item)
            @php
                $totalDana += $item->jml_dana;
                $totalBeras += $item->jml_beras;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_muz }}</td>
                <td>{{ $item->jml_dana ? 'Rp. ' . number_format($item->jml_dana, 0, ',', '.') : '' }}</td>
                <td>{{ $item->jml_beras ? $item->jml_beras . ' kg' : '' }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->tanggal }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2">Total</td>
            <td>{{ 'Rp. ' . number_format($totalDana, 0, ',', '.') }}</td>
            <td>{{ $totalBeras . ' kg' }}</td>
            <td colspan="2"></td>
        </tr>           
        </tfoot> 
    </table>
</body>
</html>
