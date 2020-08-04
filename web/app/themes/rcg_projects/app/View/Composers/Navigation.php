<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

class Navigation extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'components.c-navigation',
        'partials.footer',
        'partials.header',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'navigation' => $this->navigation(),
            'footer_navigation' => $this->footer()
        ];
    }

    /**
     * Returns the primary navigation.
     *
     * @return array
     */
    public function navigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build()->toArray();
    }

    /**
     * Returns the footer right navigation.
     *
     * @return array
     */
    public function footer()
    {
        if (Navi::build('footer')->isEmpty()) {
            return;
        }

        return Navi::build('footer')->toArray();
    }
}
