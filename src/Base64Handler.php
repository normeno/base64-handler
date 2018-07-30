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
 * Base64Handler Class
 *
 * @category src
 * @package  Normeno\Base64Handler
 * @author   Nicolas Ormeno <ni.ormeno@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php MIT License
 * @link     https://github.com/normeno/base64_handler
 */
class Base64Handler {

    /**
     * Convert file to base64
     *
     * @param string $path file path
     *
     *
     * @return string
     */
    public function toBase64(string $path)
    {
        try {
            $isUrl = filter_var($path, FILTER_VALIDATE_URL);

            if (!$isUrl && !Utils::isValidPath($path)) {
                throw new \Exception('Invalid Path', 404);
            }

            $file = file_get_contents($path);

            $resp = Utils::getExtFromFile($path);
            $resp['base64'] = base64_encode($file);

            return $resp;
        } catch (\Exception $e) {
            return "{$e->getMessage()} ({$e->getCode()})";
        }
    }

    /**
     * Convert Base64 to File
     *
     * @param string $base64 Base64 string
     *
     * @return string
     */
    public function toFile(string $base64)
    {
        try {
            if (!Checker::isBase64($base64)) {
                throw new \Exception('Invalid Base64', 409);
            }

            $resp = null;

            if (Checker::isBase64Image($base64)) {
                $resp = Converter::base64ToImage($base64);
            }

            return $resp;
        } catch (\Exception $e) {
            return "{$e->getMessage()} ({$e->getCode()})";
        }
    }

    /**
     * Return base64 type
     *
     * @param string $base64    Base64 string
     *
     * @return string
     */
    public function getBase64Type(string $base64)
    {
        try {
            if (!Checker::isBase64($base64)) {
                throw new \Exception('Invalid Base64', 409);
            }

            if (Checker::isBase64Image($base64)) {
                return 'image';
            } else {
                return 'unknown type';
            }
        } catch (\Exception $e) {
            return "({$e->getCode()}) {$e->getMessage()}";
        }
    }
}