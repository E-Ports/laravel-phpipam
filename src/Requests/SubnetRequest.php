<?php

namespace Axsor\LaravelPhpIPAM\Requests;


use Axsor\LaravelPhpIPAM\Models\IPs\IPCollection;
use Axsor\LaravelPhpIPAM\Models\Subnets\Subnet;
use Axsor\LaravelPhpIPAM\Models\Subnets\SubnetUsage;
use Axsor\LaravelPhpIPAM\Connection;

class SubnetRequest extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get especific subnet
     *
     * @param $id
     * @return \Axsor\LaravelPhpIPAM\Models\Subnets\Subnet
     */
    public function subnet($id)
    {
        return new Subnet(parent::get('subnets/' . $id . '/')['data']);
    }

    /**
     * Get subnet usage
     *
     * @param $subnet
     * @return \Axsor\LaravelPhpIPAM\Models\Subnets\SubnetUsage
     */
    public function usage($subnet)
    {
        return new SubnetUsage(parent::get("subnets/{$subnet}/usage/")['data']);
    }

    /**
     * Get first ip free of subnet
     *
     * @param $subnet
     * @return mixed
     */
    public function firstIPFree($subnet)
    {
        $response = parent::get("subnets/{$subnet}/first_free/");

        return array_key_exists('data', $response) ? $response['data'] : null;
    }


    // TODO Return into laravel collection of models
    public function slaves($subnet)
    {
        $result = parent::get("subnets/{$subnet}/slaves/");

        return self::hasContent($result) ? $result['data'] : $result['message'];
    }

    // TODO Return into laravel collection of laravel collection of models
    public function slavesRecursive()
    {

    }

    /**
     * Get all ips from subnet
     *
     * @param $subnet
     * @return IPCollection
     */
    public function addresses($subnet)
    {
        $response = parent::get("subnets/{$subnet}/addresses/");

        return array_key_exists('data', $response) ? new IPCollection($response['data']) : new IPCollection();
    }

    /**
     * Return ips of subnet
     *
     * @param $subnet
     * @param $ip
     * @return IPCollection
     */
    public function address($subnet, $ip)
    {
        return new IPCollection(parent::get("subnets/{$subnet}/addresses/{$ip}/")['data']);
    }

    /**
     * Creates a subnet
     *
     * @param $subnet
     * @return mixed
     */
    public function create($subnet)
    {
        return parent::post("subnets/", $subnet);
    }

    /**
     * Creates and returns a subnet
     *
     * @param $subnet
     * @return Subnet|null
     */
    public function createAndGet($subnet)
    {
        $response = $this->create($subnet);

        return array_key_exists('id', $response) ? $this->subnet($response['id']) : null;
    }
}
