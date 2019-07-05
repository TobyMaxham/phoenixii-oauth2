<?php

namespace TobyMaxham\PhoenixAuth\Resource;

/**
 * @author Tobias Maxham <git2019@maxham.de>
 */
class FunctionsResource extends PhoenixResource
{
    public function data(): array
    {
        if (! isset($this->data->functions)) {
            return [];
        }

        return $this->data->functions;
    }
}
