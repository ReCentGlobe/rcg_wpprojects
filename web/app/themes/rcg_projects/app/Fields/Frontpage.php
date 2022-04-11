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
            ->addTrueFalse('video-enabled')
            ->addImage('image')
            ->addGroup('video')
                ->addFile('mp4')
                ->addFile('webm')
                ->addFile('poster')
            ->endGroup()
            ->endGroup();

        return $frontpage->build();
    }
}
