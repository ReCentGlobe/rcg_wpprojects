<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

acf_add_options_page([
    'page_title' => get_bloginfo('name') . ' Theme Options',
    'menu_title' => 'Theme Options',
    'menu_slug'  => 'theme-options',
    'capability' => 'edit_theme_options',
    'position'   => '999',
    'autoload'   => true
]);

class ThemeOptions extends Field
{
    /**
     * Projects field group.
     *
     * @return array
     */
    public function fields()
    {
        $projects = new FieldsBuilder('theme_options');

        $projects->setLocation('options_page', '==', 'theme-options');

        $projects
            /**
             * Colours Tab
             */
            ->addGroup('theme')
            ->addColorPicker('primary_color',[
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addColorPicker('secondary_color',[
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addColorPicker('dark_color',[
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addColorPicker('light_color',[
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->endGroup()
            /**
             * Newsletter Tab
             */
            ->addGroup('newsletter')
                ->addText('headline')
                ->addTextarea('content')
                ->addLink('link')
            ->endGroup();

        return $projects->build();
    }
}
