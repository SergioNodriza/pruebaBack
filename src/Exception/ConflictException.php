<?php


namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ConflictException extends ConflictHttpException
{
    public static function fromSave(string $type): self
    {
        throw new self(sprintf("Error when trying to save the %s", $type));
    }
}