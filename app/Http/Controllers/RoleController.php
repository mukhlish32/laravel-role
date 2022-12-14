<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Akses;

use App\Http\Controllers\Controller;
use App\Models\Fitur;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /* #region  Restrict Akses */
    public function __construct()
    {
        $this->middleware(['auth', 'role:1,2']);
    }
    /* #endregion */

    /* #region  Fitur Tambahan */
    private function getValidasi(Request $request)
    {
        $request->validate([
            'txt_role' => 'required'
        ], [
            'txt_role.required' => 'Role wajib diisi',
        ]);
    }
    /* #endregion */
    
    /* #region  Fitur Tampil Data */
    public function index()
    {
        $dataRole = Role::getRoleAll();
        return view('role.index', ['dataRole' => $dataRole]);
    }
    /* #endregion */

    /* #region  Fitur Tambah Data */
    public function create()
    {
        return view(
            'role.create'
        );
    }

    public function store(Request $request)
    {
        switch ($request->input('btnAction')) {
            case 1: //Fitur Button Simpan
                $this->getValidasi($request);
                try {
                    $this->insertRole($request);
                } catch (Exception $err) {
                    return redirect(route('role.create'))
                        ->with('msgbox', 'Terjadi masalah. Data gagal disimpan: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('role.index'))
                    ->with('msgbox', 'Data role berhasil disimpan')
                    ->with('typebox', 'alert-success');
                break;
            case 2: //Fitur Button Back
                return redirect(route('role.index'));
                break;
        }
    }

    private function insertRole(Request $request)
    {
        $role = Role::create([
                    'role' => $request->txt_role,
                    'deskripsi' => $request->txt_deskripsi
                ]);
        
        $role_id = $role->id;
        
        //Menambah akses baca dari data yang dicreate sendiri (own)
        Akses::create([
            'role_id' => $role_id,
            'akses' => 'read',
            'semua' => '0' //1: All, 0: Own, Tidak ada data:No
        ]);
    }

    /* #endregion */

    /* #region  Fitur Ubah Data */
    public function edit($id)
    {   
        $akses = Akses::getAksesById($id);
        $dataRole = Role::getDataRoleById($id);
        $fitur = Fitur::all();
        return view('role.edit', [
            'data'  => $dataRole
            // 'akses' => $akses,
        ],compact('fitur','akses'));
    }

    public function update(Request $request, $id)
    {
        switch ($request->input('btnAction')) {
            case 0: //Fitur Button Back
                return redirect(route('role.index'));
                break;
            case 1: //Fitur Button Simpan
                $this->getValidasi($request);
                try {
                    $this->updateRole($request, $id);
                } catch (Exception $err) {
                    return redirect(route('role.edit', $id))
                        ->with('msgbox', 'Terjadi masalah. Data gagal diubah: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('role.index'))
                    ->with('msgbox', 'Data role berhasil diubah')
                    ->with('typebox', 'alert-success');
                break;
            case 2: //Fitur Button Back
                try {
                    $this->updateAkses($request, $id);
                } catch (Exception $err) {
                    return redirect(route('role.edit', $id))
                        ->with('msgbox', 'Terjadi masalah. Data gagal diubah: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('role.index'))
                    ->with('msgbox', 'Data hak akses role berhasil diubah')
                    ->with('typebox', 'alert-success');
                break;
        }
    }

    private function updateRole(Request $request, $id)
    {
        
        Role::getDataRoleById($id)->update([
            'role' => $request->txt_role,
            'deskripsi' => $request->txt_deskripsi,
        ]);
    }

    private function updateAkses(Request $request, $id)
    {
        $cekAkses = $request->get('chk_akses');
        foreach ($cekAkses as $fitur=>$i) {
            if ($i == '0') {
                $this->hapusAkses($id, $fitur);
            } else {
                $this->hapusAkses($id, $fitur);
                $this->refreshAkses($request, $id, $fitur);
            }
        }
    }

    private function refreshAkses(Request $request, $id, $fitur)
    {
        $akses = DB::table('akses')
            ->select('akses')
            ->where('role_id', '=', $id)
            ->where('akses', '=', $fitur)
            ->first();
        $semua_id = $request->chk_all[$fitur];
        if (empty($akses)) {
            DB::insert('INSERT INTO akses (role_id, akses, semua) VALUES (?, ?, ?)', [$id, $fitur, $semua_id]);
        }
    }

    private function hapusAkses($id, $fitur)
    {
        DB::delete('DELETE FROM akses WHERE role_id = ? AND akses = ?', [$id, $fitur]);
    }
    /* #endregion */

    /* #region  Fitur Hapus Data */
    public function destroy($id)
    {
        try {
            Role::destroy($id);
            DB::delete('DELETE FROM akses WHERE role_id = ?', [$id]);
        } catch (Exception $err) {
            return redirect(route('role.index'))
                ->with('msgbox', 'Terjadi masalah. Data gagal dihapus: ' . $err->getMessage())
                ->with('typebox', 'alert-warning');
        }
        return redirect(route('role.index'))
            ->with('msgbox', 'Data berhasil dihapus')
            ->with('typebox', 'alert-danger');
    }
    /* #endregion */
}
