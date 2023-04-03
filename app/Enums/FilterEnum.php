<?php

namespace App\Enums;

enum FilterEnum:string {
    // product
    case Name = 'filter_name';

    // offer
    case MinPrice = 'filter_min_price';
    case MaxPrice = 'filter_max_price';
}
