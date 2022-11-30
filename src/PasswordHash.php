<?php

namespace Hautelook\Phpass;

class PasswordHash
{

    private $cost;

    /**
     * Constructor
     *
     * @param int $iteration_count_log2
     * @param boolean $portable_hashes
     */
    public function __construct($iteration_count_log2, $portable_hashes)
    {
        if ($iteration_count_log2 < 4 || $iteration_count_log2 > 31) {
            $iteration_count_log2 = 8;
        }

        $this->cost = $iteration_count_log2;
    }

    /**
     * @param  int $count
     * @return String
     */
    public function get_random_bytes($count)
    {
        if(version_compare(PHP_VERSION, '7.0.0') >= 0 ) {
            return random_bytes($count);
        } else {
            return openssl_random_pseudo_bytes($count);
        }
        
    }

    /**
     * @param String $password
     */
    public function HashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, [
            'cost' => $this->cost
        ]);
    }

    /**
     * @param String $password
     * @param String $stored_hash
     * @return boolean
     */
    public function CheckPassword($password, $stored_hash)
    {
        return password_verify($password, $stored_hash);
    }

    /**
     * @param  String $input
     * @param  int $count
     * @return String
     */
    public function encode64($input, $count)
    {
        trigger_error('Encoding no longer supported.', E_USER_ERROR);
    }

    /**
     * @param  String $input
     * @return String
     */
    public function gensalt_private($input)
    {
        trigger_error('Generating salts directly no longer supported.');
    }

    /**
     * @param  String $password
     * @param  String $setting
     * @return String
     */
    public function crypt_private($password, $setting)
    {

        trigger_error('crypt_private no longer supported.', E_USER_ERROR);
    }

    /**
     * @param  String $input
     * @return String
     */
    public function gensalt_extended($input)
    {
        trigger_error('Generating salts directly no longer supported.', E_USER_ERROR);
    }

    /**
     * @param  String $input
     * @return String
     */
    public function gensalt_blowfish($input)
    {
        trigger_error('Generating salts directly no longer supported.', E_USER_ERROR);
    }
}
