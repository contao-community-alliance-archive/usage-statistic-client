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

namespace ContaoCommunityAlliance\UsageStatistic\Client;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event to collect statistic data.
 */
class CollectDataEvent extends Event
{
    /**
     * The collected statistics data.
     *
     * @var array
     */
    protected $data = array();

    /**
     * Return the collected statistics data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Determine if a data value for the given name is set.
     *
     * @param string $name The data name.
     *
     * @return bool
     *
     * @throws \InvalidArgumentException If the data name is empty.
     * @throws \InvalidArgumentException If the data name is numeric.
     */
    public function has($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The data name must not be empty');
        }
        if (!is_string($name) || is_numeric($name)) {
            throw new \InvalidArgumentException('The data name must be a non-numeric string');
        }

        return isset($this->data[$name]);
    }

    /**
     * Return the data value for the given name, or null if no value was set.
     *
     * @param string $name The data name.
     *
     * @return integer|float|string|boolean|null
     *
     * @throws \InvalidArgumentException If the data name is empty.
     * @throws \InvalidArgumentException If the data name is numeric.
     */
    public function get($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The data name must not be empty');
        }
        if (!is_string($name) || is_numeric($name)) {
            throw new \InvalidArgumentException('The data name must be a non-numeric string');
        }

        return isset($this->data[$name])
            ? $this->data[$name]
            : null;
    }

    /**
     * Set the data value for the given name.
     *
     * @param string                       $name  The data name.
     * @param integer|float|string|boolean $value The data value.
     *
     * @return $this
     *
     * @throws \InvalidArgumentException If the data name is empty.
     * @throws \InvalidArgumentException If the data name is numeric.
     * @throws \InvalidArgumentException If the data value is empty.
     * @throws \InvalidArgumentException If the data value is not a scalar.
     */
    public function set($name, $value)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('The data name must not be empty');
        }
        if (!is_string($name) || is_numeric($name)) {
            throw new \InvalidArgumentException('The data name must be a non-numeric string');
        }
        if (empty($value)) {
            throw new \InvalidArgumentException('The data value must not be empty');
        }
        if (!is_scalar($value)) {
            throw new \InvalidArgumentException('The data value must be a scalar value');
        }

        $this->data[$name] = $value;

        return $this;
    }
}
