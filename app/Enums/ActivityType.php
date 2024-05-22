<?php

namespace App\Enums;

enum ActivityType: string
{
    case WareHouse1='warehouse1';
    case WareHouse2='warehouse2';
    case Milking='milking';
    case Drinking='drinking';
    case Eating='eating';

    case Walking='walking';

}
