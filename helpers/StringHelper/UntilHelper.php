<?php
/**
 *User:ywn
 *Date:2021/5/30
 *Time:19:48
 */

namespace app\helpers\StringHelper;


class UntilHelper
{
   public static function randomString($n): string
   {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }
        return $str;
    }
}