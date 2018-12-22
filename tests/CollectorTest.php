<?php

/**
 * This file is part of contao-community-alliance/usage-statistic-client.
 *
 * (c) 2013-2018 Contao Community Alliance.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    contao-community-alliance/usage-statistic-client
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2013-2018 Contao Community Alliance.
 * @license    https://github.com/contao-community-alliance/usage-statistic-client/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace ContaoCommunityAlliance\UsageStatistic\Client\Test;

use ContaoCommunityAlliance\Contao\Events\Cron\CronEvents;
use ContaoCommunityAlliance\UsageStatistic\Client\Collector;
use Guzzle\Http\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CollectorTest extends TestCase
{
    /**
     * @covers \ContaoCommunityAlliance\UsageStatistic\Client\Collector::checkInstallation
     */
    public function testCheckInstallation()
    {
        $collector = new Collector();
        $class     = new \ReflectionClass($collector);
        $method    = $class->getMethod('checkInstallation');
        $method->setAccessible(true);

        $GLOBALS['TL_CONFIG'] = array('encryptionKey' => '');
        $this->assertFalse($method->invoke($collector));

        $GLOBALS['TL_CONFIG'] = array('encryptionKey' => 'abcdefg');
        $this->assertTrue($method->invoke($collector));
    }

    /**
     * @covers \ContaoCommunityAlliance\UsageStatistic\Client\Collector::checkServerAddress
     */
    public function testCheckServerAddress()
    {
        $collector = new Collector();
        $class     = new \ReflectionClass($collector);
        $method    = $class->getMethod('checkServerAddress');
        $method->setAccessible(true);

        // check no addr available
        $_SERVER['SERVER_ADDR'] = '';
        $this->assertFalse($method->invoke($collector));

        // check addr available
        $_SERVER['SERVER_ADDR'] = '123.45.67.89';
        $this->assertTrue($method->invoke($collector));
    }

    /**
     * @covers \ContaoCommunityAlliance\UsageStatistic\Client\Collector::getInstallationId
     */
    public function testGetInstallationId()
    {
        $this->markTestIncomplete('This test must defined');
    }
}
