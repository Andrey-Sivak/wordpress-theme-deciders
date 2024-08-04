<?php
add_action( 'init', 'ds_register_block_pattern', 25 );

function ds_register_block_pattern(): void {

    if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {

        register_block_pattern(
            'ds/text-image-btn-pattern',
            array(
                'title'       => 'Deciders. Блок текст с картинкой и кнопкой',
                'description' => 'Паттерн 2 колонки. Справа картинка, слева краткий текст и кнопка',
                'content'     => "<!-- wp:columns {\"className\":\"ds-pattern-1\",\"style\":{\"spacing\":{\"padding\":{\"top\":\"10px\",\"bottom\":\"10px\"}}}} -->\n<div class=\"wp-block-columns ds-pattern-1\" style=\"padding-top:10px;padding-bottom:10px\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":\"17px\"}}} -->\n<p style=\"font-size:17px\">Введите текст!</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"backgroundColor\":\"white\",\"textColor\":\"black\",\"style\":{\"spacing\":{\"padding\":{\"left\":\"0px\",\"right\":\"0px\",\"top\":\"0px\",\"bottom\":\"0px\"}},\"elements\":{\"link\":{\"color\":{\"text\":\"var:preset|color|black\"}}},\"typography\":{\"fontSize\":\"17px\"}}} -->\n<div class=\"wp-block-button has-custom-font-size\" style=\"font-size:17px\"><a class=\"wp-block-button__link has-black-color has-white-background-color has-text-color has-background has-link-color wp-element-button\" style=\"padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px\">Подробнее</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":116,\"sizeSlug\":\"full\",\"linkDestination\":\"none\",\"className\":\"is-style-default\"} -->\n<figure class=\"wp-block-image size-full is-style-default\"><img src=\"\" alt=\"\" class=\"wp-image-116\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->",
                'categories'  => array( 'text' ),
            )
        );

    }

}
