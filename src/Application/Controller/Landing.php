<?php
namespace Application\Controller;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\ResponseBootstrap;

class Landing
{
    
    public function __construct()
    {
        echo "in<br>";
    }
    
    
    /**
     * Get Landing Page
     *
     * @param Request $request
     * @return ResponseBootstrap
     */
    public function get(Request $request):ResponseBootstrap // TODO
    {
        //var_dump('pica');
        echo "salcin<br>";
        $responseKarinas = new ResponseBootstrap();
        $responseKarinas->setStatus(200);
        $responseKarinas->setMessage('Karinas');
        $responseKarinas->setData(['karinas'=>['ad']]);
        
        return $responseKarinas;
    }
    
}