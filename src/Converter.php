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
class Converter
{
    /**
     * Convert image to base64
     *
     * @param string $file image's path
     * @see https://stackoverflow.com/a/13758760/2901396
     *
     * @return bool|string
     */
    public static function imageToBase64($file)
    {
        try {
            $type = pathinfo($file, PATHINFO_EXTENSION);
            $data = file_get_contents($file);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Convert base64 to image
     *
     * @param string $base64    Base64 string
     * @param string $dest      destination path
     *
     * @return array|string
     */
    public static function base64ToImage(string $base64, string $dest = '')
    {
        try {
            if ($dest == '') {
                $dest = getcwd() . '/src/tmp';
            }

            $base64 = Utils::clearString($base64);

            $resp = Utils::getExtFromBase64($base64);
            $filename = md5(time().uniqid()) . '.' . $resp['ext'];
            $base64 = Utils::clearString($base64);
            $resp['path'] = $dest . '/' . $filename;

            file_put_contents($resp['path'], base64_decode($base64));
            unlink($resp['path']);

            return $resp;
        } catch (\Exception $e) {
            return "{$e->getMessage()}: ({$e->getCode()})";
        }
    }
}