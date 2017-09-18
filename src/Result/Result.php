<?php

namespace Daniesy\VirusScanner\Result;


class Result
{
    public function __construct(array $data)
    {
        foreach(array_keys(get_object_vars($this)) as $key) {
            $this->$key = $data[$key];
        }
    }
}