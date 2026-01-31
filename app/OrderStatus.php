<?php

namespace App;

enum OrderStatus : string
{
     case Pending = 'pending';
    case Paid = 'paid';
    case Processing = 'processing';
    case Shipped = 'shipped';
    case Delivered = 'delivered';
    case Canceled = 'canceled';
    case Refunded = 'refunded';
}
