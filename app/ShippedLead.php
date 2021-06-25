<?php

namespace MasterDmx\LaravelKeks;

use MasterDmx\LaravelKeks\Contracts\Response as ResponseContract;

class ShippedLead
{
    /**
     * Номер телефона пользователя
     *
     * @var string
     */
    public string $phone;

    /**
     * Email пользователя
     *
     * @var string
     */
    public string $email;

    /**
     * Имя пользователя
     *
     * @var string
     */
    public string $name;

    /**
     * URL откуда была создана заявка
     *
     * @var string
     */
    public string $url;

    /**
     * Дополнительные параметры
     *
     * @var array
     */
    public array $extra = [];

    private Support $support;

    private Integrator $integrator;

    public function __construct(Support $support, Integrator $integrator, ?string $name = null, ?string $phone = null, ?string $email = null, ?string $url = null)
    {
        $this->support = $support;
        $this->integrator = $integrator;

        if (isset($name)) {
            $this->setName($name);
        }

        if (isset($phone)) {
            $this->setPhone($phone);
        }

        if (isset($email)){
            $this->setEmail($email);
        }

        if (isset($url)){
            $this->setUrl($url);
        }
    }

    /**
     * Задать номер телефона пользователя
     *
     * @param string $phone
     *
     * @return ShippedLead
     */
    public function setPhone(string $phone): ShippedLead
    {
        $this->phone = $this->support->processPhone($phone);

        return $this;
    }

    /**
     * Задать Email пользователя
     */
    public function setEmail(string $email): ShippedLead
    {
        $this->email = $this->support->processEmail($email);

        return $this;
    }

    /**
     * Задать Email пользователя
     */
    public function setName(string $name): ShippedLead
    {
        $this->name = $this->support->processName($name);

        return $this;
    }

    /**
     * Установить реферальную ссылку
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl(string $url): ShippedLead
    {
        $this->url = substr(trim($url), 0, 1000);

        return $this;
    }

    /**
     * Дополнительный параметр для отправки
     *
     * @param string $key Ключ данных (без кирилици и без пробелов)
     * @param string $name Название поля
     * @param string $value Значение
     *
     * @return ShippedLead
     */
    public function set(string $key, string $name, $value): ShippedLead
    {
        $this->extra[$key] = [
            'name' => $name,
            'value' => $value
        ];

        return $this;
    }

    /**
     * Отправка заявки
     */
    public function send(): ResponseContract
    {
        return $this->integrator->post('leads', [
            'name'  => $this->name ?? '',
            'phone' => $this->phone ?? '',
            'email' => $this->email ?? '',
            'url'   => $this->url ?? '',
            'extra' => $this->extra ?? [],
        ]);
    }
}
