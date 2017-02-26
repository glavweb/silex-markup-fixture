<?php

/*
 * This file is part of the SilexMarkupFixture package.
 *
 * (c) Andrey Nilov <nilov@glavweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glavweb\SilexMarkupFixture\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Glavweb\MarkupFixture\Helper\MarkupFixtureHelper;
use Glavweb\MarkupFixture\Manager\MarkupFixtureManager;

/**
 * MarkupFixtureManagerServiceProvider
 *
 * @package Glavweb\SilexMarkupFixture
 * @author Andrey Nilov <nilov@glavweb.ru>
 */
class MarkupFixtureManagerServiceProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    private $hostUrl;

    /**
     * @var array
     */
    private $fixtureObjects;

    /**
     * MarkupFixtureManagerServiceProvider constructor.
     *
     * @param string $hostUrl
     * @param array  $fixtureObjects
     */
    public function __construct($hostUrl, array $fixtureObjects)
    {
        $this->hostUrl        = $hostUrl;
        $this->fixtureObjects = $fixtureObjects;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['markup_fixture_manager'] = function () use ($app) {
            $markupFixtureHelper = new MarkupFixtureHelper($this->hostUrl);

            return new MarkupFixtureManager(
                $markupFixtureHelper,
                $this->fixtureObjects
            );
        };
    }
}
