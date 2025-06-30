<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8f9fa;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
            margin-top: 24px;
            margin-bottom: 10px;
        }
        .header img {
            height: 60px;
            width: 60px;
            object-fit: contain;
        }
        .header .header-title {
            font-size: 22px;
            font-weight: bold;
            text-align: left;
            color: #2a3d66;
        }
        .subtitle {
            text-align: center;
            font-size: 14px;
            margin-bottom: 18px;
            color: #555;
        }
        .info {
            margin: 0 auto 18px auto;
            font-size: 14px;
            width: 80%;
            background: #e9ecef;
            border-radius: 8px;
            padding: 10px 18px;
        }
        table {
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 20px; 
            background: #fff;
            box-shadow: 0 2px 8px #e0e0e0;
        }
        th, td {
            border: 1px solid #b0b0b0;
            padding: 6px 8px;;
            font-size: 13px;
        }
        th {
            background: #2a3d66;
            color: #fff;
        }
        .section {
            font-weight: bold;
            background: #f1f3f7;
            color: #2a3d66;
            width: 120px;
        }
        .img-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .img-row img {
            max-width: 220px;
            max-height: 140px;
            width: auto;
            height: auto;
            object-fit: contain;
            border: 1px solid #aaa;
            background: #fff;
            margin: 4px 0;
        }
        .img-row span {
            color: #c00;
            font-size: 12px;
            font-style: italic;
        }
        @media print {
            body { background: #fff; }
            .info, table { box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('BizLand/Logo_Silaga.png') }}" alt="Logo SILAGA">
        <div class="header-title">Sistem Lapor Warga (SILAGA)<br>Kampung Fatmawati</div>
    </div>
    <div class="subtitle">Jl. RS. Fatmawati<br>Telp: (088899991111)</div>
    <div class="info">
        <strong>Periode Laporan:</strong> {{ $periode }}<br>
        <strong>Jenis Laporan:</strong> {{ $jenis }}
    </div>
    <table>
        <tr>
            <th>Kode Report</th>
            <th>Nama</th>
            <th>Judul</th>
            <th>Status</th>
        </tr>
        @foreach($data as $r)
        <tr>
            <td>{{ $r['kode'] }}</td>
            <td>{{ $r['nama'] }}</td>
            <td>{{ $r['judul'] }}</td>
            <td>{{ $r['status'] }}</td>
        </tr>
        <tr>
            <td class="section">Deskripsi</td>
            <td colspan="3">{{ $r['deskripsi'] }}</td>
        </tr>
        <tr>
            <td class="section">Alamat</td>
            <td colspan="3">{{ $r['alamat'] }}</td>
        </tr>
        <tr>
            <td class="section">Dokumentasi</td>
            <td colspan="3" style="min-height: 160px; vertical-align: top; padding: 15px;">
                <div class="img-row" style="min-height: 150px; overflow: hidden; align-items: flex-start;">
                  @foreach($r['images'] as $img)
                    @if(file_exists($img))
                        <img src="file://{{ $img }}" alt="foto laporan">
                    @else
                        <span>foto tidak ditemukan</span>
                    @endif
                  @endforeach
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
