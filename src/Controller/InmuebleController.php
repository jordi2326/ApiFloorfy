<?php

namespace App\Controller;

use App\Repository\TourRepository;
use App\Repository\InmuebleRepository;
use App\Entity\Inmueble;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InmuebleController
 * @package App\Controller
 *
 * @Route(path="/api")
 */

class InmuebleController extends AbstractController
{

    private  $InmuebleRepository;# Se genera variable global para poder utilizar las funciones del repositorio


    public function __construct(InmuebleRepository $InmuebleRepository ) # Se inicializa la viariable
    {
        $this->InmuebleRepository = $InmuebleRepository;

    }

    #[Route('/property/add', name: 'inmueble', methods: ['POST'])]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true); # Se obtiene la información del postman
        if ($data['Titulo'] == null || $data['Descripcion'] == null ) throw new NotFoundHttpException('No se informan los campos de manera correcta');
        $Inmueble = new Inmueble();# Creamos el objeto Inmueble
        $Inmueble->setTitulo($data['Titulo']); # Se asigna a la clase inmueble la propiedad título
        $Inmueble->setDescripcion($data['Descripcion']); # Se asigna a la clase inmueble la propiedad descripción

        $this->InmuebleRepository->save($Inmueble); # Se llama la función para que haga el post en la bd

        return new JsonResponse(['status' => 'Inmueble created!'], Response::HTTP_CREATED); # Genera la respuesta en el postman con un 201 ok
    }

    #[Route('/property/update', name: 'inmueble_update', methods: ['PUT'])]
    public function modificar(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);# Se obtiene la información del postman
        $Inmueble = $this->InmuebleRepository->findOneBy(['id'=>$data['id']]);# Se obtiene el inmueble asociado con la id
        if( $Inmueble== null)  throw new NotFoundHttpException('No existe la propiedad'); # Si no existe la propiedad saltara una excepción
        empty($data['Titulo']) ? true : $Inmueble->setTitulo($data['Titulo']);  # Si vienen a nulo no se modificara pero si se informa si
        empty($data['Descripcion']) ? true : $Inmueble->setDescripcion($data['Descripcion']);# Si vienen a nulo no se modificara pero si se informa si
        $this->InmuebleRepository->save($Inmueble); # Se llama la función para que haga el post en la bd
        return new JsonResponse(['status' => 'Inmueble update !'], Response::HTTP_CREATED); # Genera la respuesta en el postman con un 201 ok
    }
}
