<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Samils\Application
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Sammy\Packs\Samils\Application {
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!class_exists('Sammy\Packs\Samils\Application\Configure')){
  /**
   * @class Configure
   * Base internal class for the
   * Samils\Application module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  class Configure {
    /**
     * @var env_conf
     * - Environment Configurations
     * - Application Configurations Based on
     * - a set ils environment
     */
    private static $env_conf = [];

    public static function def ($prop = null, $val = null) {
      if (!(is_string($prop) && $prop)) {
        if (is_array($prop)) {
          foreach ($prop as $key => $val) {
            self::def ($key, $val);
          }
        }

        return;
      }

      $gogueConfigCompiler = requires ('gogue-plugin-config-compiler');

      // Create an array based on the given value and key
      // [ 'key' => {value} ]
      $configArray = $gogueConfigCompiler (
        [ $prop => $val ]
      );

      self::$env_conf = ArrayFullMerge::ArrayFullMerge (
        self::$env_conf, $configArray
      );
    }

    public static function get ($prop = null) {
      if (is_string ($prop) && isset (self::$env_conf [ $prop ])) {
        return self::$env_conf [ $prop ];
      }
    }

    public static function getEnvironmentConf () {
      return self::$env_conf;
    }
  }}
}
