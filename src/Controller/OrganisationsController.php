<?php


namespace App\Controller;


use App\Services\OrganisationsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class OrganisationsController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function Home()
    {
        $organisations = OrganisationsService::loadYaml();
        return $this->render("body.html.twig", $organisations);
    }

    /**
     * @Route("/remove/{name}")
     */
    public function remove($name)
    {
        $organisations = OrganisationsService::loadYaml();
        var_dump($organisations);
        unset($organisations[0]);
        OrganisationsService::SaveYaml($organisations);

    }
}

