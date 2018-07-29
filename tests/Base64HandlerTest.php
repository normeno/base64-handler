<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * This file is part of the Base64 handler library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP Version 7
 *
 * LICENSE: This source file is subject to the MIT license that is available
 * through the world-wide-web at the following URI:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category Test
 * @package  Normeno\Base64Handler\Test
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/api_response
 */
namespace Normeno\Base64Handler\Test;

use Normeno\Base64Handler\Base64Handler;
use Normeno\Base64Handler\Converter;
use Normeno\Base64Handler\Utils;
use PHPUnit\Framework\TestCase;
use Normeno\Base64Handler\Checker;

/**
 * Tests for Format
 *
 * @category Test
 * @package  Normeno\ApiResponse\Test
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/api_response
 */
class Base64HandlerTest extends TestCase
{
    /**
     * @var Base64Handler Class
     */
    private $handler;

    /**
     * @var array static base64 samples
     */
    private $samples = [
        'png' => 'src/samples/image.png',
        'jpg' => 'src/samples/image.jpg'
    ];

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->classLoader();
    }

    /**
     * Load required classes
     *
     * @return void
     */
    public function classLoader()
    {
        $this->handler = new Base64Handler();
    }

    /**
     * Check if string is a valid base64
     *
     * @return void
     */
    public function testToBase64()
    {
        foreach ($this->samples as $sample) {
            $convert = $this->handler->toBase64($sample);
            $this->assertTrue(Checker::isBase64($convert), 'testToBase64');
        }
    }

    /**
     * Convert an url to base64
     *
     * @return void
     */
    public function testUrlToBase64()
    {
        $url = 'http://icons.iconarchive.com/icons/graphicloads/100-flat/256/home-icon.png';
        $convert = $this->handler->toBase64($url);

        $this->assertTrue(Checker::isBase64($convert), 'testToBase64');
    }
}