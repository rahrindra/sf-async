<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoValidator
{
    public function __construct(
        private readonly ValidatorInterface $validator,
    ) {
    }

    /**
     * validate object DTO using symfony validator.
     *
     * @param null|mixed $groups
     *
     * @throws BadRequestException
     */
    public function validate(mixed $dto, $groups = null): void
    {
        $errors = $this->validator->validate($dto, groups: $groups);

        if (0 === \count($errors)) {
            return;
        }

        $formattedErrors = [];
        foreach ($errors as $error) {
            $temp = [
                'field' => $error->getPropertyPath(),
                'message' => $error->getMessage(),
            ];
            $formattedErrors[] = $temp;
        }

        throw new BadRequestException($errors, Response::HTTP_BAD_REQUEST, null);
    }
}
