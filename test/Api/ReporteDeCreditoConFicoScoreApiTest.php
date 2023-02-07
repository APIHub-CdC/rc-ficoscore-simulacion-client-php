<?php

namespace rc\ficoscore\simulacion\Client;

use \GuzzleHttp\Client;
use \GuzzleHttp\Event\Emitter;
use \GuzzleHttp\Middleware;
use \GuzzleHttp\HandlerStack as handlerStack;

use \rc\ficoscore\simulacion\Client\Configuration;
use \rc\ficoscore\simulacion\Client\ApiException;
use \rc\ficoscore\simulacion\Client\ObjectSerializer;

use \rc\ficoscore\simulacion\Client\Api\ReporteDeCreditoConFicoScoreApi;

use \rc\ficoscore\simulacion\Client\Model\PersonaPeticion;
use \rc\ficoscore\simulacion\Client\Model\CatalogoEstados;
use \rc\ficoscore\simulacion\Client\Model\DomicilioPeticion;

class ReporteDeCreditoConFicoScoreApiTest extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $handler = \GuzzleHttp\HandlerStack::create();
        $config = new Configuration();
        $config->setHost('the_url');
        
        $client = new \GuzzleHttp\Client(['handler' => $handler, 'verify' => false]);

        $this->apiInstance = new ReporteDeCreditoConFicoScoreApi($client, $config);

        $this->x_api_key = "your_x_api_key";

    }

    public function testGetReporte()
    {
        
        $persona = new PersonaPeticion();
        $estado = new CatalogoEstados();
        $domicilio = new DomicilioPeticion();

        $persona->setPrimerNombre("JUAN PRUEBA SIETE");
        $persona->setApellidoPaterno("PRUEBA");
        $persona->setApellidoMaterno("SIETE");
        $persona->setFechaNacimiento("1965-08-09");
        $persona->setRfc("PUSJ800107H2O");
        $persona->setNacionalidad("MX");

        $domicilio->setDireccion("INSURGENTES SUR 1001");
        $domicilio->setColoniaPoblacion("INSURGENTES SUR");
        $domicilio->setDelegacionMunicipio("CIUDAD DE MEXICO");
        $domicilio->setCiudad("CIUDAD DE MEXICO");
        $domicilio->setEstado($estado::CDMX);
        $domicilio->setCp("11230");

        $persona->setDomicilio($domicilio);
        
        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $persona);
            
            print_r($result);
            $this->assertTrue($result->getFolioConsulta()!==null);
            return $result->getFolioConsulta();
        } catch (ApiException $e) {
            echo 'Exception when calling ReporteDeCreditoConFicoScoreApiTest->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }
    
}
