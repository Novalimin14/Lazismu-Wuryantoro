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
<body>
    <div class="print-container">
        <div class="header-container">
            <div>
                <h2>LEMBAGA AMIL ZAKAT INFAQ DAN SHODAQOH (LAZIS)</h2>
                <h2>DAERAH WONOGIRI KANTOR LAYANAN KECAMATAN WURYANTORO</h2>
            </div>
        </div>
        <h3>Data Tasharuf</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tasharuf</th>
                    <th>Jumlah Dana</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Mustahik</th>
                    
                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach($pembagian as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pembagian }}</td>
                    <td>{{ $item->jml_dana }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td><ul>
                        @foreach($item->mustahiks as $mustahik)
                        <li>{{ $mustahik->nama_mus }}</li>
                        @endforeach
                    </ul></td>
                    
                    
                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
