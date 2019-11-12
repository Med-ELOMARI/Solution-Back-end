<?php


namespace App\Services;


use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class OrganisationsService
{
    public static function loadYaml()
    {
        // TODO Remove hard coded path
        try {
            $file = Yaml::parse(file_get_contents('organizations.yaml'));
        } catch (ParseException $exception) {
            printf('Unable to parse the YAML File: %s', $exception->getMessage());
        }
        return $file;
    }
    public static function SaveYaml($data){
        $yaml = Yaml::dump($data);
        file_put_contents('file.yaml', $yaml);
    }

}