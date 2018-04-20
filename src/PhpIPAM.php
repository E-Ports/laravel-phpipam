<?php

namespace Axsor\LaravelPhpIPAM;


use Axsor\LaravelPhpIPAM\Requests\IPRequest;
use Axsor\LaravelPhpIPAM\Requests\LocationRequest;
use Axsor\LaravelPhpIPAM\Requests\SectionRequest;
use Axsor\LaravelPhpIPAM\Requests\SubnetRequest;

class PhpIPAM
{
    /*##################################################################################################################
     *###############################################------ SECTION ------##############################################
     *################################################################################################################*/

    public static function sections()
    {
        return (new SectionRequest)->sections();
    }

    public static function section($section)
    {
        return (new SectionRequest)->section($section);
    }

    public static function sectionSubnets($section)
    {
        return (new SectionRequest)->subnets($section);
    }

    public static function sectionCustomFields($section)
    {
        return (new SectionRequest)->customFields($section);
    }


    /*##################################################################################################################
     *###############################################------ SUBNET ------###############################################
     *################################################################################################################*/

    public static function subnet($subnet)
    {
        return (new SubnetRequest)->subnet($subnet);
    }

    public static function subnetUsage($subnet)
    {
        return (new SubnetRequest)->usage($subnet);
    }

    public static function subnetFirstIPFree($subnet)
    {
        return (new SubnetRequest)->firstIPFree($subnet);
    }

    public static function subnetSlaves($subnet)
    {
        return (new SubnetRequest)->slaves($subnet);
    }

    public static function subnetAddresses($subnet)
    {
        return (new SubnetRequest)->addresses($subnet);
    }

    public static function subnetAddress($subnet, $ip)
    {
        return (new SubnetRequest)->address($subnet, $ip);
    }


    /*##################################################################################################################
     *##############################################------ ADDRESS ------###############################################
     *################################################################################################################*/

    public static function createFirstFreeAddress($subnet, $ip)
    {
        return (new IPRequest)->createFirstFree($subnet, $ip);
    }

    public static function createAddress($ip)
    {
        return (new IPRequest)->create($ip);
    }

    public static function tags()
    {
        return (new IPRequest)->tags();
    }


    /*##################################################################################################################
     *#############################################------ LOCATIONS ------##############################################
     *################################################################################################################*/

    public static function subnetLocations($location)
    {
        return (new LocationRequest)->subnets($location);
    }

    public static function deviceLocations($location)
    {
        return (new LocationRequest)->devices($location);
    }

    public static function rackLocations($location)
    {
        return (new LocationRequest)->racks($location);
    }
}
