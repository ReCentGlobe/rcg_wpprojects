<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class EventCategories extends Field
{
    /**
     * events field group.
     *
     * @return array
     */
    public function fields()
    {
        $events = new FieldsBuilder('Additional Fields', [
            'position' => 'acf_after_title'
        ]);

        $events->setLocation('taxonomy', '==', 'event-category');

        $events
            /**
             * Base Tab
             */
            ->addTab('Basic Information', ['placement' => 'left'])
            ->addText('eventcategory_titleplural', [
                'label' => 'Plural Title',
                'instructions' => 'Event Category Plural',
                'required' => 1,
                'maxlength' => ''
            ])
            ->addWysiwyg('eventcategory_teaser', [
                'label' => 'Teaser Text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ],
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 0,
                'delay' => 1
            ]);

        return $events->build();
    }
}
