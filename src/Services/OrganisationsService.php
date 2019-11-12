<?php


namespace App\Services;


use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class OrganisationsService
{
    public static function loadYaml($filename = "organizations.yaml")
    {
        // TODO Remove hard coded path
        try {
            $file = Yaml::parse(file_get_contents($filename));
        } catch (ParseException $exception) {
            printf('Unable to parse the YAML File: %s', $exception->getMessage());
        }
        return $file;
    }

    public static function SaveYaml($data)
    {
        $yaml = Yaml::dump($data);
        file_put_contents('organizations.yaml', $yaml);
    }

    public static function RemoveFromYaml($organisations, $name)
    {
        foreach ($organisations["organizations"] as $key => $data) {
            if ($data["name"] == $name) {
                unset($organisations["organizations"][$key]);
            }
        }
        return $organisations;
    }

}