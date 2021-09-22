<?php
/**
 * Project date-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 19:12
 */

namespace nguyenanhung\Libraries\DateAndTime;

use DateTime;
use DateTimeZone;
use Exception;

if (!class_exists('nguyenanhung\Libraries\DateAndTime\DateAndTime')) {
    class DateAndTime
    {
        /**
         * Function zuluTime
         *
         * @return string|null
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 08/18/2021 25:38
         */
        public static function zuluTime()
        {
            try {
                $dateUTC = new DateTime("now", new DateTimeZone("UTC"));

                return $dateUTC->format('Y-m-d\TH:i:s\Z');
            } catch (Exception $e) {
                return null;
            }
        }

        /**
         * Function expireTime
         *
         * @param int $duration
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2019-07-15 10:57
         *
         */
        public static function expireTime($duration = 1)
        {
            try {
                $expire     = $duration <= 1 ? new DateTime("+0 days") : new DateTime("+$duration days");
                $expireTime = $expire->format('Y-m-d') . ' 23:59:59';
            } catch (Exception $e) {
                $expireTime = date('Y-m-d') . ' 23:59:59';
            }

            return $expireTime;
        }

        /**
         * Function generateOTPExpireTime
         *
         * @param int $hour
         *
         * @return string
         * @throws \Exception
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-06 16:03
         *
         */
        public static function generateOTPExpireTime($hour = 4)
        {
            $time = new DateTime('+' . $hour . ' days');

            return $time->format('Y-m-d H:i:s');
        }
    }
}
