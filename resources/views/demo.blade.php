@extends('layouts.app')
<?php
Mail::raw('Text to e-mail', function($message)
{
    $message->from('abc@gmail.com', 'Laravel');

    $message->to('chitwaniit@gmail.com');
});
?>
    