<?php

namespace TobyMaxham\PhoenixAuth\Resource;

/**
 * @author Tobias Maxham <git@maxham.de>
 */
class LicensesResource extends PhoenixResource
{
    public function data(): array
    {
        if (! isset($this->data->licenses)) {
            return [];
        }

        return $this->data->licenses;
    }
}
