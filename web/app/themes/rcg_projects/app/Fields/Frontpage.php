<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Frontpage extends Field
{
    /**
     * Projects field group.
     *
     * @return array
     */
    public function fields()
    {
        $frontpage = new FieldsBuilder('front_page');

        $frontpage->setLocation('page_type', '==', 'front_page');

        $frontpage
            /**
             * Colours Tab
             */
            ->addGroup('header')
            ->addText('headline')
            ->addWysiwyg('content')
            ->addImage('image')
            ->addRepeater('logowrapper', [
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
            ->endGroup();

        return $frontpage->build();
    }
}
