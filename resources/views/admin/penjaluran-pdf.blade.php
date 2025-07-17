<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hasil Penjaluran {{ $angkatan }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: center; }
        th { background-color: #eee; }
        h2 { margin-top: 30px; }
    </style>
</head>
<body>
    <section>
        <h1>Hasil Penjaluran Angkatan {{ $angkatan }}</h1>
        <div>
            <h2>Persebaran Peminatan</h2>
            <table>
                <thead class="">
                    <tr>
                        <th>Jalur</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                @php
                    $jalurList = ['J1','J2','J3','J4','J5','J6','J7','J8','J9'];
                @endphp

                <tbody>
                    @foreach($jalurList as $jalur)
                        <tr>
                            <td>{{ $jalur }}</td>
                            <td>{{ $jumlahPerJalur[$jalur] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (!empty($chartBase64))
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="{{ $chartBase64 }}" style="max-width: 400px;">
                </div>
            @endif
        </div>
    </section>
    <section>
        <h2>Hasil Penjaluran</h2>    
        @foreach ($hasilPenjalurans as $jalur => $list)
            <h3>Jalur {{ strtoupper($jalur) }}</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Skor Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $index => $mhs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ \App\Models\Mahasiswa::find($mhs->nim)?->nama ?? '-' }}</td>
                            <td>{{ number_format($mhs->skor_akhir, 2) }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        @endforeach
    </section>
</body>
</html>