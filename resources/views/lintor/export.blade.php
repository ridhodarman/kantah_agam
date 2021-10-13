@extends('layouts.template')

@section('content')
    @php 
        $j=1; 
        $no=1; 
        $nagari = "";
        $total = 0;
        $lanjut = true;
        $jtotal = 0;
        $j=0;
    @endphp

    <table class="table table-bordered" border="1">
        <tr style="text-align: center; font-weight: bold;">
            <td rowspan="2">No</td>
            <td rowspan="2">No Berkas</td>
            <td rowspan="2">Proyek</td>
            <td rowspan="2">Nama Pemohon</td>
            <td rowspan="2">NIK</td>
            <td colspan="2">Risalah</td>
            <td colspan="2">Pengumuman</td>
            <td rowspan="2">NIB</td>
            <td rowspan="2">Luas</td>
            <td rowspan="2">Nagari</td>
    </tr>
    <tr style="text-align: center; font-weight: bold;">
        <td>Tanggal</td>
        <td>Nomor</td>
        <td>Tanggal</td>
        <td>Nomor</td>
    </tr>

    @foreach ($sql as $b)
        @php
            $nama_p="";
            $result = json_decode($b->nama_pemohon);
            if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($b->nama_pemohon);
            try {
                $nama_p = implode(", ", $array);
            } catch (Exception $e) {
                $nama_p = $b->nama_pemohon;
            }
            }
            else {
                $nama_p = $b->nama_pemohon;
            }
            $nik="";
            $result = json_decode($b->nik_pemohon);
            if (json_last_error() === JSON_ERROR_NONE) {
                $array = json_decode($b->nik_pemohon);
                try {
                    $nik = implode(", ", $array);
                    } catch (Exception $e) {
                    $nik = $lintor->nik_pemohon;
                    }
            }
        @endphp
        <tr>   
        <td>{{ $no }}</td>
        <td>'{{ $b->no_berkas }}</td>
        <td>
            Lintor
        </td>
        <td>{{ $nama_p }}</td>
        <td>'{{ $nik }}</td>
        <td>@if ($b->tanggal_ris) {{ date('d-m-Y', strtotime($b->tanggal_ris)) }} @endif</td>
        <td>'{{ $b->no_ris }}</td>
        <td>{{ date('d-m-Y', strtotime($b->tanggal_peng)) }}</td>
        <td>'{{ $b->no_peng }}</td>
        <td>{{ $b->nib }}</td>
        <td>{{ $b->luas }} M <sup>2</sup></td>
        <td>{{ $b->nagari }}</td>
    </tr>
    @php 
        $j=$j+1; 
        $no++;
    @endphp
    @endforeach
        </table>
        

        @php
        //header("Content-type: application/vnd-ms-excel");
        //header("Content-Disposition: attachment; filename=export.xls");
        @endphp
@endsection