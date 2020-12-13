<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    /**
     * Get request body content
     *
     * @param Request $request
     *
     * @return array
     */
    public function getRequestContent(Request $request): array
    {
        return (array)json_decode($request->getContent(), true);
    }

    /**
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function respondSuccess($data = null): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function respondError(): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => 'An unexpected error occurred. Please try again.',
        ]);
    }
}
