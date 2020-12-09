<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiContoller extends Controller
{
    public function editnilai(Request $request, $id)
    {
    	$siswa = \App\Siswa::find($id);
    	$siswa->mapel()->updateExistingPivot($request->pk,['nilai' => $request->value]);
    }
}
