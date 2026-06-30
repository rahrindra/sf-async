<?php

namespace App\Controller;

use App\DTO\User as UserDTO;
use App\Manager\UserManager;
use App\Service\AppSerializer;
use App\Service\DtoValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    public function __construct(
        protected readonly AppSerializer $serializer,
        protected readonly DtoValidator $dtoValidator,
        protected readonly UserManager $userManager,
    ) {
    }

    #[Route('/user/create', name: 'create_user', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $userDto = $this->serializer->deserialize($request, UserDTO::class);
            $this->dtoValidator->validate($userDto);

            $this->userManager->createUser($userDto);

            return $this->json('OK', Response::HTTP_CREATED);
        } catch (BadRequestHttpException $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
