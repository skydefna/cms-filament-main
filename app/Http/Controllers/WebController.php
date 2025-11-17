<?php

/** @noinspection ALL */

/** @noinspection LaravelUnknownViewInspection */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\ThemeSetting;
use App\Models\DokumentasiDigital;
use App\Models\KategoriLayanan;

class WebController extends Controller
{
    public ?string $theme;

    public function __construct(
        protected ThemeSetting $themeSetting,                                      
    ) {
        $this->theme = $this->themeSetting->theme;
    }

    /**
     * Display the welcome page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function welcome()
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.welcome';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.welcome';
        }

        return view($viewPath, [
            'theme' => $this->themeSetting->theme,
        ]);
    }

    /**
     * Retrieve posts based on the specified type.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request instance.
     * @param  string  $type  The type of posts to retrieve. Defaults to 'latest'.
     *                        Possible values could include 'latest', 'popular', etc.
     * @return \Illuminate\Contracts\View\View The HTTP response containing the posts.
     */
    public function getKatalog(Request $request)
    {
        $viewPath = 'themes.' . $this->themeSetting->theme . '.katalog';
        if (!view()->exists($viewPath)) {
            $viewPath = 'themes.default.katalog';
        }

        // Ambil keyword
        $keyword = $request->keyword;

        // Query katalog dengan pencarian
        $query = \App\Models\KategoriLayanan::query();

        if ($keyword) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('category', 'LIKE', "%{$keyword}%")
                ->orWhere('deskripsi_kategori', 'LIKE', "%{$keyword}%");
        }

        // Urutkan berdasarkan 'sort'
        $katalog = $query->orderBy('sort', 'asc')->get();

        return view($viewPath, compact('katalog'));
    }

    public function getDokumen(Request $request)
    {
        // Tentukan nama view berdasarkan tema aktif
        $viewPath = 'themes.' . $this->themeSetting->theme . '.dokumen';
        if (!view()->exists($viewPath)) {
            $viewPath = 'themes.default.dokumen';
        }

        // Query data dokumen
        $query = DokumentasiDigital::query();

        // Jika ada pencarian keyword
        if ($request->has('keyword') && $request->keyword !== '') {
            $keyword = $request->keyword;
            $query->where('judul', 'like', "%{$keyword}%")
                ->orWhere('deskripsi', 'like', "%{$keyword}%");
        }

        // Ambil data terbaru, gunakan pagination
        $dokumen = $query->latest()->paginate(9);

        // Kirim ke view tema aktif
        return view($viewPath, compact('dokumen'));
    }
    /**
     * Retrieve a list of agendas based on the given request parameters.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request instance containing input data.
     * @return \Illuminate\Contracts\View\View The HTTP response containing the agendas data.
     */       
}