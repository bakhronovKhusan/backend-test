<?php
namespace App\Enums;

enum PaymentStatus: string
{
    case New = 'new';
    case Pending = 'pending';
    case Completed = 'completed';
    case Rejected = 'rejected';
}
