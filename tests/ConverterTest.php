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
class ConverterTest extends TestCase
{
    /**
     * @var Converter Class
     */
    private $converter;

    /**
     * @var Checker Class
     */
    private $checker;

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
        $this->converter = new Converter();
        $this->checker = new Checker();
    }

    /**
     * Convert images to base64
     *
     * return @void
     */
    public function testImageToBase64()
    {
        $resp = true;

        foreach ($this->samples as $sample) {
            $base64 = $this->converter->imageToBase64($sample);

            if (!$this->checker->isBase64Image($base64)) {
                $resp = false;
            }

            $this->assertTrue($resp, "testImageToBase64 [$sample]");
        }
    }
}