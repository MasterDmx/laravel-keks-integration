<?php

namespace MasterDmx\LaravelKeks;

use MasterDmx\LaravelKeks\Exceptions\IncorrectEmailException;
use MasterDmx\LaravelKeks\Exceptions\NumberLengthIsSmallException;
use MasterDmx\LaravelKeks\Exceptions\NumberLengthIsTooLongException;

class Support
{
    /**
     * Обработка номера телефона
     *
     * @param string $phone
     *
     * @return string
     */
    public function processPhone(string $phone): string
    {
        $phone = trim(preg_replace('/[^0-9]/', '', $phone));

        if (strlen($phone) < 10) {
            throw new NumberLengthIsSmallException('Phone number cannot be less than 10 characters');
        }

        if (strlen($phone) > 11) {
            throw new NumberLengthIsTooLongException('The phone number cannot be larger than 11 characters');
        }

        if (strlen($phone) === 11) {
            return substr($phone, 1);
        }

        return $phone;
    }

    /**
     * Обработка EMAIL адреса
     *
     * @param string $email
     *
     * @return string
     */
    public function processEmail(string $email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           throw new IncorrectEmailException('Invalid email');
        }

        return trim(mb_strtolower($email, 'UTF-8'));
    }

    /**
     * Обработка имени
     *
     * @param string $email
     *
     * @return string
     */
    public function processName(string $name): string
    {
        return trim(ucwords($name));
    }
}
