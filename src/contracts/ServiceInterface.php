<?php
namespace Temify\Contracts;


interface ServiceInterface
{
    public function make(array $request);
}