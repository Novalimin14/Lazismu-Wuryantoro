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
    <h3>Data Muzzaki</h3>
    <table>
        <thead>
            <tr>
            <th>No
                  </th>  
                  <th>
                    Nama
                  </th>
                  <th>
                    Alamat
                  </th>
                  <th>
                    KTP
                  </th>
                  <th>
                    Jenis Kelamin
                  </th>
                  <th>
                    Pekerjaan
                  </th>
                  
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
            <td>
                    {{ $loop->iteration }}
                    </td>
                    <td>
                    {{ $item->nama }}
                    </td>
                    <td>
                    {{ $item->alamat }}
                    </td>
                    <td>
                    {{ $item->ktp }}
                    </td>
                    <td>
                    {{ $item->jkl }}
                    </td>
                    <td>
                    {{ $item->pekerjaan }}
                    </td>
                    
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>