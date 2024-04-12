<?php

namespace App\Services;

interface ImageServiceInterface
{
    public function __construct();

    public function crop($image, $width, $height);

    public function upload($image, $path);
}
