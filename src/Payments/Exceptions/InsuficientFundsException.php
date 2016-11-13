<?php
/**
 * Criado por Maizer Aly de O. Gomes para iget.
 * Email: maizer.gomes@gmail.com / maizer.gomes@ekutivasolutions / maizer.gomes@outlook.com
 * Usuário: Maizer
 * Data: 14/10/2016
 * Hora: 08:41
 */

namespace eKutivaSolutions\Payments\Exceptions;


use Exception;

class InsuficientFundsException extends Exception
{
    public function __construct()
    {
        $message = trans('sys/exceptions.insuficientfunds', ['name' => 'Inscrição']);
        $code = 402;

        parent::__construct($message, $code);
    }

}