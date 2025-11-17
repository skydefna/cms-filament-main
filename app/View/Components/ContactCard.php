<?php

namespace App\View\Components;

use App\Models\Contact;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected ThemeSetting $themeSetting, public Contact $contact)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.contact-card';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.contact-card';
        }

        return view($viewPath);
    }
}
