# Pick.sa API client for PHP.

[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-build]][link-build]
[![Quality Score][ico-code-quality]][link-code-quality]


<h4> <center>This is a <bold>community project</bold> and not an official one </center></h4>

> This API client for [pick.sa](https://pick.sa) service. It is an **unofficial**

## Requirements & Installation

> Requires PHP 7.0+

Via Composer

``` bash
$ composer require yemenifree/pick-service-api
```

## Getting Started

Setup api service.

```php
$service = new PickService('Live Token');
```

You can enable sandbox env via pass true in second parameter.

```php
$sandBoxService = new PickService('Sandbox Token', true);
```


## Create new request.

You can create new request simply via 

```php
$result = $service->request('service', 'action', ...$arg);
```

## Check response

To check result of response use `isSeccess()` method.

```php
// check if request seccess.
if (!$result->isSuccess()) {
    // there are error
    $error = $result->json();
}

// All right.
$invoice = $result->json();     
```

## Orders.

### create Order

```php
// create Order
$order = new Order();
// set up order info.
$order->setItems(Order::ITEM_HOUSEHOLD)
    ->setPrice(200)
    ->setPickupTime(Carbon::now()->addDays(1))
    ->setPaymentType(Order::PAYMENT_PRE_PAID)
    ->setPickupLocation(24.697168165551115, 46.70957565307617)
    ->setReceiverName('Salah Alkhwlani')
    ->setReceiverPhone('966500484350');

// send create request.
$result = $service->request('orders', 'create', $order);

// check if request seccess.
if (!$result->isSuccess()) {
    $error = $result->json();
}

// All right.
$invoice = $result->json();     
```


### Delete Order.

```php
$orderID = 1;
$result = $service->request('orders', 'delete', $orderID);
```

### View Order.

```php
$orderID = 1;
$result = $service->request('orders', 'view', $orderID);
```

### Search in orders.

```php
$query = 'keyword';
$order = '';
$result = $service->request('orders', 'search', $query, $order);
```

### Edit Order.

```php
$orderID = 1;
$orderModel = new Order();
// set up new order info.
$orderModel->setItems(Order::ITEM_HOUSEHOLD)
    ->setPrice(210)
    ->setPickupTime(Carbon::now()->addDays(1))
    ->setPaymentType(Order::PAYMENT_PRE_PAID)
    ->setPickupLocation(24.697168165551115, 46.70957565307617)
    ->setReceiverName('Salah Alkhwlani')
    ->setReceiverPhone('966500484350');

$result = $service->request('orders', 'edit', $orderID, $orderModel);
```

### Cancel order.

```php
$result = $service->request('orders', 'cancel', $orderID,$orderModel);
```

## TODO
- Implement other services.
- Add service provider & config for Laravel.
- Write test unit.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email yemenifree@yandex.com instead of using the issue tracker.

## Credits

- [Salah Alkhwlani][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-code-quality]: https://scrutinizer-ci.com/g/yemenifree/pick-service-api/badges/quality-score.png?b=master
[ico-build]: https://scrutinizer-ci.com/g/yemenifree/pick-service-api/badges/build.png?b=master

[link-author]: https://github.com/yemenifree
[link-contributors]: ../../contributors
[link-code-quality]: https://scrutinizer-ci.com/g/yemenifree/pick-service-api/code-structure
[link-build]: https://scrutinizer-ci.com/g/yemenifree/pick-service-api/build-status/maste
[link-last-version]: https://api.github.com/repos/yemenifree/pick-service-api/zipball

