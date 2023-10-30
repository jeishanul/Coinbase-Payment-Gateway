<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PAID = 'Paid';
    case FAILED = 'Failed';
    case REVIEWED = 'Reviewed';
}
