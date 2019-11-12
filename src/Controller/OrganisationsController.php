<?php


namespace App\Controller;


use App\Entity\organisation;
use App\Form\Type\OrganisationType;
use App\Services\OrganisationsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class OrganisationsController extends AbstractController
{
    /**
     * @Route("/",name="index")
     */
    public function Home()
    {
        $organisations = OrganisationsService::loadYaml();
            return $this->render("body.html.twig", $organisations);
    }


    /**
     * @Route("/add",name="add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request)
    {
        $name = $request->request->get('name');
        $description = $request->request->get('description');

        $uname = $request->request->get('username');
        $upass = $request->request->get('userpass');
        $rols = $request->request->get('roles');

        $users = array('name' => $uname, 'role' => $rols, 'password' => $upass);

        for ($i = 1; $i <= (count($request->request) - 2) / 3; $i++) {
            $uname = $request->request->get('username' . $i);
            $upass = $request->request->get('userpass' . $i);
            $rols = $request->request->get('roles' . $i);
            $temp = array('name' => $uname, 'role' => $rols, 'password' => $upass);
            array_push($users, $temp);

        }
        $organisations = OrganisationsService::loadYaml();
        $new_org = array('name' => $name, 'description' => $description, 'users' => $users);
        array_push($organisations['organizations'], $new_org);
        OrganisationsService::SaveYaml($organisations);
        return $this->redirect($this->generateUrl('index'));


    }

    /**
     * @Route("/remove/{name}")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove($name)
    {
        $organisations = OrganisationsService::RemoveFromYaml(OrganisationsService::loadYaml(), $name);
        OrganisationsService::SaveYaml($organisations);
        return $this->redirect($this->generateUrl('index'));

    }

    /**
     * @Route("/reset")
     */
    public function reset()
    {
        $organisations = OrganisationsService::loadYaml("organizations.yaml.BACKUP");
        OrganisationsService::SaveYaml($organisations);
        return $this->redirect($this->generateUrl('index'));

    }

    // Todo use the form to add data , this endpoint still not used !

    /**
     * @Route("/form",)
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function form(Request $request)
    {
        $org = new organisation();

        $form = $this->createForm(OrganisationType::class, $org);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $data = $form->getData();
            var_dump($data);


            // Todo : use form to add the orgs ... now using html to sunmit

            return $this->redirectToRoute('index');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}

