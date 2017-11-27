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
    /** @var array */
    protected $fields = [];

    /**
     * Valid current model & return data array.
     *
     * @return array
     */
    public function getModel()
    {
        $this->valid($this->getData(), $this->getRules());

        return $this->getData();
    }

    /**
     * Get data of model.
     *
     * @return array
     */
    public function getData(): array
    {
        return collect(\get_object_vars($this))->filter(function ($value, $name) {
            return \in_array($name, $this->getFields()) && !empty($value);
        })->map(function ($value, $name) {
            $methodName = camel_case('get_' . $name);

            return \method_exists($this, $methodName) ? $this->$methodName() : $value;
        })->toArray();
    }

    /**
     * Get model fields.
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Get list of rules array.
     *
     * @return array
     */
    private function getRules(): array
    {
        return $this->rules;
    }

    /**
     * In valid function.
     *
     * @param array $errors
     *
     * @throws InvalidArgumentException
     */
    public function InValidCallback(array $errors)
    {
        throw new InvalidArgumentException($errors[0]);
    }

    /**
     * Set Rules of current model.
     *
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
