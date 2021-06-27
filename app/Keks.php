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

    /**
     * Новая заявка
     *
     * @param string|null $name
     * @param string|null $phone
     * @param string|null $email
     * @param string|null $url
     *
     * @return \MasterDmx\LaravelKeks\ShippedLead
     */
    public function newLead(string $name = null, string $phone = null, string $email = null, string $url = null): ShippedLead
    {
        return new ShippedLead($this->support, $this->integrator, $name, $phone, $email, $url);
    }

    /**
     * Новое сообщение обратной связи
     *
     * @param string $message
     *
     * @return ShippedFeedback
     */
    public function newFeedback(string $message): ShippedFeedback
    {
        return new ShippedFeedback($this->integrator, $message);
    }
}
