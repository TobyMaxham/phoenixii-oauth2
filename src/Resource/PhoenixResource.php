<?php

namespace TobyMaxham\PhoenixAuth\Resource;

use stdClass;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
abstract class PhoenixResource
{
    public function __construct(protected stdClass $data)
    {
    }

    abstract public function data(): array;
}
