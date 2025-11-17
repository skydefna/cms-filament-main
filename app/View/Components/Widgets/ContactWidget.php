<?php

namespace App\View\Components\Widgets;

use App\Models\Contact;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactWidget extends Component
{
    protected Contact $contact;

    protected ThemeSetting $themeSetting;

    /**
     * Create a new component instance.
     */
    public function __construct(Contact $contact, ThemeSetting $themeSetting)
    {
        $this->contact = $contact;
        $this->themeSetting = $themeSetting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.contact-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.contact-widget';
        }

        return view($viewPath, [
            'contacts' => $this->contact->getContacts(),
        ]);
    }
}
