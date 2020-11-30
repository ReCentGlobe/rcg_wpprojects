<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Blog extends Field
{
    /**
     * Blog field group.
     *
     * @return array
     */
    public function fields()
    {
        $blog = new FieldsBuilder('blogs');

        $blog->setLocation('post_type', '==', 'blog');

        $blog
            /**
             * Base Tab
             */
            ->addTab('Basic Information', ['placement' => 'left'])
            ->addText('blog_author', [
                'label' => 'Author',
                'instructions' => 'Add Author',
                'required' => 1,
                'maxlength' => ''
            ]);

        return $blog->build();
    }
}
