<?php
/**
 * Callback function
 */
function menufun_hello($first_name = '', $last_name = '', $from_city = '', $from_country = '') {
    return t('Hello, @first_name @last_name from @from_first_name, @from_last_name',
             array(
                  '@first_name' => $first_name,
                  '@last_name' => $last_name,
                  '@from_first_name' => $from_city,
                  '@from_last_name' => $from_country));
}

function menufun_farewell() {
    return t('Goodbye!');
}