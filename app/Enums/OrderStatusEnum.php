<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case CART = 1;
    case PENDING = 2;
    case PAID = 3;
    case CANCELED = 4;
    case REJECTED = 5;

    public static function getName($name): OrderStatusEnum
    {
        return match ($name) {
            'CART' => self::CART,
            'PENDING' => self::PENDING,
            'PAID' => self::PAID,
            'CANCELED' => self::CANCELED,
            'REJECTED' => self::REJECTED,
            default => 'Status não encontrado'
        };
    }
}
