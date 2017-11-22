<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\PickServices\Model;

use Carbon\Carbon;
use Yemenifree\PickServices\Base\Model;

class Order extends Model
{
    protected $rules = [
        'delivery_notes' => 'required',
        'price' => 'nullable|integer',
        'service_type' => 'nullable|in:on-demand,economy,shipping',
        'payment_type' => 'required|in:Pre-paid,COD',
        'items' => 'required',
        'receiver_name' => 'required',
        'receiver_phone' => 'required',
        'pickup_time' => 'sometimes|date',
        'dropoff_time' => 'sometimes|date',
    ];

    /** @var string */
    protected $delivery_notes;
    /** @var string */
    protected $items;
    /** @var int (optional) */
    protected $price;
    /**
     * Payment type.
     *
     * COD to charge customer the service cost fees and item price.
     * PRE_PAID to not charge customer any fees.
     * ONLY_SENDER_FEES to charge the sender the service fees and not charge the customer anything.
     * ONLY_RECEIVER_FEES to charge customer service cost fees only and not item price.
     *
     * @var string
     */
    protected $payment_type;
    /**
     * on-demand => توصيل فوري 34 ريال/طلب
     * economy =>   توصيل اقتصادي 24 ريال/طلب
     * shipping => شحن29 ريال/طلب.
     *
     * @var string
     */
    protected $service_type;
    /** @var string */
    protected $receiver_name;
    /** @var string */
    protected $receiver_phone;

    /** @var Carbon */
    protected $pickup_time;
    /** @var Carbon */
    protected $dropoff_time;
    /** @var array */
    protected $dropoff_location;
    /** @var array */
    protected $pickup_location;

    /** @var array */
    protected $addons;
    /** @var array */
    protected $dimensions;

    /**
     * @return string
     */
    public function getDeliveryNotes(): string
    {
        return $this->delivery_notes;
    }

    /**
     * @param string $delivery_notes
     *
     * @return Order
     */
    public function setDeliveryNotes(string $delivery_notes): Order
    {
        $this->delivery_notes = $delivery_notes;

        return $this;
    }

    /**
     * @return string
     */
    public function getDimensions(): string
    {
        return \json_encode($this->dimensions);
    }

    /**
     * @param int $width
     * @param int $length
     * @param int $weight
     * @param int $height
     *
     * @return Order
     */
    public function setDimensions(integer $width, int $length, int $weight, int $height): Order
    {
        $this->dimensions = ['width' => $width, 'length' => $length, 'weight' => $weight, 'height' => $height];

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return Order
     */
    public function setPrice(int $price): Order
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiverName(): string
    {
        return $this->receiver_name;
    }

    /**
     * @param string $receiver_name
     *
     * @return Order
     */
    public function setReceiverName(string $receiver_name): Order
    {
        $this->receiver_name = $receiver_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiverPhone(): string
    {
        return $this->receiver_phone;
    }

    /**
     * @param string $receiver_phone
     *
     * @return Order
     */
    public function setReceiverPhone(string $receiver_phone): Order
    {
        $this->receiver_phone = $receiver_phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->service_type;
    }

    /**
     * @param string $service_type
     *
     * @return Order
     */
    public function setServiceType(string $service_type): Order
    {
        $this->service_type = $service_type;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentType(): string
    {
        return $this->payment_type;
    }

    /**
     * @param string $payment_type
     *
     * @return Order
     */
    public function setPaymentType(string $payment_type): Order
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    /**
     * @return string
     */
    public function getItems(): string
    {
        return $this->items;
    }

    /**
     * @param string $items
     *
     * @return Order
     */
    public function setItems(string $items): Order
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return string
     */
    public function getPickupTime(): string
    {
        return $this->pickup_time->format('YYYY-mm-dd H:i A');
    }

    /**
     * @param Carbon $pickup_time
     *
     * @return Order
     */
    public function setPickupTime(Carbon $pickup_time): self
    {
        $this->pickup_time = $pickup_time;

        return $this;
    }

    /**
     * @return string
     */
    public function getDropoffTime(): string
    {
        return $this->dropoff_time->format('YYYY-mm-dd H:i A');
    }

    /**
     * @param Carbon $dropoff_time
     *
     * @return Order
     */
    public function setDropoffTime(Carbon $dropoff_time): Order
    {
        $this->dropoff_time = $dropoff_time;

        return $this;
    }

    /**
     * @return string
     */
    public function getDropoffLocation(): string
    {
        return \implode(',', $this->dropoff_location);
    }

    /**
     * @param float $lat
     * @param float $lng
     *
     * @return Order
     */
    public function setDropoffLocation(float $lat, float $lng): Order
    {
        $this->dropoff_location = [$lat, $lng];

        return $this;
    }

    /**
     * @return string
     */
    public function getPickupLocation(): string
    {
        return \implode(',', $this->pickup_location);
    }

    /**
     * @param float $lat
     * @param float $lng
     *
     * @return Order
     */
    public function setPickupLocation(float $lat, float $lng): Order
    {
        $this->pickup_location = [$lat, $lng];

        return $this;
    }

    /**
     * add insurance addons to order.
     *
     * @return Order
     */
    public function addInsuranceService(): Order
    {
        $this->addons[] = 'insurance';

        return $this;
    }

    /**
     * add packaging addons to order.
     *
     * @return Order
     */
    public function addPackagingService(): Order
    {
        $this->addons[] = 'packaging';

        return $this;
    }

    /**
     * add container addons to order.
     *
     * @return Order
     */
    public function addContainerService(): Order
    {
        $this->addons[] = 'container';

        return $this;
    }

    /**
     * @return string
     */
    public function getAddons(): string
    {
        return \implode(',', \array_unique($this->addons));
    }
}
