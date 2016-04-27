<?php

class CustomHasher implements Illuminate\Contracts\Hashing\Hasher{
    private $NUMBER_OF_ROUNDS = '$5$rounds=2016$';

    public function make($value, array $options = [])
    {
        // TODO: Implement make() method.
        $salt = uniqid();
        $hash = crypt($value, $this->NUMBER_OF_ROUNDS . $salt);
        return substr($hash, 15);
    }

    public function check($value, $hashedValue, array $options = [])
    {
        // TODO: Implement check() method.
        return $this->NUMBER_OF_ROUNDS . $hashedValue === crypt($value, $this->NUMBER_OF_ROUNDS . $hashedValue);
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        // TODO: Implement needsRehash() method.
        return false;
    }
}