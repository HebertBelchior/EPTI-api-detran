<?php
require_once __DIR__ . '/../Services/VehicleService.php';

class VehicleController{
    private $service;

    public function __construct(){
        $this->service = new VehicleService();
    }

    public function validate($request, $response, $args){
        $params = $request->getQueryParams();
        $plate = $params['plate'] ?? null;
        $renavam = $params['renavam'] ?? null;

        if(empty($plate) && empty($renavam)){  
            $error = json_encode(['error' => 'Informe PLACA ou RENAVAM'], JSON_UNESCAPED_UNICODE);
            $response->getBody()->write($error);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $result = $this->service->validateVehicle($plate, $renavam);

        if (!$result) {
            $response->getBody()->write(json_encode(['status' => 'Erro ao validar veículo'], JSON_UNESCAPED_UNICODE));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }        

        $response->getBody()->write(json_encode($result, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
?>