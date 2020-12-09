<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Siswa;

class SiswaController extends Controller


{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_siswa = \App\Siswa::where('nama_depan','LIKE','%' .$request->cari. '%')->paginate(20);
        }else{
        $data_siswa = \App\Siswa::all();
    }
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {
        
        //Insert ke table Users
       $user = new \App\User;
       $user->role ='siswa';
       $user->name = $request->nama_depan;
       $user->email = $request->email;
       $user->password = bcrypt('rahasia');
       $user->remember_token = Str::random(60);
       $user->save();

        //Insert ke table Siswa
        $request->request->add(['user_id' => $user->id ]);
        $siswa = \App\Siswa::create($request->all());
         if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
    	return redirect('/siswa')->with('sukses','Data Berhasil Diinput');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa/edit',['siswa' => $siswa]);
    }

    public function update(Request $request,Siswa $siswa)
    {
        $siswa->update($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data Berhasil Diupdate');
    }

    public function delete(Siswa $siswa)
    {
       $siswa->delete($siswa);
       return redirect('/siswa')->with('sukses','Data Berhasil Dihapus');
    }

    public function profile(Siswa $siswa)
    {
        $matapelajaran = \App\Mapel::all();

        // Menyiapkan Data Untuk Chart
        $categories = [];
        $data = [];

        foreach ($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
            $categories[] = $mp->nama;
            $data[] = $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
        }
    }
        return view('siswa.profile',['siswa' => $siswa, 'matapelajaran' => $matapelajaran,'categories' => $categories,'data' => $data]);
    }

    public function addnilai(Request $request,$idsiswa)
    {
        $siswa = \App\Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/' .$idsiswa. '/profile')->with('error','Data Mata Perlajaran Sudah Ada');
        }
        
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);
            return redirect('siswa/' .$idsiswa. '/profile')->with('sukses','Data Nilai Berhasil');

    }


    public function deletenilai($idsiswa, $idmapel)
    {
       $siswa = \App\Siswa::find($idsiswa);
       $siswa->mapel()->detach($idmapel);
       return redirect()->back()->with('sukses','berhasil dihapus');
    }

    
    public function exportExcel() 
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function exportPdf() 
    {
        $siswa = \App\Siswa::all();
        $pdf = PDF::loadView('export.siswapdf',['siswa' => $siswa]);
        return $pdf->download('siswa.pdf');
    }

    public function getdatasiswa()
    {
        $siswa = Siswa::select('siswa.*');

        return \DataTables::eloquent($siswa)
        ->addColumn('nama_lengkap',function($s){
            return $s->nama_depan.' '.$s->nama_belakang;
        })
        ->addColumn('rata_rata_nilai',function($s){
            return $s->RataRataNilai();
        })
        ->addColumn('aksi',function($s){
            return '<a href="/siswa/'.$s->id.'/profile/" class="btn btn-warning">profil</a>';
        })
        ->rawColumns(['nama_lengkap','rata_rata_nilai','aksi'])
        ->toJson();
    }

    public function profilsaya()
    {
        $siswa = auth()->user()->siswa;
        return view('siswa.profilsaya',compact(['siswa']));
    }

    public function profilupdate(Request $request,Siswa $siswa)
    {
        $siswa->update($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/profilsaya')->with('sukses','Data Berhasil Diupdate');
    }
}