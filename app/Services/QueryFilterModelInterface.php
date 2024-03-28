<?php

namespace App\Services;

interface QueryFilterModelInterface
{
    /**
     * @return array
     */
    public function handle(): array;

}
