<?php
require_once __DIR__ . '/../Models/Vehicle.php';
require_once __DIR__ . '/../../config/database.php';

class VehicleRepository{
    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findByPlateOrRenavam($plate, $renavam){
        
        $sql = "SELECT v.id, v.placa, v.renavam, b.data_pagamento AS situation, vb.tipo_taxa AS rate
                FROM veiculos v  
                LEFT JOIN vistoria_empresas ve ON v.id = ve.id_veiculos 
                LEFT JOIN vistorias_contrato vc ON v.id = vc.id_contrato
                INNER JOIN boletos b ON b.id = ve.id_boleto_vistoria OR b.id = vc.id_boleto
                INNER JOIN boletos_regular br ON br.id_boletos = b.id
                INNER JOIN empresas e ON e.id = br.id_empresas
                INNER JOIN veiculos_boleto vb ON vb.id_boleto = b.id
                WHERE (v.placa = :plate OR v.renavam = :renavam)
                AND b.data_pagamento >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                AND b.data_pagamento <= CURDATE()
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['plate' => $plate, 'renavam' => $renavam]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return new Vehicle(
                $result['id'], 
                $result['placa'], 
                $result['renavam'], 
                $result['situation'],
                $result['rate']
            );
        }
        return null;
    }
}
?>