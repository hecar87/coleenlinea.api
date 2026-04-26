<?php

namespace App\Helpers;

class Result
{
    public function __construct(
        public readonly int $RESULT_STS,
        public readonly int $RESULT_COD,
        public readonly string $RESULT_DOM,
        public readonly string $RESULT_MSG,
        public readonly mixed $RESULT_DTA = null,
        public readonly int $RESULT_DTL = 0,
        public readonly string $RESULT_ERR = ""
    ) {}

    public function isSuccess(): bool
    {
        return $this->RESULT_STS === 1;
    }

    public function isError(): bool
    {
        return !$this->isSuccess();
    }
}