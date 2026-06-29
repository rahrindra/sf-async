<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class AppSerializer
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function deserialize(Request $request, string $dtoClass, mixed $groups = [])
    {
        if ('json' !== $request->getContentTypeFormat()) {
            throw new BadRequestException('Unsupported content format');
        }

        return $this->serializer->deserialize(
            $request->getContent(),
            $dtoClass,
            'json',
            [
                AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false, // only properties exist in the DTO is allowed
                AbstractNormalizer::GROUPS => $groups,
            ]
        );
    }


}
