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
        $this->x_full_report = 'false';

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
            $result = $this->apiInstance->getReporte($this->x_api_key, $persona, $this->x_full_report);
            
            print_r($result);
            $this->assertTrue($result->getFolioConsulta()!==null);
            return $result->getFolioConsulta();
        } catch (ApiException $e) {
            echo 'Exception when calling ReporteDeCreditoConFicoScoreApiTest->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * @depends testGetReporte
     */    
    
    public function testGetConsultas($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getConsultas($folioConsulta, $this->x_api_key);
                print_r($result);
                $this->assertTrue($result->getConsultas()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApiTest->testGetConsultas: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }
    }
    

    /**
     * @depends testGetReporte
     */
    
    public function testGetCreditos($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getCreditos($folioConsulta, $this->x_api_key);
                print_r($result);
                $this->assertTrue($result->getCreditos()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApiTest->testGetCreditos: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }        
    }
    

    /**
     * @depends testGetReporte
     */
    
    public function testGetDomicilios($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getDomicilios($folioConsulta, $this->x_api_key);
                print_r($result);
                $this->assertTrue($result->getDomicilios()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApiTest->testGetDomicilios: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }          
    }
    

    /**
     * @depends testGetReporte
     */
    
    public function testGetEmpleos($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getEmpleos($folioConsulta, $this->x_api_key);
                print_r($result);
                $this->assertTrue($result->getEmpleos()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApiTest->testGetEmpleos: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }          
    }
    

    /**
     * @depends testGetReporte
     */
    
    public function testGetScores($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getScores($folioConsulta, $this->x_api_key);
                print_r($result);
                $this->assertTrue($result->getScores()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApiTest->testGetScores: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }         
    }
    

    /**
     * @depends testGetReporte
     */

    public function testGetMensajes($folioConsulta)
    {
        if($this->x_full_report == "false") {
            try {
                $result = $this->apiInstance->getMensajes($folioConsulta, $this->x_api_key);
                print_r($result);
                $this->assertTrue($result->getMensajes()!==null);
            } catch (ApiException $e) {
                echo 'Exception when calling ReporteDeCreditoConFicoScoreApi->testGetMensajes: ', $e->getMessage(), PHP_EOL;
            }
        } else {
            print_r("x_full_report inicializado en true");
        }         
    }

    
}
