<?php
namespace App\Traits;

trait ServiceTrait
{
    public $ServiceStatus = [
        1 => [
            'status' => 1,
            'text' => 'pendente',
            'badge' => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20'
        ],
        2 => [
            'status' => 2,
            'text' => 'atrasado',
            'badge' => 'bg-red-50 text-red-700 ring-red-600/10'
        ],
        3 => [
            'status' => 3,
            'text' => 'pronto',
            'badge' => 'bg-green-50 text-green-700 ring-green-600/20'
        ],
        4 => [
            'status' => 4,
            'text' => 'entregue',
            'badge' => 'bg-blue-50 text-blue-700 ring-blue-700/10'
        ],
        5 => [
            'status' => 5,
            'text' => 'cancelado',
            'badge' => 'bg-gray-50 text-gray-600 ring-gray-500/10'
        ],
    ];
}
