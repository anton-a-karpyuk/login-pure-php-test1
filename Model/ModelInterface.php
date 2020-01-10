<?php


namespace TestApp;


interface ModelInterface
{
    public static function get(array $options) : array;
    public static function getOne(array $options) : ?object;
    public function insert();
    public function update();
    public function remove();
}