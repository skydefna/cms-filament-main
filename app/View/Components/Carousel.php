<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Carousel extends Component
{
    /**
     * Create a new component instance.
     *
     * @props([
     * 'type' => 'loop',
     * 'targetId',
     * 'width' => '100%',
     * 'gap' => '0px',
     * 'focus' => 'center',
     * 'autoWidth' => false,
     * 'autoHeight' => true,
     * 'trimSpace' => false,
     * 'autoplay' => true,
     * 'cover' => true,
     * 'pagination' => true,
     * 'padding' => '0px',
     * 'perPage' => 1,
     * 'perPageLarge' => 1,
     * ])
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        public string $type,
        public ?string $trackClassname,
        public string $targetId,
        public string $width = '100%',
        public string $height = '300px',
        public string $gap = '0px',
        public string $focus = 'center',
        public bool $autoWidth = false,
        public bool $autoHeight = true,
        public bool $trimSpace = true,
        public bool $autoplay = true,
        public bool $cover = true,
        public bool $pagination = false,
        public string $padding = '0px',
        public int $perPage = 1,
        public int $perPageMedium = 1,
        public int $perPageLarge = 1,
        public int $interval = 3000,
        public ?float $heightRatio = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.carousel';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.carousel';
        }

        return view($viewPath);
    }
}
