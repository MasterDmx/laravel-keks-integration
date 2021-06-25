<?php

namespace MasterDmx\LaravelKeks;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Client\Response as BaseResponse;
use MasterDmx\LaravelKeks\Contracts\Response as ResponseContract;

class Response implements ResponseContract, Arrayable, Jsonable
{
    private BaseResponse $response;

    public function __construct(BaseResponse $response) {
        $this->response = $response;
    }

    public function isOk(): bool
    {
        return $this->response->ok();
    }

    public function getStatus(): int
    {
        return $this->response->status();
    }

    public function getData(): object
    {
        return json_decode($this->response->body());
    }

    public function getBaseResponse(): BaseResponse
    {
        return $this->response;
    }

    public function toArray()
    {
        return json_decode($this->response->body(), true);
    }

    public function toJson($options = 0)
    {
        return $this->response->body();
    }
}
