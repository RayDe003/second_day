<?php
namespace Src;

use Error;

class Request
{
    protected array $body;
    public string $method;
    public array $headers;

    public function __construct()
    {
        $this->body = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders() ?? [];
    }

    public function all(): array
    {
        return $this->body + $this->files();
    }

    public function set($field, $value):void
    {
        $this->body[$field] = $value;
    }

    public function get($field)
    {
        return $this->body[$field];
    }

    public function files(): array
    {
        return $_FILES;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->body)) {
            return $this->body[$key];
        }
        throw new Error('Accessing a non-existent property');
    }

    public function has($key)
    {
        return isset($this->body[$key]);
    }


    public function query($key, $default = null)
    {
        return $this->input($key, $default);
    }

    public function input($key, $default = null)
    {
        return isset($this->body[$key]) ? $this->body[$key] : $default;
    }

}
