<?php

Validator::extend(Config::get('captcha::validator_name'), function($attribute, $value, $parameters)
{
    return Captcha::check($value);
});
