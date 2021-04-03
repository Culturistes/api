<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MeController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("admin/me", name="admin_me_password", methods={"GET", "POST"})
     */
    public function admin_me_password(Request $request, ValidatorInterface $validator)
    {
        $user = $this->getUser();
        $error = null;

        $form = $this->createFormBuilder()
            ->add('password', TextType::class, ['label' => 'Nouveau mot de passe', 'attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['label' => 'Modifier', 'attr' => ['class' => 'action-saveAndReturn btn btn-primary action-save']])
            ->getForm();

        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $result = $form->getData();

                $errors = $validator->validate($user);

                if (strlen($result['password']) >= 5) {
                    $user->setPassword($this->passwordEncoder->encodePassword(
                        $user,
                        $result['password']
                    ));
        
                    $entityManager = $this->getDoctrine()->getManager();
    
                    $entityManager->flush();

                    return $this->redirectToRoute('admin');
                }

                $error = 'Problème';
            }


        return $this->render('admin/me/password.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

}