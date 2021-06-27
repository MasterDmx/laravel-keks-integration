<?php

namespace MasterDmx\LaravelKeks;

use MasterDmx\LaravelKeks\Contracts\Response as ResponseContract;

class ShippedFeedback
{
    /**
     * Сообщение
     *
     * @var string
     */
    public string $message;

    /**
     * Дополнительные параметры
     *
     * @var array
     */
    public array $extra = [];

    private Integrator $integrator;

    public function __construct(Integrator $integrator, string $message)
    {
        $this->integrator = $integrator;
        $this->message = trim(strip_tags($message));
    }

    /**
     * Дополнительный параметр для отправки
     *
     * @param string $key Ключ данных (без кирилици и без пробелов)
     * @param string $name Название поля
     * @param string $value Значение
     *
     * @return ShippedFeedback
     */
    public function set(string $key, string $name, $value): ShippedFeedback
    {
        $this->extra[$key] = [
            'name' => $name,
            'value' => $value
        ];

        return $this;
    }

    /**
     * Отправка данных
     */
    public function send(): ResponseContract
    {
        return $this->integrator->post('feedback', [
            'message'  => $this->message,
            'extra' => $this->extra ?? [],
        ]);
    }
}
