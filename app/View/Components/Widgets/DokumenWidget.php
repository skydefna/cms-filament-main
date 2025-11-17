<?php

namespace App\View\Components\Widgets;

use Illuminate\View\Component;
use App\Models\DokumentasiDigital;

class DokumenWidget extends Component
{
    public $limit;

    public function __construct($limit = 3)
    {
        $this->limit = $limit;
    }

    public function render()
    {
        $dokumenTerbaru = DokumentasiDigital::latest()->take($this->limit)->get();

        return view('themes.default.widgets.dokumen-widget');
    }
}