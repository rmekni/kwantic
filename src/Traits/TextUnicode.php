<?php

namespace App\Traits;

use Cocur\Slugify\Slugify;

trait TextUnicode
{
    public function makeSlug($string = null)
    {
        if (is_null($string)) {
            return "";
        }
        $slugify = new Slugify();
        return $slugify->slugify($string);
    }

    public function filterString($filename, $beautify = true)
    {
        $slugify = new Slugify();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if ($ext) {
            return $slugify->slugify(str_replace('.' . $ext, '', $filename)) . '.' . $ext;
        }
        return $slugify->slugify($filename);
    }
}
