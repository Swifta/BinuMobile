<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function word_trim($string, $count, $ellipsis = FALSE) {

        if (strlen($string) > $count) {
            $string = substr($string, 0, strrpos(substr($string, 0, $count), ' '));
            if (is_string($ellipsis)) {
                $string .=$ellipsis;
            } else if ($ellipsis) {
                $string .= '...';
                
            }
        }
        return $string.'?';
    }
?>
