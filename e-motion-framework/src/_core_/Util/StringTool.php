<?php

/*
 * This is a part of E-motion project.
 * Author: Dylan <dylanfj700@gmail.com>
 * (c) Copyright
 * For full copyright and licence information please see LICENCE.txt file included in the project root
*/

namespace E_motion\Core\Util;

class StringTool
{
    public static function keepOnlyNumbers(string $str): string
    {
        return \preg_replace('#[^0-9]#','',\preg_quote($str,'#'));
    }

    public static function getNoSpaces(string $str): string
    {
        return \str_replace(' ','',$str);
    }

    public static function getOneSpace(string $str): string
    {
        return \preg_replace('# {2,}#',' ',\preg_quote($str,'#'));
    }

    public static function replaceSpacesByDashes(string $str): string
    {
        return \str_replace(' ','-',$str);
    }

    public static function removeAnySpace(string $str): string
    {
        return \preg_replace('#[\s]#','',\preg_quote($str,'#'));
    }

    public function keepOnlyAnySpace(string $str): string
    {
        return \preg_replace('#[\S]#','',\preg_quote($str,'#'));
    }

    // return false if a variarble or all variable not empty
    public static function isEmpty(string ...$var): bool
    {
        $empty = true;
        $args = [];
        $args = \func_get_args();
        $nb = 0;
        $nb = \func_num_args();

        if($nb > 1) {
            for($i = 0; $i < $nb; $i++) {
                $empty = empty($args[$i])? true : false;

                //stop the loop when one value is empty
                if($empty==true) break;
            }
        } else if ( $nb===1 ) {
            $empty = empty($var) ? true : false;
        } else {
            throw new \InvalidArgumentException('Function is_empty : Total of arguments is invalid, 0 given !');
        }

        return $empty;
    }

    public static function removeNumbers(string $str): string
    {
        return \preg_replace('#[0-9]#','', \preg_quote($str,'#'));
    }

    public static function getStringInInterval(string $subject, int $start, int $end, string $included='none'): string
    {
        $str = '';
        if($end>$start) {
            switch($included) {
                case 'all':
                    $len = \abs($end - $start)+1;
                    $str = \substr($subject,$start,$len);
                    break;

                case 'end':
                    $len = \abs($end - $start);
                    $str = \substr($subject,$start+1,$len);
                    break;

                case 'start':
                    $len = \abs($end - $start);
                    $str = \substr($subject,$start,$len);
                    break;

                default:
                    $len = \abs($end - $start)-1;
                    $str = \substr($subject,$start+1,$len);
                    break;
            }
        }
        return $str;
    }

    public static function removeDashes(string $str): string
    {
        return \str_replace('-','',$str);
    }

    function removeUnderscores(string $str): string
    {
        return \str_replace('_','',$str);
    }

    public static function isLengthBetween(string $str, int $min, int $max, string $interval_type='open_all'): bool
    {
        $s = \strlen($str);
        $ok = false;
        switch($interval_type) {
            //min and mox not included
            case 'open_all':
                $ok = $s>$min && $s<$max;
                break;

            //min included and max included
            case 'close_all':
                $ok = $s>= $min && $s <=$max;
                break;

            //min included but max no
            case 'close_left':case 'open_right':
            $ok = $s>=$min && $s<$max;
            break;

            //min not included but max yes
            case 'close_right': case 'open_left':
            $ok = $s>$min && $s<=$max;
            break;

            default:
                try {
                    throw new \InvalidArgumentException('Function string_length : invalid arugement \''.$interval_type.'\'');
                } catch (\InvalidArgumentException $e) {
                    die($e->getMessage());
                }
                break;
        }
        return $ok;
    }

    public function varReplace($var, $replace, string $subject): string
    {
        return \str_replace('{{ '.$var.' }}',$replace,$subject);
    }
}
