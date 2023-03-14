<?php

/** 
 * UploadImage helper
 * 
 * @param $request
 * 
*/

function uploadImage($image)
{

    // on donne un nom à l'image: timestamp en temps unix + extenstion
    $imageName = time() . '.' . $image->extension();

    // on deplace l'image dans public/image
    $image->move(public_path('image'), $imageName);

    // on retourne le nom de l'image
    return $imageName;
}
?>