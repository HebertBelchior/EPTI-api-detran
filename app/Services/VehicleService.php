<?php
require_once __DIR__ . '/../Repositories/VehicleRepository.php';

class VehicleService{
    private $repository;

    public function __construct(){
        $this->repository = new VehicleRepository();
    }

    public function validateVehicle($plate, $renavam){
        $vehicle = $this->repository->findByPlateOrRenavam($plate, $renavam);

        if (!$vehicle) {
            return ['status' => 'Não autorizado', 'motivo' => 'Veículo não encontrado ou prazo de 30 dias para vistoria vencido.'];
        }

        if ($vehicle->situation !== null && trim($vehicle->situation) !== '' && $vehicle->rate == 'V') {
                return ['status' => 'Autorizado', 'motivo' => 'Dentro do prazo de 30 dias para vistoria.'];
        }
        
        if ($vehicle->rate !== 'V') {
            return ['status' => 'Não autorizado', 'motivo' => 'Taxa de vistoria inválida.'];
        }

        return ['status' => 'Não autorizado'];
    }
}
?>