<?php

namespace App\View\Components;

use App\Settings\GeneralSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Meta extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->generalSetting->primary_logo) {
            $logo = Storage::disk('public')->url($this->generalSetting->primary_logo);
        } else {
            $logo = asset('assets/images/tabalong_xs.png');
        }

        return view('components.meta', [
            'generalSetting' => $this->generalSetting,
            'logo' => $logo,
        ]);
    }
}
