<?php

namespace Laranex\LaravelMyanmarPayments;

class LaravelMyanmarPayments
{
    /**
     * @throws \Exception
     */
    public function channel($channel): WaveMoney
    {
        switch ($channel) {
            case "wave_money":
                return new WaveMoney();
            default:
                throw new \Exception("Unsupported Payment Channel");
        }
    }
}
