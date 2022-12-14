<?php

namespace App\Http\Controllers;

use App\Models\KategoriBiaya;
use App\Models\Akses;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriBiayaController extends Controller
{

    /* #region  Restrict Akses */
    public function __construct()
    {
        // $this->middleware(['auth', 'role:1'],  ['only' => ['destroy']]);
    }

    /* #endregion */
    
    /* #region  Fitur Tambahan */
    private function getValidasi(Request $request)
    {
        $request->validate([
            'txt_nama_kategori_biaya' => 'required'
        ], [
            'txt_nama_kategori_biaya.required' => 'Nama Kategori Biaya wajib diisi',
        ]);
    }
    /* #endregion */

    /* #region  Fitur Tampil Data */
    public function index()
    {
        // if(Session::get('akses_id')==1){
        //     $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaAll();
        // }else{
        //     $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaByUserId(Auth::user()->id);
        // }
        
        //Akses Data sesuai User-nya
        // if(Session::get('akses_id')!=1){
        $periksaAkses = Akses::getAksesByIdAndAkses(Auth::user()->role_id,'read');
        if($periksaAkses == false) {
            $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaByUserId('');
        }else if($periksaAkses->semua != '1'){
            $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaByUserId(Auth::user()->id);
        }else{
            $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaAll();
        }
        // }else{
        //     $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaAll();
        // }
        return view('kategori_biaya.index', ['dataKategoriBiaya' => $dataKategoriBiaya]);
    }
    /* #endregion */

    /* #region  Fitur Tambah Data */
    public function create()
    {
        //Akses Data sesuai User-nya
        // if(Session::get('akses_id')!=1){
        $periksaAkses = Akses::getAksesByIdAndAkses(Auth::user()->role_id,'create');
        if($periksaAkses == false) {
            return redirect(route('kategori-biaya.index'))
                ->with('msgbox', 'Anda tidak memiliki hak akses pada fitur tambah')
                ->with('typebox', 'alert-warning');
        }
        // }

        return view(
            'kategori_biaya.create'
        );
    }

    public function store(Request $request)
    {
        switch ($request->input('btnAction')) {
            case 1: //Fitur Button Simpan
                $this->getValidasi($request);
                try {
                    $this->insertKategoriBiaya($request);
                } catch (Exception $err) {
                    return redirect(route('kategori-biaya.create'))
                        ->with('msgbox', 'Terjadi masalah. Data gagal disimpan: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('kategori-biaya.index'))
                    ->with('msgbox', 'Data kategori biaya berhasil disimpan')
                    ->with('typebox', 'alert-success');
                break;
            case 2: //Fitur Button Back
                return redirect(route('kategori-biaya.index'));
                break;
        }
    }

    private function insertKategoriBiaya(Request $request)
    {
        KategoriBiaya::create([
            'nama' => $request->txt_nama_kategori_biaya,
            'deskripsi' => $request->txt_deskripsi,
            'user_id' => Auth::user()->id
        ]);
    }

    /* #endregion */

    /* #region  Fitur Ubah Data */
    public function edit($id)
    {   
        $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaById($id);

        //Akses Data sesuai User-nya
        // if(Session::get('akses_id')!=1){
        $periksaAkses = Akses::getAksesByIdAndAkses(Auth::user()->role_id,'update');
        if($periksaAkses == false) {
            return redirect(route('kategori-biaya.index'))
                ->with('msgbox', 'Anda tidak memiliki hak akses pada fitur ubah')
                ->with('typebox', 'alert-warning');
        }

        if($periksaAkses->semua != '1'){
            $periksaUser = $dataKategoriBiaya->isUser(Auth::user());
            if($periksaUser == false) {
                return redirect(route('kategori-biaya.index'))
                    ->with('msgbox', 'Anda tidak memiliki hak akses pada fitur ubah yang bukan dari user anda')
                    ->with('typebox', 'alert-warning');
            }
        }
        // }

        return view('kategori_biaya.edit', [
            'data' => $dataKategoriBiaya
        ]);
    }

    public function update(Request $request, $id)
    {
        switch ($request->input('btnAction')) {
            case 1: //Fitur Button Simpan
                $this->getValidasi($request);
                try {
                    $this->updateKategoriBiaya($request, $id);
                } catch (Exception $err) {
                    return redirect(route('kategori-biaya.edit', $id))
                        ->with('msgbox', 'Terjadi masalah. Data gagal diubah: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('kategori-biaya.index'))
                    ->with('msgbox', 'Data Kategori Biaya berhasil diubah')
                    ->with('typebox', 'alert-success');
                break;
            case 2: //Fitur Button Back
                return redirect(route('kategori-biaya.index'));
                break;
        }
    }

    private function updateKategoriBiaya(Request $request, $id)
    {
        KategoriBiaya::getKategoriBiayaById($id)->update([
            'nama' => $request->txt_nama_kategori_biaya,
            'deskripsi' => $request->txt_deskripsi,
        ]);
    }
    /* #endregion */

    /* #region  Fitur Hapus Data */
    public function destroy($id)
    {
        $dataKategoriBiaya = KategoriBiaya::getKategoriBiayaById($id);
        //Akses Data sesuai User-nya
        $periksaAkses = Akses::getAksesByIdAndAkses(Auth::user()->role_id,'delete');
        if($periksaAkses == false) {
            return redirect(route('kategori-biaya.index'))
                ->with('msgbox', 'Anda tidak memiliki hak akses pada fitur hapus')
                ->with('typebox', 'alert-warning');
        }

        if($periksaAkses->semua != '1'){
            $periksaUser = $dataKategoriBiaya->isUser(Auth::user());
            if($periksaUser == false) {
                return redirect(route('kategori-biaya.index'))
                ->with('msgbox', 'Anda tidak memiliki hak akses pada fitur hapus yang bukan dari user anda')
                ->with('typebox', 'alert-warning');
            };
        }

        try {
            KategoriBiaya::destroy($id);
        } catch (Exception $err) {
            return redirect(route('kategori-biaya.index'))
                ->with('msgbox', 'Terjadi masalah. Data gagal dihapus: ' . $err->getMessage())
                ->with('typebox', 'alert-warning');
        }
        return redirect(route('kategori-biaya.index'))
            ->with('msgbox', 'Data berhasil dihapus')
            ->with('typebox', 'alert-danger');
    }
    /* #endregion */
}
