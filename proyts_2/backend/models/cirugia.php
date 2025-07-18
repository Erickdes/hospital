<?php
class Cirugia {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerCirugias() {
        $stmt = $this->pdo->query("SELECT c.id, c.nombre_cirugia, u.nombre AS medico, s.numero AS sala, c.fecha 
                                   FROM cirugias c 
                                   JOIN usuarios u ON c.id_medico = u.id 
                                   JOIN salas s ON c.id_sala = s.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
