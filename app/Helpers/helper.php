<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

function getArticlePreview($htmlString)
{
    // Strip HTML tags
    $plainText = strip_tags($htmlString);

    // Limit to 100 characters
    return Str::limit($plainText, 100);
}

function waktu($timestamps): string
{
    $dt = Carbon::parse($timestamps);

    return $dt->format('H:i');
}

function bulan($month): string
{
    if ($month == 1) {
        $bulan = 'januari';
    } elseif ($month == 2) {
        $bulan = 'februari';
    } elseif ($month == 3) {
        $bulan = 'maret';
    } elseif ($month == 4) {
        $bulan = 'april';
    } elseif ($month == 5) {
        $bulan = 'mei';
    } elseif ($month == 6) {
        $bulan = 'juni';
    } elseif ($month == 7) {
        $bulan = 'juli';
    } elseif ($month == 8) {
        $bulan = 'agustus';
    } elseif ($month == 9) {
        $bulan = 'september';
    } elseif ($month == 10) {
        $bulan = 'oktober';
    } elseif ($month == 11) {
        $bulan = 'november';
    } elseif ($month == 12) {
        $bulan = 'desember';
    }

    return $bulan;
}

function tanggal($timestamps, $isCarbon = false, $tampilkan_hari = true, $tampilkan_waktu = false, $hanyaHari = false): string
{
    if ($isCarbon) {
        $dt = $timestamps;
    } else {
        $dt = Carbon::parse($timestamps);
    }
    $dayOfWeek = $dt->dayOfWeek;
    $day = $dt->day;
    $month = $dt->month;
    $year = $dt->year;

    if ($dayOfWeek == 1) {
        $dayOfWeek = 'Senin';
    } elseif ($dayOfWeek == 2) {
        $dayOfWeek = 'Selasa';
    } elseif ($dayOfWeek == 3) {
        $dayOfWeek = 'Rabu';
    } elseif ($dayOfWeek == 4) {
        $dayOfWeek = 'Kamis';
    } elseif ($dayOfWeek == 5) {
        $dayOfWeek = 'Jumat';
    } elseif ($dayOfWeek == 6) {
        $dayOfWeek = 'Sabtu';
    } else {
        $dayOfWeek = 'Minggu';
    }

    if ($hanyaHari) {
        return $dayOfWeek;
    }

    if (! $tampilkan_hari) {
        $dayOfWeek = '';
    }

    $bulan = ucwords(bulan($month));

    $waktu = $dt->format('H:i:s');

    if ($tampilkan_waktu) {
        $tanggal = "$dayOfWeek $day $bulan $year $waktu";
    } else {
        $tanggal = "$dayOfWeek $day $bulan $year";
    }

    return $tanggal;
}

function rupiah($angka, $tampilkanRupiah = true)
{
    $hasil_rupiah = number_format($angka, 2, ',', '.');

    return $tampilkanRupiah ? 'Rp.'.$hasil_rupiah : $hasil_rupiah;
}
