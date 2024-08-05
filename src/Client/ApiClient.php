<?php

namespace App\Client;

use App\Logger\Message as LoggerMessage;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpClient\DecoratorTrait;
use Symfony\Component\HttpClient\Exception\JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiClient implements HttpClientInterface, LoggerAwareInterface
{
    use DecoratorTrait;
    use LoggerAwareTrait;

    public function get(string $url, array $options = []): ?array
    {
        $data = null;
        $response = null;

        try {
            $response = $this->request('GET', $url, $options);

            $statusCode = $response->getStatusCode();
            $headers = $response->getHeaders(false);
            $data = $response->toArray(false);

            if (Response::HTTP_OK === $statusCode) {
                $data = ['data' => $data];
            } else {
                $data = ['error' => $data + ['statusCode' => $statusCode]];

                $this->logger?->warning(...new LoggerMessage(
                    '[ApiClient::'.__FUNCTION__.'] Nepodarilo sa získať dáta',
                    HttpException::fromStatusCode(
                        statusCode: $statusCode,
                        message: 'Bad HTTP response status code.',
                        headers: $headers,
                    ),
                    [
                        'url' => $response->getInfo('url'),
                        ...$data['error'],
                        'debug' => $response->getInfo('debug'),
                    ],
                ));
            }
        } catch (JsonException $e) {
            $this->logger?->error(...new LoggerMessage(
                '[ApiClient::'.__FUNCTION__.'] Nepodarilo sa získať dáta',
                $e,
                [
                    'url' => $response->getInfo('url'),
                    'content' => $response->getContent(false),
                    'debug' => $response->getInfo('debug'),
                ],
            ));
        } catch (\Exception $e) {
            $contextData = [];

            if ($response) {
                $contextData['url'] = $response->getInfo('url');
                $contextData['debug'] = $response->getInfo('debug');
            }

            $this->logger?->critical(...new LoggerMessage(
                '[ApiClient::'.__FUNCTION__.'] Nepodarilo sa získať dáta',
                $e,
                $contextData,
            ));
        }

        return $data;
    }
}
