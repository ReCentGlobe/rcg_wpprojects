<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

acf_add_options_page([
    'page_title' => get_bloginfo('name') . ' Project Settings',
    'menu_title' => 'Project Settings',
    'menu_slug'  => 'theme-options',
    'capability' => 'manage_options',
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
            ->addTab('Theme')
            ->addGroup('theme')
            ->addColorPicker('primary_color', [
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addColorPicker('secondary_color', [
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addColorPicker('dark_color', [
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addColorPicker('light_color', [
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addTrueFalse('enable_logo', [
                'label' => 'Enable UL Logo in Header'
            ])
            ->addRepeater('logowrapper', [
                'label' => 'Add Logos to Footer',
                'layout' => 'row',
                'button_label' => 'Add Logo',
                'collapsed' => 'link'
            ])
                ->addImage('logo', [
                    'wrapper' => [
                        'width' => '20%',
                    ]])
                ->addLink('link', [
                    'wrapper' => [
                        'width' => '20%',
                    ]])
            ->endRepeater()
            ->endGroup()
            /**
             * Newsletter Tab
             */
            ->addTab('Newsletter')
            ->addGroup('newsletter')
                ->addTrueFalse('enabled')
                ->addText('headline')
                ->addTextarea('content')
                ->addLink('link')
            ->endGroup()
            ->addTab('Imprint')
            ->addGroup('imprint')
                ->addWysiwyg('content')
            ->endGroup();

        return $projects->build();
    }
}
