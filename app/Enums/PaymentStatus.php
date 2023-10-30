<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PAID = 'Paid';
    case CANCELED = 'Canceled';
    case REVIEWED = 'Reviewed';
}
