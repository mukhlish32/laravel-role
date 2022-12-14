<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /* #region  Restrict Akses */
    public function __construct()
    {
        $this->middleware(['auth', 'role:1']);
    }
    /* #endregion */

    /* #region  Fitur Tambahan */
    private function getParameter()
    {
        $this->role = Role::getRoleAll();
    }

    private function getValidasi(Request $request, $id = NULL) //Untuk validasi data user
    {
        $request->validate([
            'txt_username' => 'required|unique:user,username,' . $id,
            'txt_email' => 'nullable|email|unique:user,email,' . $id,
            'cmb_role' => 'required',
        ], [
            'txt_username.required' => 'Username wajib diisi',
            'txt_username.unique' => 'Username ini sudah dipakai oleh user lain',
            'txt_email.email' => 'Email harus berupa alamat email yang valid',
            'txt_email.unique' => 'Email sudah dipakai oleh user lain',
            'cmb_role.required' => 'Role wajib diisi',
        ]);
    }

    private function getValidasi2(Request $request) //Untuk validasi ubah password
    {
        $request->validate([
            'txt_password1' => 'required',
            'txt_password2' => 'required|same:txt_password1'
        ], [
            'txt_password1.required' => 'Password wajib diisi',
            'txt_password2.required' => 'Password konfirmasi wajib diisi',
            'txt_password2.same' => 'Password konfirmasi harus sama dengan password diatas'
        ]);
    }

    /* #endregion */

    /* #region  Fitur Tampil Data */
    public function index()
    {
        $dataUser = User::getDataUserWithRole();
        return view('user.index', ['dataUser' => $dataUser]);
    }
    /* #endregion */

    /* #region  Fitur Tambah Data */
    public function create()
    {
        $this->getParameter();
        $role = $this->role;

        return view(
            'user.create',
            compact('role')
        );
    }

    public function store(Request $request)
    {
        switch ($request->input('btnAction')) {
            case 1: //Fitur Button Simpan
                $this->getValidasi($request);
                try {
                    $this->insertUser($request);
                } catch (Exception $err) {
                    return redirect(route('user.create'))
                        ->with('msgbox', 'Terjadi masalah. Data gagal disimpan: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('user.index'))
                    ->with('msgbox', 'Data user berhasil disimpan')
                    ->with('typebox', 'alert-success');
                break;
            case 2: //Fitur Button Back
                return redirect(route('role.index'));
                break;
        }
    }

    private function insertUser(Request $request)
    {
        User::create([
            'username' => $request->txt_username,
            'email' => $request->txt_email,
            'password' => Hash::make('1234'),
            'role_id' => $request->cmb_role
        ]);
    }

    /* #endregion */

    /* #region  Fitur Ubah Data */
    public function edit($id)
    {
        $this->getParameter();
        $role = $this->role;

        $dataUser = User::getDataUserById($id);
        return view('user.edit', [
            'data' => $dataUser
        ], compact('role'));
    }

    public function update(Request $request, $id)
    {
        switch ($request->input('btnAction')) {
            case 0: //Fitur Button Back
                return redirect(route('user.index'));
                break;
            case 1: //Fitur Button Simpan Data User
                $this->getValidasi($request, $id);
                try {
                    $this->updateUser($request, $id);
                } catch (Exception $err) {
                    return redirect(route('user.edit', $id))
                        ->with('msgbox', 'Terjadi masalah. Data gagal disimpan: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('user.index'))
                    ->with('msgbox', 'Data berhasil disimpan')
                    ->with('typebox', 'alert-success');
                break;
            case 2:
                $this->getValidasi2($request, $id);
                try {
                    $this->updatePasswordUser($request, $id);
                } catch (Exception $err) {
                    return redirect(route('user.edit', $id))
                        ->with('msgbox', 'Terjadi masalah. Password gagal diubah: ' . $err->getMessage())
                        ->with('typebox', 'alert-warning');
                }
                return redirect(route('user.index'))
                    ->with('msgbox', 'Password berhasil diubah')
                    ->with('typebox', 'alert-success');
                break;
        }
    }

    private function updateUser(Request $request, $id)
    {

        User::getDataUserById($id)->update([
            'username' => $request->txt_username,
            'email' => $request->txt_email,
            'role_id' => $request->cmb_role
        ]);
    }

    private function updatePasswordUser(Request $request, $id)
    {

        User::getDataUserById($id)->update([
            'password' => Hash::make($request->txt_password1)
        ]);
    }
    /* #endregion */

    /* #region  Fitur Hapus Data */
    public function destroy($id)
    {
        try {
            User::destroy($id);
        } catch (Exception $err) {
            return redirect(route('user.index'))
                ->with('msgbox', 'Terjadi masalah. Data gagal dihapus: ' . $err->getMessage())
                ->with('typebox', 'alert-warning');
        }
        return redirect(route('user.index'))
            ->with('msgbox', 'Data berhasil dihapus')
            ->with('typebox', 'alert-danger');
    }
    /* #endregion */
}
