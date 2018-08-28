<?php

declare(strict_types = 1);

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlControllerTest extends WebTestCase
{
    public function testCreate(): void
    {
        $client = static::createClient();

        $content = \json_encode([
            'longUrl' => 'http://example.com',
        ]);

        $client->request(
            'POST',
            '/api/v1/urls',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            $content
        );

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testCreateWithNotValidData(): void
    {
        $client = static::createClient();

        $content = \json_encode([
            'longUrl' => '#example.com',
            'expiredAt' => '2005-08-15T15:52:01+0000',
        ]);

        $client->request(
            'POST',
            '/api/v1/urls',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
            ],
            $content
        );

        $this->assertEquals(422, $client->getResponse()->getStatusCode());
    }
}
