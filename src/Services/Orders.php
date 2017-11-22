<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\PickServices\Services;

use Yemenifree\PickServices\ApiClient;
use Yemenifree\PickServices\Model\Order;

class Orders
{
    /**
     * @var ApiClient
     */
    protected $client;

    /**
     * Orders constructor.
     *
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function create(Order $order)
    {
        return $this->client->post('orders/', $order->getModel());
    }
}
