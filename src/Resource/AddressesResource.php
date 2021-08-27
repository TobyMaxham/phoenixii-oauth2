<?php

namespace TobyMaxham\PhoenixAuth\Resource;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
class AddressesResource extends PhoenixResource
{
    public function data(): array
    {
        if (! isset($this->data->addresses)) {
            return [];
        }

        return $this->data->addresses;
    }
}
