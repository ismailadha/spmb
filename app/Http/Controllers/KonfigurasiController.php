<?php

namespace App\Http\Controllers;

use App\Models\Juknis;
use App\Models\Konfigurasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;

class KonfigurasiController extends Controller
{
    public function index()
    {
        // Extract as [ 'kunci' => 'nilai' ]
        $konfigurasi = Konfigurasi::pluck('nilai', 'kunci')->toArray();

        return view('backend.konfigurasi.index', compact('konfigurasi'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'logo_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,ico|max:1024',
            'logo_daerah' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'logo_surat' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'nama_sistem' => 'required|string|min:3|max:255',
            'nama_instansi' => 'required|string|min:3|max:255',
            'email_resmi' => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'required|string|min:10',
            'footer_teks' => 'required|string|min:3|max:255',

            // Koordinator SD
            'nama_kor_sd' => 'nullable|string|max:255',
            'email_kor_sd' => 'nullable|email|max:255',
            'hp_kor_sd' => 'nullable|string|max:20',

            // Koordinator SMP
            'nama_kor_smp' => 'nullable|string|max:255',
            'email_kor_smp' => 'nullable|email|max:255',
            'hp_kor_smp' => 'nullable|string|max:20',
        ]);

        $data = $request->except(['_token', '_method']);

        // Handle logo file upload
        if ($request->hasFile('logo_path')) {
            // Hapus logo yang lama jika ada
            $oldLogo = Konfigurasi::where('kunci', 'logo_path')->value('nilai');
            if ($oldLogo && file_exists(public_path($oldLogo))) {
                unlink(public_path($oldLogo));
            }

            // Buat directory jika belum ada
            $logoDir = public_path('images/logo');
            if (! file_exists($logoDir)) {
                mkdir($logoDir, 0755, true);
            }

            // Upload file baru
            $file = $request->file('logo_path');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move($logoDir, $filename);
            $data['logo_path'] = 'images/logo/'.$filename;
        } else {
            unset($data['logo_path']);
        }

        // Handle favicon file upload
        if ($request->hasFile('favicon')) {
            // Hapus favicon yang lama jika ada
            $oldFavicon = Konfigurasi::where('kunci', 'favicon')->value('nilai');
            if ($oldFavicon && file_exists(public_path($oldFavicon))) {
                unlink(public_path($oldFavicon));
            }

            // Buat directory jika belum ada
            $logoDir = public_path('images/logo');
            if (! file_exists($logoDir)) {
                mkdir($logoDir, 0755, true);
            }

            // Upload file baru
            $file = $request->file('favicon');
            $filename = 'favicon_'.time().'_'.$file->getClientOriginalName();
            $file->move($logoDir, $filename);
            $data['favicon'] = 'images/logo/'.$filename;
        } else {
            unset($data['favicon']);
        }

        // Handle logo daerah file upload
        if ($request->hasFile('logo_daerah')) {
            // Hapus logo daerah yang lama jika ada
            $oldLogoDaerah = Konfigurasi::where('kunci', 'logo_daerah')->value('nilai');
            if ($oldLogoDaerah && file_exists(public_path($oldLogoDaerah))) {
                unlink(public_path($oldLogoDaerah));
            }

            // Buat directory jika belum ada
            $logoDir = public_path('images/logo');
            if (! file_exists($logoDir)) {
                mkdir($logoDir, 0755, true);
            }

            // Upload file baru
            $file = $request->file('logo_daerah');
            $filename = 'logo_daerah_'.time().'_'.$file->getClientOriginalName();
            $file->move($logoDir, $filename);
            $data['logo_daerah'] = 'images/logo/'.$filename;
        } else {
            unset($data['logo_daerah']);
        }

        // Handle logo surat file upload
        if ($request->hasFile('logo_surat')) {
            // Hapus logo surat yang lama jika ada
            $oldLogoSurat = Konfigurasi::where('kunci', 'logo_surat')->value('nilai');
            if ($oldLogoSurat && file_exists(public_path($oldLogoSurat))) {
                unlink(public_path($oldLogoSurat));
            }

            // Buat directory jika belum ada
            $logoDir = public_path('images/logo');
            if (! file_exists($logoDir)) {
                mkdir($logoDir, 0755, true);
            }

            // Upload file baru
            $file = $request->file('logo_surat');
            $filename = 'logo_surat_'.time().'_'.$file->getClientOriginalName();
            $file->move($logoDir, $filename);
            $data['logo_surat'] = 'images/logo/'.$filename;
        } else {
            unset($data['logo_surat']);
        }

        // Update konfigurasi menggunakan query builder
        foreach ($data as $kunci => $nilai) {
            // Skip jika bukan string
            if (! is_string($nilai)) {
                continue;
            }

            Konfigurasi::query()
                ->where('kunci', $kunci)
                ->update(['nilai' => $nilai]);
        }

        return redirect()->route('konfigurasi.index')->with('success', 'Konfigurasi sistem berhasil diperbarui.');
    }

    public function konfig_juknis(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nilai' => 'required',
            ]);

            Juknis::where('kunci', 'juknis')->update([
                'nilai' => $request->nilai,
            ]);

            return redirect()->back()->with('success', 'Petunjuk Teknis berhasil diperbarui.');
        }

        $juknis = Juknis::where('kunci', 'juknis')->first();

        return view('backend.konfigurasi.juknis', compact('juknis'));
    }

    public function konfig_persyaratan(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nilai' => 'required',
            ]);

            Persyaratan::where('kunci', 'persyaratan')->update([
                'nilai' => $request->nilai,
            ]);

            return redirect()->back()->with('success', 'Persyaratan berhasil diperbarui.');
        }

        $persyaratan = Persyaratan::where('kunci', 'persyaratan')->first();

        return view('backend.konfigurasi.persyaratan', compact('persyaratan'));
    }
}
