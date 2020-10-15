<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Events extends Field
{
    /**
     * events field group.
     *
     * @return array
     */
    public function fields()
    {
        $events = new FieldsBuilder('events');

        $events->setLocation('post_type', '==', 'event');

        $events
            /**
             * Base Tab
             */
            ->addTab('Basic Information', ['placement' => 'left'])
            ->addText('event_title', [
                'label' => 'Title',
                'instructions' => 'Add project title to tile preview',
                'required' => 1,
                'maxlength' => ''
            ])
            ->addText('event_subtitle', [
                'label' => 'Subtitle',
                'instructions' => 'Add project title to tile preview',
                'required' => 1,
                'maxlength' => ''
            ])
            ->addText('event_shorttitle', [
                'label' => 'Short Title',
                'instructions' => 'Add project title to tile preview',
                'required' => 1,
                'maxlength' => ''
            ])
            ->addTab('Organization', ['placement' => 'left'])
            ->addTaxonomy('event_category', [
                'label' => 'Event Category',
                'instructions' => '',
                'taxonomy' => 'event-category',
                'required' => 1,
                'field_type' => 'radio',
                'save_terms' => 1,
                'load_terms' => 1,
                'wrapper' => [
                    'width' => '50%'
                ]
            ])
            ->addRepeater('event_organization_repeater', [
                'label' => 'Organization',
                'instructions' => 'Add Organizer',
                'required' => 1,
                'maxlength' => ''
            ])
                ->addText('event_organization')
            ->endRepeater()
            ->addTab('Date', ['placement' => 'left'])
            ->addTrueFalse('event_wholeday', [
                'label' => 'Whole Day Event',
                'instructions' => 'Hide Time, if checked',
                'ui' => 1,
            ])
            ->addDateTimePicker('event_startdate', [
                'label' => 'Date (Start)',
                'instructions' => '',
                'required' => 0,
                'return_format' => 'Y-m-d H:i:s',
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '50%'
                ]
            ])
            ->addDateTimePicker('event_enddate', [
                'label' => 'Date (End)',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'return_format' => 'Y-m-d H:i:s',
                'wrapper' => [
                    'width' => '50%'
                ]
            ])
            ->addText('event_location', [
                'label' => 'Location',
                'instructions' => 'Add project title to tile preview',
                'required' => 0,
                'maxlength' => ''
            ])
            ->addTab('Additional Information', ['placement' => 'left'])
            ->addText('event_language', [
                'label' => 'Language',
                'instructions' => 'Add project title to tile preview',
                'required' => 1,
                'maxlength' => ''
            ])
            ->addText('event_contact', [
                'label' => 'Contact',
                'instructions' => 'Add Contactdata to Event',
                'required' => 0,
                'maxlength' => ''
            ])
            ->addFile('event_downloads', [
                'label' => 'Download',
                'instructions' => 'Add Downloads',
                'required' => 0,
            ])
            ->addRepeater('event_addinformation', [
                'label' => 'Add Information Field',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => ''
                ],
                'layout' => 'table',
            ])
            ->addText('event_addinformation_title', [
                'wrapper' => [
                    'width' => '30',
                    'class' => '',
                    'id' => ''
                ]
            ])
            ->addText('event_addinformation_content', [
                'wrapper' => [
                    'width' => '70',
                    'class' => '',
                    'id' => ''
                ]
            ])
            ->endRepeater()
            ->addTab('External Event', ['placement' => 'left'])
            ->addTrueFalse('event_external', [
                'label' => 'External event',
                'instructions' => 'Link to different page',
                'ui' => 1,
            ])
            ->addLink('event_externallink')
            ->conditional('event_external', '==', '1');

        return $events->build();
    }
}
