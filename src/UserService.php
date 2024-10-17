<?php

namespace Raft\UserPackage;

class UserService extends ApiService {
    public function __construct() {
        //container name and original port
        $this->endpoint = env('USERS_MS') . '/api';
    }
}
