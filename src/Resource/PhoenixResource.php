<?php

namespace TobyMaxham\PhoenixAuth\Resource;

use stdClass;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
abstract class PhoenixResource
{
    protected $data;

    public function __construct(stdClass $data)
    {
        $this->data = $data;
    }

    abstract public function data(): array;
}
