<?php
/**
 * Created by PhpStorm.
 * User: shadan_pc
 * Date: 18-08-2015
 * Time: 15:20
 */

namespace App\Transformer;


class ImageTransformer extends Transformer {


    public function transform($image)
    {
        return [
            'id'        => (int) $image['id'],
            'caption'   => $image['label'],
            'avatar'    => $image['image'],
        ];
    }
}