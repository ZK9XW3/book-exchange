<?php

declare(strict_types=1);

namespace App\Adapters\Primary\Symfony\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class TestController
{
    #[Route('/test', name: self::class, methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response('Hello World');
    }
}