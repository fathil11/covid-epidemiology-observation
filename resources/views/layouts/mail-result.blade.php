<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        body{
            background: white;
        }
        *{
            font-family: 'Times New Roman', Times, serif;
        }
        .text-justify{
            text-align: justify;
            text-justify: inter-word;
        }
        .text-center{
            text-align: center;
        }
        p{
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 1rem;
            margin-bottom: 0;
        }
        .mt-1{
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 0.5rem;
            margin-bottom: 0;
        }
        .indent{
            margin-left: 3em;
        }
    </style>
    <title>Surat Keterangan Hasil SWAB</title>
</head>
<body>
    <img src="img/kop_dinkes_melawi.png" width="100%" class="img-fluid" alt="">
    </div>
    <div style="padding-left: 5em; padding-right: 5em">
        <p class="text-center"><u><b>SURAT KETERANGAN</b></u></p>
        <p class="text-center">No: 443/{{ $id }}/DINKES-C19-A/2020</p>

        <p class="text-justify"><span class="indent">Berdasarkan hasil pemeriksaan sampel swab Real Time Polymerase Chain Reaction (RT-PCR) yang dilaksanakan di Pontianak, tanggal {{ $result_at }}. Berikut ini kami menerangkan bahwa:</p>

        <table style="margin-top: 1.5em;margin-bottom: 1.5em; padding-top: 0;">
            <tr>
                <td><p>Nama</p></td>
                <td><p style="margin-left: 1em;">:</p></td>
                <td><p style="margin-left: 0.4em;">{{ Str::title($name) }}</p></td>
            </tr>
            <tr>
                <td><p>Jenis Kelamin</p></td>
                <td><p style="margin-left: 1em;">:</p></td>
                <td><p style="margin-left: 0.4em;">{{ $gender }}</p></td>
            </tr>
            <tr>
                <td><p>Alamat</p></td>
                <td><p style="margin-left: 1em;">:</p></td>
                <td><p style="margin-left: 0.4em;">{{ Str::title($address) }}</p></td>
            </tr>
        </table>

        <p class="text-justify"><span class="indent">Dinyatakan <b>{{ Str::upper($result) }}</b> Covid-19. {{ $message }}</p>
        <p class="text-justify"><span class="indent">Demikian surat di buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

        <div style="float: right; padding-right:5em; margin-top: 5em;">
            <p class="text-center">Nanga Pinoh, {{ $mail_at }}</p>
            <p class="text-center mt-1">Kepala Dinas Kesehatan</p>
            <p class="text-center mt-1">Kabupaten Melawi</p>
            <img src="img/ttd_kadis_melawi.png" style="position: absolute; left: 15em;" width="40%" alt="">
            <p style="margin-top: 8em;" class="text-center"><b><u>dr. AHMAD JAWAHIR</u></b></p>
            <p class="text-center mt-1">Pembina Tk I</p>
            <p class="text-center mt-1">NIP 19680525 200012 1 005</p>
        </div>
    </div>

</body>
</html>
