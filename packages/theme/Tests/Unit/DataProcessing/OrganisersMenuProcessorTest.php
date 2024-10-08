<?php

declare(strict_types=1);

namespace Unit\DataProcessing;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Workshop\Theme\DataProcessing\OrganisersMenuProcessor;
use Workshop\Theme\Domain\Model\User;
use Workshop\Theme\Domain\Repository\UserRepository;

final class OrganisersMenuProcessorTest extends UnitTestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    #[Test]
    public function process(): void
    {
        $organiser = new User();
        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects(self::once())
            ->method('findOrganiser')
            ->willReturn($organiser);

        $varName = 'fooBar';

        $processedData = [
            'data' => [
                'module' => OrganisersMenuProcessor::MODULE,
            ],
        ];
        $processorConfiguration = ['foo' => 'bar'];

        $cObj = $this->createMock(ContentObjectRenderer::class);
        $cObj
            ->expects(self::once())
            ->method('stdWrapValue')
            ->with(
                self::equalTo('as'),
                $processorConfiguration,
                self::equalTo('organiser')
            )
            ->willReturn($varName);

        $expected = $processedData;
        $expected[$varName] = $organiser;

        $sut = new OrganisersMenuProcessor($repository);
        $actual = $sut->process($cObj, [], $processorConfiguration, $processedData);

        self::assertEquals($expected, $actual);
    }
}
