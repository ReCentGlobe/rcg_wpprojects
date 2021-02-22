<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Videos extends Field
{
    /**
     * Videos field group.
     *
     * @return array
     */
    public function fields()
    {
        $blog = new FieldsBuilder('videos');

        $blog->setLocation('post_type', '==', 'video');

        $blog
            /**
             * Base Tab
             */
            ->addTab('Basic Information', ['placement' => 'left'])
            ->addText('video_author', [
                'label' => 'Author',
                'instructions' => 'Add Author',
                'required' => 1,
                'maxlength' => ''
            ])
            ->addText('video_affiliation', [
                'label' => 'Affiliation',
                'wrapper' => [
                    'width' => '50%'
                ]

            ])
            ->addField('video_country', 'country', [
                'label' => 'Country',
                'multiple' => 0,
                'allow_null' => 0,
                'return_format' => 'value',
                'wrapper' => [
                    'width' => '50%'
                ]
            ])
            ->addWysiwyg('video_cv',[
                'label' => 'CV'
            ])

            ->addOembed('video_embed');

        return $blog->build();
    }
}
