<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * This file is part of the Base64 Handler library.
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
 * @category Src
 * @package  Normeno\Base64Hanlder
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/base64_handler
 */
namespace Normeno\Base64Handler;

/**
 * Checker Class
 *
 * @category src
 * @package  Normeno\Base64Handler
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/base64_handler
 */
class Checker
{
    /**
     * Check if string is a base64 string
     *
     * @param string $str base64 string
     *
     * @return bool
     */
    public function isBase64($str) {
        try {
            return ( base64_encode(base64_decode($str, true)) === $str) ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if base64 string is an image
     *
     * @see https://stackoverflow.com/a/12658754/2901396
     * @param string $str base64 string
     *
     * @return bool
     */
    public function isBase64Image($str)
    {
        $str = Utils::clearString($str);
        $img = imagecreatefromstring(base64_decode($str));

        if (!$img) {
            return false;
        }

        imagepng($img, 'tmp.png');
        $info = getimagesize('tmp.png');

        unlink('tmp.png');

        if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
            return true;
        }

        return false;
    }
}