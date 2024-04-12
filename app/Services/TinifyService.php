<?php

namespace App\Services;

class TinifyService implements ImageServiceInterface
{
    public string $path = 'images/';

    public function __construct()
    {
        \Tinify\setKey(env("TINIFY_API_KEY"));
    }

    public function crop($image, $width = 70, $height = 70)
    {
        $source = \Tinify\fromFile($image);

        $resized = $source->resize(array(
            "method" => "cover",
            "width" => $width,
            "height" => $height
        ));

        $path = env("AWS_BUCKET") . "/$this->path" . $image->getFilename() . "." . $image->getClientOriginalExtension();
        $url = $this->upload($resized, $path)->location();

        return $url;
    }


    public function upload($image, $path)
    {
        $data = $image->store(array(
            "service" => "s3",
            "aws_access_key_id" => env("AWS_ACCESS_KEY_ID"),
            "aws_secret_access_key" => env("AWS_SECRET_ACCESS_KEY"),
            "region" => env("AWS_DEFAULT_REGION"),
            "path" => $path
        ));

        return $data;
    }
}
