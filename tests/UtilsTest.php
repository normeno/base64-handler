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

use Normeno\Base64Handler\Checker;
use Normeno\Base64Handler\Converter;
use Normeno\Base64Handler\Utils;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Format
 *
 * @category Test
 * @package  Normeno\ApiResponse\Test
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/api_response
 */
class UtilsTest extends TestCase
{
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
        //
    }

    /**
     * Clear string removing data
     *
     * @return void
     */
    public function testClearString()
    {
        foreach ($this->samples as $k => $v) {
            $base64 = Converter::imageToBase64($v);
            $clear = Utils::clearString($base64);

            $this->assertTrue((!$clear) ? false : true, "testClearString");
        }
    }

    /**
     * Check if a path is valid
     *
     * @return void
     */
    public function testIsValidPath()
    {
        foreach ($this->samples as $sample) {
            $this->assertTrue(Utils::isValidPath($sample), "testIsValidPath [$sample]");
        }
    }

    /**
     * Convert images to base64
     *
     * @return void
     */
    public function testGetExtFromBase64()
    {
        foreach ($this->samples as $k => $v) {
            $base64 = Converter::imageToBase64($v);

            if (!Checker::isBase64Image($base64)) {
                $this->assertTrue(false, "testGetExtFromBase64 [$v]");
                next();
            }

            $ext = Utils::getExtFromBase64($base64);

            if ($ext['ext'] == $k) {
                $assert = true;
            } else if (($ext['ext'] == 'jpeg' || $ext['ext'] == 'jpg')
                && ($k == 'jpeg' || $k == 'jpg')) {
                $assert = true;
            } else {
                var_dump($ext['ext']); exit;
                $assert = false;
            }

            $this->assertTrue($assert, "testGetExtFromBase64 [$v]");
        }
    }
}