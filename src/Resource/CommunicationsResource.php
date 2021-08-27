<?php

namespace TobyMaxham\PhoenixAuth\Resource;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
class CommunicationsResource extends PhoenixResource
{
    public function data(): array
    {
        if (! isset($this->data->communications)) {
            return [];
        }

        return $this->data->communications;
    }
}
