<?php

/*
 *  File:settings.php part-of-project:lav_app encoding:UTF-8
 *  Last Modified at 3 Ιαν 2018 12:05:15 πμ.
 *  NOTE: COMMERCIAL LICENSE.. !
 *  Copyright 2018 KSNET.
 *  YOU ARE NOT ALLOWED TO USE ANYWHERE .. THIS CODE OR PORTIONS OF IT..!
 *  VARIATIONS, ADAPTATIONS, ADDITIONS, OR INCLUSIONS ARE ALSO FORBIDDEN !
 *  This software uses Lavarel PHPframework!
 */


return [
    'artlistpagin' => env('SETTINGS_ARTLISTPAGIN', 5),
    'panellistpagin' => env('SETTINGS_PANNELLISTPAGIN', 13),
    'cachetime' => env('SETTINGS_CACHETIME', 10800),
    'post_main_img_width' => '1024',
    'post_main_img_height' => '576',
    'post_medium_img_width' => '800',
    'post_medium_img_height' => '300',
    'post_thumb_img_width' => '150',
    'post_thumb_img_height' => '150',
    'media_full_img_width' => '1024',//height:auto
    'media_medium_img_width' => '800',//height:auto
    'media_thumb_img_width' => '150',
    'media_thumb_img_height' => '150',
];
