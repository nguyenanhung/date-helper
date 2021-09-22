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
    /**
     * Class DateAndTime
     *
     * @package   nguyenanhung\Libraries\DateAndTime
     * @author    713uk13m <dev@nguyenanhung.com>
     * @copyright 713uk13m <dev@nguyenanhung.com>
     */
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

        /**
         * Function filterDate
         *
         * @param string $inputDate
         *
         * @return array
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 09/22/2021 25:54
         */
        public static function filterDate($inputDate = '')
        {
            if ($inputDate !== '') {
                // Get date
                if ($inputDate === 'back_1_day') {
                    try {
                        $dateTime = new DateTime("-1 day");
                        $result   = array(
                            'date'       => $dateTime->format('Y-m-d'),
                            'day'        => $dateTime->format('Ymd'),
                            'month'      => $dateTime->format('Y-m'),
                            'monthTable' => $dateTime->format('Y_m'),
                            'week'       => $dateTime->format('w'),
                            'months'     => $dateTime->format('m'),
                            'year'       => $dateTime->format('Y'),
                        );
                    } catch (Exception $e) {
                        if (function_exists('log_message')) {
                            $message = 'Error Code: ' . $e->getCode() . ' - File: ' . $e->getFile() . ' - Line: ' . $e->getLine() . ' - Message: ' . $e->getMessage();
                            log_message('error', $message);
                        }
                        $result = array(
                            'date'       => date('Y-m-d', strtotime("-1 day", strtotime($inputDate))),
                            'day'        => date('Ymd', strtotime("-1 day", strtotime($inputDate))),
                            'month'      => date('Y-m', strtotime("-1 day", strtotime($inputDate))),
                            'monthTable' => date('Y_m', strtotime("-1 day", strtotime($inputDate))),
                            'week'       => date('w', strtotime("-1 day", strtotime($inputDate))),
                            'months'     => date('m', strtotime("-1 day", strtotime($inputDate))),
                            'year'       => date('Y', strtotime("-1 day", strtotime($inputDate)))
                        );
                    }
                } else {
                    $result = array(
                        'date'       => date('Y-m-d', strtotime($inputDate)),
                        'day'        => date('Ymd', strtotime($inputDate)),
                        'month'      => date('Y-m', strtotime($inputDate)),
                        'monthTable' => date('Y_m', strtotime($inputDate)),
                        'week'       => date('w', strtotime($inputDate)),
                        'months'     => date('m', strtotime($inputDate)),
                        'year'       => date('Y', strtotime($inputDate)),
                    );
                }
            } else {
                $result = array(
                    'date'       => date('Y-m-d'),
                    'day'        => date('Ymd'),
                    'month'      => date('Y-m'),
                    'monthTable' => date('Y_m'),
                    'week'       => date('w'),
                    'months'     => date('m'),
                    'year'       => date('Y'),
                );
            }

            return $result;
        }
    }
}
