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
     */
    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function create()
    {
        $order = new Order();
        dd($order->getData());
    }

    /**
     * @return ApiClient
     */
    public function getClient(): ApiClient
    {
        return $this->client;
    }
}
