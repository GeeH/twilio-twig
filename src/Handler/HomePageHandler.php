<?php declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Response;

class HomePageHandler implements RequestHandlerInterface
{
    private $logger;
    private $twig;

    public function __construct(LoggerInterface $logger, \Twig\Environment $twig)
    {
        $this->logger = $logger;
        $this->twig = $twig;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->logger->info('Home page handler dispatched');

        $name = $request->getAttribute('name', 'world');
        $response = new Response();
        $response->getBody()->write(
            $this->twig->render('home-page.twig', ['name' => $name])
        );
        return $response;
    }
}
