<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\PickServices\Base;

use InvalidArgumentException;
use Yemenifree\WordPressValidation\Traits\HasValidator;

abstract class Model
{
    use HasValidator;

    /** @var array */
    protected $rules = [];

    public function getModel()
    {
        $this->valid($this->getData(), $this->getRules());
    }

    /**
     * get data of model.
     *
     * @return array
     */
    public function getData(): array
    {
        return \get_object_vars($this);
    }

    /**
     * get list of rules array.
     *
     * @return array
     */
    private function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array $errors
     *
     * @throws InvalidArgumentException
     */
    public function InValidCallback(array $errors)
    {
        throw new InvalidArgumentException($errors[0]);
    }

    /**
     * @param array $rules
     *
     * @return self
     */
    public function setRules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }
}
