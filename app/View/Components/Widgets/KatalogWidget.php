<?php

namespace App\View\Components\Widgets;

use App\Models\KategoriLayanan;
use Illuminate\View\Component;

class KatalogWidget extends Component
{
    public $limit;

    public function __construct($limit = 3)
    {
        $this->limit = $limit;
    }

    public function render()
    {
        $katalog = KategoriLayanan::latest()->take($this->limit)->get();    

        return view('themes.default.widgets.katalog-widget', [
            'katalog' => $katalog,
        ]);
    }
}
