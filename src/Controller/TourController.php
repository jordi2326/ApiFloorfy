<?php

namespace App\Controller;

use App\Repository\InmuebleRepository;
use App\Repository\TourRepository;
use App\Entity\Tour;
use App\Entity\Inmueble;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class TourController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class TourController extends AbstractController
{
    private  $InmuebleRepository;
    private $TourRepository;# Se genera variable global para poder utilizar las funciones del repositorio

    public function __construct(TourRepository $TourRepository , InmuebleRepository $InmuebleRepository  ) # Se inicializa la viariable
    {

        $this->TourRepository = $TourRepository;
        $this->InmuebleRepository = $InmuebleRepository;

    }


    #[Route('/tour/add', name: 'Tour', methods: ['POST'])]
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true); # Se obtiene la información del postman
        $idinmueble = $data['idinmueble']; # Se obtiene el id del inmueble asociado al tour
        if($idinmueble = null ) throw new NotFoundHttpException('No se puede añadir ningún inmueble');
        $Inmueble = $this->InmuebleRepository->findOneBy(['id'=>$idinmueble]); # Se obtiene el inmueble
        if($Inmueble == null) throw new NotFoundHttpException('No existe el inmueble'); # Si el inmueble no existe saltara una excepción
        $Activo = $data['Activo'];
        $existeActivo = $this->estaActivo($idinmueble); # Con esta función se quiere saber si existen Tour activos para este inmueble
        if ( $existeActivo && $Activo  == true) throw new NotFoundHttpException('No puede haber dos Tour Activos'); # Si se quiere añadir un Tour activo y existe uno activo no se podra añadir.
        if ($Activo == null ) $Activo = False; # Si el atributo no se informa, este tour se dara de alta a no activo
        $Tour = new Tour();
        $Tour->setActivo($Activo); #Se añade a Tour la propiedad activo
        $Tour->setInmueble($Inmueble); # Se añade a Tour la propiedad inmueble
        $this->TourRepository->save($Tour); # Se llama la función para que haga el post en la bd

        return new JsonResponse(['status' => 'Tour created!'], Response::HTTP_CREATED); # Genera la respuesta en el postman con un 201 ok
    }

    #[Route('/tour/update', name: 'inmueble_update', methods: ['PUT'])]
    public function modificar(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);# Se obtiene la información del postman
        $Tour = $this->TourRepository->findOneBy(['id'=>$data['id']]);
        $Inmueble = $this->InmuebleRepository->findOneBy(['id'=>$data['idinmueble']]);
        if( $Inmueble== null)  throw new NotFoundHttpException('No existe la propiedad'); #Si no existe la propiedad excepción
        if( $Tour == null ) throw new NotFoundHttpException('No existe el tour'); #Si no existe el tour excepción
        $Activo = $this->estaActivo($Inmueble->getId());
        if ( $data['Activo'] == true && $Activo) throw new NotFoundHttpException('Ya existe un tour activo'); #Existe un tour para esta propiedad ya activo
        empty($data['Activo']) ? true : $Tour->setActivo($data['Activo']);
        $this->InmuebleRepository->save($Tour); # Se llama la función para que haga el post en la bd
        return new JsonResponse(['status' => 'Inmueble update !'], Response::HTTP_CREATED); # Genera la respuesta en el postman con un 201 ok
    }

    public function estaActivo ($id):Bool
    {
        $Tours = [];
        $Tours = $this->TourRepository->findAll(); # Buscamos todos los tours
        $count = 0 ;
        foreach($Tours as $Tour){ # Iteramos por cada Tour
            $Inmueble = $Tour->getInmueble();
            $id1 = $Inmueble->getId();
            if($Tour->getActivo() == true and $id1 ==$id){ # Si esta activo y la id es la misma que el inmueble que se pasa por parametros se cumple la condición
                $count = $count +1;
            }
        }
        if ($count > 0 ) return True; # Si hay una propiedad activa retornara true
        else return False; # Si no hay una propiedad activa devolvera false
    }
}

