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
        'png' => 'samples/image.png',
        'jpg' => 'samples/image.jpg',
        'svg' => 'samples/image.svg',
        'doc' => 'samples/file.doc',
        'docx' => 'samples/file.docx',
        'xls' => 'samples/file.xls',
        'xlsx' => 'samples/file.xlsx',
        'pdf' => 'samples/file.pdf',
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
            $assert = array_key_exists('base64', $convert) && Checker::isBase64($convert['base64']);
            $this->assertTrue($assert, 'testToBase64');
        }
    }

    public function testToFile()
    {
        foreach ($this->samples as $sample) {
            $convert = $this->handler->toBase64($sample);
            $assert = array_key_exists('base64', $convert) && Checker::isBase64($convert['base64']);

            if (!$assert) {
                $this->assertTrue($assert, 'testToBase64');
            } else {
                $toFile = $this->handler->toFile($convert['base64'], $convert['ext']);
                $this->assertTrue((!empty($toFile) && !empty($toFile['path'])), 'testToBase64');
            }
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
        $assert = array_key_exists('base64', $convert) && Checker::isBase64($convert['base64']);
        $this->assertTrue($assert, 'testUrlToBase64');
    }

    /**
     * Convert an url to base64
     *
     * @return void
     */
    public function testBase64UrlToFile()
    {
        $url = 'http://icons.iconarchive.com/icons/graphicloads/100-flat/256/home-icon.png';
        $base64 = $this->handler->toBase64($url)['base64'];
        $convert = Converter::base64ToImage($base64);
        $assert = array_key_exists('path', $convert);
        $this->assertTrue($assert, 'testBase64UrlToFile');
    }

    /**
     * Check base64 type
     *
     * @return void
     */
    public function testGetBase64Type()
    {
        foreach ($this->samples as $k => $v) {
            $base64 = $this->handler->toBase64($v);

            if ($base64['type'] == 'image' || $base64['type'] == 'file') {
                $assert = true;
            } else if ($base64['type'] == 'unknown') {
                $assert = false;
            } else {
                $assert = false;
            }

            $this->assertTrue($assert, "testGetBase64Type [$k] [{$base64['type']}]");
        }
    }
}