<?php
use App\Siswa;
use App\Guru;

function ranking5Besar()
{
	$siswa = Siswa::all();
    	$siswa->map(function($s){
    		$s->RataRataNilai = $s->RataRataNilai();
    		return $s;
    	});
    	$siswa = $siswa->sortByDesc('RataRataNilai')->take(5);
    	return $siswa;
}

function totalSiswa()
{
	return Siswa::count();
}

function totalGuru()
{
	return Guru::count();
}