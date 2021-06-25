<?php

namespace MasterDmx\LaravelKeks\Contracts;

interface Response
{
    public function isOk(): bool;

    public function getStatus(): int;

    public function getData(): object;

    public function getBaseResponse(): \Illuminate\Http\Client\Response;
}
