<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\DetailUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class User77Controller extends Controller
{
    public function loginView77()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function registerView77()
    {
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    public function userView77()
    {
        return view('user.index', [
            'title' => 'Profile',
        ]);
    }

    public function adminView77()
    {
        return view('admin.index', [
            'title' => 'Dashboard',
        ]);
    }

    public function agamaView77()
    {
        $agamas = Agama::all();
        return view('admin.agama', [
            'title' => 'Agama',
            'agamas' => $agamas,
        ]);
    }

    public function lupaPasswordView77()
    {
        return view('auth.lupaPassword', [
            'title' => 'Lupa Password',
        ]);
    }

    public function lupaPassword77(Request $request)
    {
        $password = $request->password;
        $password_confirmation = $request->cpassword;

        if ($password != $password_confirmation) {
            return Redirect::back()->with('error', 'Password tidak sama');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($password);

        if ($user->save()) {
            return Redirect::back()->with('success', 'Password berhasil diubah');
        } else {
            return Redirect::back()->with('error', 'Password gagal diubah');
        }
    }

    public function tambahAgama77(Request $request)
    {
        $request->validate([
            'nama_agama' => 'required',
        ]);

        Agama::create([
            'nama_agama' => $request->nama_agama,
        ]);

        return Redirect::back()->with('success', 'Agama berhasil ditambahkan');
    }

    public function hapusAgama77(Request $req)
    {
        Agama::destroy($req->id);
        return Redirect::back()->with('success', 'Agama berhasil dihapus');
    }

    public function updateAgama77(Request $request, $id)
    {
        $request->validate([
            'nama_agama' => 'required',
        ]);

        Agama::where('id', $id)->update([
            'nama_agama' => $request->nama_agama,
        ]);

        $agamas = Agama::all();

        return view('admin.agama', [
            'title' => 'Agama',
            'agamas' => $agamas,
        ]);;
    }

    public function setIsAktif77(Request $req, $id)
    {
        $user = User::find($id);
        $user->is_aktif = !$user->is_aktif;
        $user->save();

        $users = User::all();

        $req->session()->put('users', $users);
        return Redirect::back();
    }

    public function detailUser77($id)
    {
        $user = User::find($id);
        $detailUser = DetailUser::where('user_id', '=', $id)->first();

        return view('admin.detailUser', [
            'title' => 'Detail User',
            'user' => $user,
            'detailUser' => $detailUser,
        ]);
    }

    public function updateData77(Request $request)
    {
        $user = User::find($request->id);
        $detailUser = DetailUser::where('user_id', '=', $request->id)->first();

        // upload foto ktp
        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $foto_ktp = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = public_path('img');
            $file->move($tujuan_upload, $foto_ktp);

            $request->foto_ktp = $foto_ktp;
        } else {
            $request->foto_ktp = $detailUser->foto_ktp;
        }

        // upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $foto = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = public_path('img');
            $file->move($tujuan_upload, $foto);

            $request->foto = $foto;
        } else {
            $request->foto = $user->foto;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'foto' => $request->foto,
        ]);
        $detailUser->update([
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama_id' => $request->agama_id,
            'foto_ktp' => $request->foto_ktp,
            'umur' => $request -> umur,
        ]);

        $request->session()->put('user', $user);
        $request->session()->put('detailUser', $detailUser);
        return Redirect::back()->with('success', 'Data berhasil diupdate');
    }

    public function register77(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->is_aktif = 0;

        // upload foto
        $file = $req->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = public_path('img');
        $file->move($tujuan_upload, $nama_file);

        $user->foto = $nama_file;
        $user->role = 1;
        $user->password = Hash::make($req->password);
        $save = $user->save();

        $detailUser = new DetailUser;
        $detailUser->user_id = $user->id;
        $saveDetailUser = $detailUser->save();

        if ($save && $saveDetailUser) {
            return Redirect::to('/')->with('success', 'Berhasil registrasi, menunggu verifikasi admin');
        } else if (!$save || !$saveDetailUser) {
            return back()->with('error', 'Gagal registrasi');
        }
    }

    public function login77(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $user = User::where('email', '=', $req->email)->first();

        Auth::login($user);

        if (!$user || !Hash::check($req->password, $user->password)) {
            return back()->with('error', 'Email atau password salah');
        } else if ($user && $user->is_aktif == 0) {
            return back()->with('error', 'Akun belum aktif, menunggu verifikasi admin');
        } else if ($user && $user->role == 1) {
            $detailUser = DetailUser::where('user_id', '=', $user->id)->first();

            $req->session()->put('user', $user);
            $req->session()->put('detailUser', $detailUser);
            return Redirect::to('/user/profile77');
        } else if ($user && $user->role == 2) {
            $allUser = User::all();
            $req->session()->put('admin', $user);
            $req->session()->put('users', $allUser);
            return Redirect::to('/admin/dashboard77');
        }
    }

    public function logout77()
    {
        if (session()->has('user')) {
            session()->pull('user');
        }

        Auth::logout();

        return Redirect::to('/');
    }
}
