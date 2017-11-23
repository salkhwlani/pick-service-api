<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\PickServices;

use Zttp\ZttpResponse;

class PickService
{
    /** @var ApiClient */
    protected $client;

    public function __construct(string $token, bool $sandbox = false)
    {
        $this->client = new ApiClient();

        // init client
        $this->getClient()->setSandbox($sandbox)->setToken($token);
    }

    /**
     * @return ApiClient
     */
    public function getClient(): ApiClient
    {
        return $this->client;
    }

    /**
     * @param string $service
     * @param string $type
     * @param array  ...$arg
     *
     * @throws \Exception
     *
     * @return ZttpResponse
     */
    public function request(string $service, string $type, ...$arg)
    {
        $serviceClass = 'Yemenifree\\PickServices\\Services\\' . \ucfirst($service);

        if (!\class_exists($serviceClass)) {
            throw new \Exception("class $serviceClass not exists");
        }
        $service = new  $serviceClass($this->getClient());

        return $service->$type(...$arg);
    }
}
