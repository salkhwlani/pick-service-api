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
use Zttp\ZttpResponse;

class Orders
{
    /**
     * @var ApiClient
     */
    protected $client;
    /**
     * @var null
     */
    private $merchantId;

    /**
     * Orders constructor.
     *
     * @param ApiClient $client
     * @param int       $merchantId
     */
    public function __construct(ApiClient $client, int $merchantId = 0)
    {
        $this->client = $client;
        $this->merchantId = $merchantId;
    }

    /**
     * Returns order with requested id.
     *
     * @param int $orderID
     *
     * @return ZttpResponse
     */
    public function view(int $orderID): ZttpResponse
    {
        return $this->client->get($this->getUrl('orders/' . $orderID . '/'));
    }

    /**
     * get url base merchant id or normal request.
     *
     * @param $request
     *
     * @return string
     */
    protected function getUrl($request): string
    {
        return $this->merchantId ? $this->merchantId . '/' . $request : $request;
    }

    /**
     * Returns order with requested id.
     *
     * @param int $orderID
     *
     * @return ZttpResponse
     */
    public function pdf(int $orderID): ZttpResponse
    {
        return $this->client->get($this->getUrl('orders/' . $orderID . '/airway_bill/'));
    }

    /**
     * Get orders.
     *
     * @param string $search   A search term.
     * @param string $ordering Which field to use when ordering the results.
     *
     * @return \Zttp\ZttpResponse
     */
    public function search(string $search = null, string $ordering = null): ZttpResponse
    {
        return $this->client->get($this->getUrl('orders/'), \compact('search', 'ordering'));
    }

    /**
     * create new order.
     *
     * @param Order $order
     *
     * @return \Zttp\ZttpResponse
     */
    public function create(Order $order): ZttpResponse
    {
        return $this->client->post($this->getUrl('orders/'), $order->getModel());
    }

    /**
     * create new order.
     *
     * @param int   $orderId
     * @param Order $order
     *
     * @return ZttpResponse
     */
    public function edit(int $orderId, Order $order): ZttpResponse
    {
        return $this->client->put($this->getUrl('orders/' . $orderId . '/'), $order->getModel());
    }

    /**
     * cancel order.
     *
     * @param int   $orderId
     * @param Order $order
     *
     * @return ZttpResponse
     */
    public function cancel(int $orderId, Order $order): ZttpResponse
    {
        return $this->client->post($this->getUrl('orders/' . $orderId . '/cancel/'), $order->getModel());
    }

    /**
     * Cancels an Order.
     *
     * @param int $orderId
     *
     * @return \Zttp\ZttpResponse
     */
    public function delete(int $orderId): ZttpResponse
    {
        return $this->client->delete($this->getUrl('orders/' . $orderId . '/'));
    }
}
