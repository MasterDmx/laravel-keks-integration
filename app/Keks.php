<?php

namespace MasterDmx\LaravelKeks;

use MasterDmx\LaravelKeks\ShippedLead;

class Keks
{
    private Support $support;
    private Integrator $integrator;

    public function __construct(Support $support, Integrator $integrator)
    {
        $this->support = $support;
        $this->integrator = $integrator;
    }

    public function newLead(string $name = null, string $phone = null, string $email = null, string $url = null): ShippedLead
    {
        return new ShippedLead($this->support, $this->integrator, $name, $phone, $email, $url);
    }
}
