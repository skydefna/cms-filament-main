<?php

namespace App\View\Components\Widgets;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GlobalSearchWidget extends Component
{
    public string $urlAction;

    public string $formPlaceHolder;

    public string $name = 'keyword';

    /**
     * Create a new component instance.
     */
    public function __construct(protected ThemeSetting $themeSetting)
    {
        if (url()->current() === route('dokumen')) {
            $this->urlAction = route('dokumen');
            $this->formPlaceHolder = 'Cari Dokumen';
        } else {
            $this->urlAction = route('katalog');
            $this->formPlaceHolder = 'Cari Katalog';            
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.global-search-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.global-search-widget';
        }

        return view($viewPath);
    }
}
