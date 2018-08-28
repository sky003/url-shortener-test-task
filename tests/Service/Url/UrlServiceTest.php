<?php

declare(strict_types = 1);

namespace App\Tests\Service\Url;

use App\Entity\ShortUrl;
use App\Entity\Url;
use App\Service\Url\Exception\UrlNotFoundException;
use App\Service\Url\UrlService;
use Doctrine\ORM\EntityManagerInterface;
use Hashids\Hashids;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UrlServiceTest extends Testcase
{
    public function testMakeShortUrl(): void
    {
        $entityManager = $this->getMockBuilder(EntityManagerInterface::class)
            ->getMock();
        $urlGenerator = $this->getMockBuilder(UrlGeneratorInterface::class)
            ->getMock();
        $urlGenerator
            ->expects($this->once())
            ->method('generate')
            ->willReturnCallback(function (string $name, array $params, int $referenceType) {
                $this->assertEquals(UrlGeneratorInterface::ABSOLUTE_URL, $referenceType);

                return 'http://127.0.0.1/gjddF4';
            });
        $hashids = $this->getMockBuilder(Hashids::class)
            ->getMock();
        $hashids
            ->expects($this->once())
            ->method('encode')
            ->willReturn('gjddF4');

        $url = new Url();
        $url
            ->setId(1);

        /** @var EntityManagerInterface $entityManager */
        /** @var UrlGeneratorInterface $urlGenerator */
        /** @var Hashids $hashids */
        $service = new UrlService($entityManager, $urlGenerator, $hashids);
        $shortUrl = $service->makeShortUrl($url);

        $this->assertEquals('gjddF4', $shortUrl->getId());
        $this->assertEquals('http://127.0.0.1/gjddF4', $shortUrl->getShortUrl());
    }

    public function testMakeUrl(): void
    {
        $entityManager = $this->getMockBuilder(EntityManagerInterface::class)
            ->getMock();
        $entityManager
            ->expects($this->once())
            ->method('find')
            ->willReturnCallback(function (string $className, int $id) {
                if (Url::class === $className) {
                    $url = new Url();
                    $url
                        ->setId($id);

                    return $url;
                }

                return null;
            });
        $urlGenerator = $this->getMockBuilder(UrlGeneratorInterface::class)
            ->getMock();
        $hashids = $this->getMockBuilder(Hashids::class)
            ->getMock();
        $hashids
            ->expects($this->once())
            ->method('decode')
            ->willReturn([15]);

        $shortUrl = new ShortUrl();
        $shortUrl
            ->setId('fdsGGf');

        /** @var EntityManagerInterface $entityManager */
        /** @var UrlGeneratorInterface $urlGenerator */
        /** @var Hashids $hashids */
        $service = new UrlService($entityManager, $urlGenerator, $hashids);
        $url = $service->makeUrl($shortUrl);

        $this->assertEquals(15, $url->getId());
    }

    public function testMakeUrlWhichNotExistInDatabase(): void
    {
        $entityManager = $this->getMockBuilder(EntityManagerInterface::class)
            ->getMock();
        $entityManager
            ->expects($this->once())
            ->method('find')
            ->willReturnCallback(function (string $className, int $id) {
                $this->assertEquals(15, $id);

                return null;
            });
        $urlGenerator = $this->getMockBuilder(UrlGeneratorInterface::class)
            ->getMock();
        $hashids = $this->getMockBuilder(Hashids::class)
            ->getMock();
        $hashids
            ->expects($this->once())
            ->method('decode')
            ->willReturn([15]);

        $shortUrl = new ShortUrl();
        $shortUrl
            ->setId('fdsGGf');

        /** @var EntityManagerInterface $entityManager */
        /** @var UrlGeneratorInterface $urlGenerator */
        /** @var Hashids $hashids */
        $service = new UrlService($entityManager, $urlGenerator, $hashids);

        $this->expectException(UrlNotFoundException::class);

        $service->makeUrl($shortUrl);
    }
}
