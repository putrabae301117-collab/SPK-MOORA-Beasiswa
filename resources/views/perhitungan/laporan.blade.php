<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Perangkingan MOORA</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            margin: 30px;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        .meta {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
        }

        td {
            vertical-align: middle;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <h2>LAPORAN HASIL PERANGKINGAN</h2>
    <h3>METODE MOORA</h3>

    <div class="meta">
        <p>
            <strong>Periode:</strong> {{ $periode->nama_periode }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="80">Ranking</th>
                <th>Alternatif</th>
                <th width="150">Nilai Yi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanHasil as $h)
                <tr>
                    <td class="center">{{ $h->peringkat }}</td>
                    <td>{{ $h->alternatif->nama_alternatif }}</td>
                    <td class="center">{{ number_format($h->nilai_yi, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>
            <strong>Keterangan:</strong><br>
            Nilai Yi diperoleh dari selisih total kriteria
            <strong>Benefit (Max)</strong> dan <strong>Cost (Min)</strong>
            menggunakan metode
            <strong>MOORA (Multi-Objective Optimization on the basis of Ratio Analysis)</strong>.
            Alternatif dengan nilai Yi tertinggi merupakan alternatif terbaik.
        </p>
    </div>

    <br>

    <button onclick="window.print()" class="no-print">
        Cetak Laporan
    </button>

</body>

</html>
