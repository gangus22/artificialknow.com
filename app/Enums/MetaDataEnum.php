<?php

namespace App\Enums;

enum MetaDataEnum
{
    const DEFAULT_JSON_VALUE = '{
            "titleTag": "",
            "metaDescription": "",
            "og:title": "",
            "og:description": "",
            "og:image": ""
        }';

    const DEFAULT_VALUE_FOR_EDITOR = [
            "titleTag" => "",
            "metaDescription" => "",
            "og:title" => "",
            "og:description" => "",
            "og:image" => "",
    ];
}
