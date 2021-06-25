<?php

namespace MasterDmx\LaravelKeks;

use Illuminate\Support\Facades\Http;
use MasterDmx\LaravelKeks\Contracts\Response as ResponseContract;

class Integrator
{
    /**
     * ID проекта
     *
     * @var int
     */
    private int $id;

    /**
     * API токен проекта
     *
     * @var string
     */
    private string $token;

    /**
     * Базовый УРЛ
     *
     * @var string
     */
    private string $baseUrl;

    public function __construct(int $id, string $token, string $baseUrl)
    {
        $this->id = $id;
        $this->token = $token;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Отправка данных методом POST
     *
     * @param $route
     * @param $data
     *
     * @return ResponseContract
     */
    public function post($route, $data): ResponseContract
    {
        $response = $this->query()->post($this->getUrl($route), $data);

        return new Response($response);
    }

    /**
     * Отправка данных методом GET
     *
     * @param $route
     * @param $data
     *
     * @return ResponseContract
     */
    public function get($route, $data): ResponseContract
    {
        return new Response($this->query()->get($this->getUrl($route), $data));
    }

    public function getUrl(string $route)
    {
        return $this->baseUrl . 'api/' . $route;
    }

    /**
     * Объект запроса c заголовками аутентификации
     *
     * @return \Illuminate\Http\Client\PendingRequest
     */
    public function query()
    {
        return Http::withOptions(['verify' => false])->withHeaders($this->getHeaders());
    }

    /**
     * Массив заголовков
     *
     * @return array
     */
    protected function getHeaders()
    {
        return [
            'x-project-id' => $this->id,
            'x-project-token' => $this->token
        ];
    }
}
