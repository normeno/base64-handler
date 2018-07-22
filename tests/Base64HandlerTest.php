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

use PHPUnit\Framework\TestCase;
use Normeno\Base64Handler\Base64Handler;

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
    private $png = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEEAAABBCAQAAAAk/gHOAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADfsAAA37AQt3NZsAAAAHdElNRQfiBwcULyiEKW+7AAACrElEQVRo3u2ZP2gTURzHPy2xjfhfIR4UlIIEooNOFgQtJh2EtoNIQRwEBxe3goX4B8FBLAoScDCLi1Do4ODgoIOCdFCEamKhdBAMitBqC5WmmJSWc/DlfJdc7l/vnTfc94Z378+998l7v/vd+72ArBp6YNddfClIBJ8QwSL4gggawRVEwrK0xEt/KwmkuCTl8sA1P7NQ9A0Ax7zOROcmBnOrvD2ESoSaOwiVCGPMuIFQibBIlk/OEGptYZEsZScI1ea4RI6SPYT6N2KJHB/tIBKeuvOmAXaLu6ccocuAsHVWalyTg9sOwzW1avT/I5gUAYTgzXGW3rZ1d7gQBsIalbZ1K1aFEViIGCFGiBFkdYj0Dd3AcZH/wRclo/WSAkDnPVCnX0ao0R36z6+ThEgsRAQQmr8R3/msfMxD9FgVN/ZLhRB+dkGMJUKdCCxEjAD2W5YhBpjhMQA5hqlQIMewqc0HnnCWfupcZwOANFeAInP0MAZcZd0dipU5jqPzTNzn0XknUvmapGFeF0XLSXR0ztDYzidbxmoyR68btxcsA0MMMstDkF7hG0ywwWFGglwIK5UoARqDfGsKeNKcZ4Jb3q3LCeG0CEpTDu2+coCblBlhnn1sCRJhJ0dd9fOWCqd4Tif3vB71OU3bKzJkyPDAsafbwEEWvMejTrNQZQ6An449vWaKk9znd9AIXjTKOR61lJbRAZjisnqEaaYtStMirTg9buWatqMZhxTb0Nhrqtlj5HagsUt6bj8aXUACTbr+tffgmqpUjftVVtvUwEpTrLgg0nXm3UxeBD5TMQK02kJ2U0dd7nTCnI3jiIggNGxhmSQYDmbNu6d3pa3GGewv5P8rJAVx+mqnotkv/lUEFiJGgHafqT7GlYzWZ1XYYcqF5aDqcnQRgYWIEQD+AAHFa3nPii9lAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE4LTA3LTA3VDIwOjQ3OjQwKzAyOjAw6dVg1gAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxOC0wNy0wN1QyMDo0Nzo0MCswMjowMJiI2GoAAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC";
    private $b64;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->b64 = new Base64Handler();
    }

    /**
     * Check if string is a valid base64
     */
    public function testIsBase64()
    {
        $validator = $this->b64->isBase64($this->png);
        $this->assertTrue($validator, 'testIsBase64');
    }

    /**
     * Check if string is a base64 image
     */
    public function testIsImage()
    {
        $isImage = $this->b64->isImage($this->png);
        $this->assertTrue($isImage, 'isImage');
    }
}