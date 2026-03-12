<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Queries\Orders\GetRecentOrders;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class OrdersQuery extends Query
{
    public function __construct(private readonly GetRecentOrders $getRecentOrders)
    {
    }

    protected $attributes = [
        'name' => 'orders',
        'description' => 'Orders query with eager loaded nested relations',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Order'));
    }

    public function args(): array
    {
        return [
            'limit' => [
                'type' => Type::int(),
                'defaultValue' => 25,
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo): array
    {
        return $this->getRecentOrders->handle($args['limit'])->all();
    }
}
