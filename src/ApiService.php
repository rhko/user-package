<?php

namespace Raft\UserPackage;

use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class ApiService {

    protected string $endpoint;

    public function makeRequest($method, $path, $data = []) {
        $response = $this->doRequest($method, $path, $data);

        if($response->ok()) {
            return $response->json();
        }

        throw new HttpException($response->status(), $response->body());
    }

    public function doRequest($method, $path, $data = []) {
        return \Http::acceptJson()->withHeaders([
            'Authorization' => 'Bearer ' . request()->cookie('jwt')
        ])->$method("{$this->endpoint}/{$path}", $data);
    }

    public function post($path, $data = []) {
        return $this->makeRequest('post', $path, $data);
    }

    public function get($path) {
        return $this->makeRequest('get', $path);
    }

    public function put($path, $data = []) {
        return $this->makeRequest('put', $path, $data);
    }

    public function delete($path) {
        return $this->makeRequest('delete', $path);
    }
}
