<?php

namespace App\Interfaces;

interface Sellable

{
    public function id(): string;

    public function name(): string;
}