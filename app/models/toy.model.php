<?php
require_once 'app/models/model.php';
class ToyModel extends Model
{

    public function getToys($orderBy = false, $direccion = " ASC", $pagina, $limite, $filtro, $valor)
    {
        $sql = 'SELECT * FROM juguete';
        //filtro , $filtro es el atributo y $valor es el valor
        if ($filtro && $valor) {
            switch ($filtro) {
                case 'nombreProducto':
                    $sql .= ' WHERE Nombre LIKE :Nombre';
                    break;
                case 'Precio':
                    $sql .= ' WHERE Precio < :Precio';
                    break;
                case 'material':
                        $sql .= ' WHERE Descripcion LIKE :material';
                        break;
                case 'codigo':
                         $sql .= ' WHERE Descripcion LIKE :codigo';
                         break;        
            }
        }

        //Ordenamiento Ascendente
        if ($orderBy) {
            switch ($orderBy) {
                case 'nombreProducto':
                    $sql .= ' ORDER BY NombreProducto';
                    break;
                
                case 'precio':
                    $sql .= ' ORDER BY Precio';
                    break;
                case 'codigo':
                    $sql .= ' ORDER BY codigo';
                    break;
            }
            if ($direccion === 'DESC') {
                $sql .= ' DESC';
            } else {
                $sql .= ' ASC';
            }
        }

        //paginacion        
        if ($pagina && $limite) {
            $desplazamiento = ($pagina - 1) * $limite;
            $sql .= ' LIMIT :limite OFFSET :desplazamiento';
        }

        $query = $this->db->prepare($sql);
        //usamos bindparam() para evitar la inyeccion sql por que LIMIT y OFFSET no deja poner ? y pasarlo en el execute. 
        if ($filtro && $valor) {
            if ($filtro == "Precio") {
                $valor = floatval($valor);
                $query->bindParam(":Precio", $valor);
            } else {
                $valor = "%" . $valor . "%"; //le agrego "comodines"
                $filtro = ":" . $filtro;
                $query->bindParam($filtro, $valor);
            }
        }

        if ($pagina && $limite) {
            $query->bindParam(':limite', $limite, PDO::PARAM_INT);
            $query->bindParam(':desplazamiento', $desplazamiento, PDO::PARAM_INT);
        }

        $query->execute();
        $toy = $query->fetchAll(PDO::FETCH_OBJ);
        return $toy;
    }

    public function getToy($id)
    {
        $query = $this->db->prepare('SELECT * FROM juguete WHERE id_juguete = ?');
        $query->execute([$id]);
        $toy = $query->fetch(PDO::FETCH_OBJ);
        return $toy;
    }

    public function addToy($nombreProducto, $precio, $material, $id_marca, $codigo, $img)
    {
        $query = $this->db->prepare('INSERT INTO juguete(nombreProducto, precio, material, id_marca, codigo, img) VALUES (?, ?, ?, ?, ?,?)');
        $query->execute([$nombreProducto, $precio, $material, $id_marca, $categoria, $codigo, $img]);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function eraseToy($id)
    {
        $query = $this->db->prepare('DELETE FROM juguete WHERE id_juguete = ?');
        $query->execute([$id]);
    }

    public function editToy($id_juguete, $nombreProducto, $precio, $material, $id_marca, $codigo, $img)
    {
        $query = $this->db->prepare('UPDATE juguete SET `NombreProducto` = ?, `precio` = ?, `material` = ?, `id_marca` = ?, `codigo` = ?, `img` = ? WHERE `id_juguete` = ?');
        $query->execute([$id_juguete, $nombreProducto, $precio, $material, $id_marca, $codigo, $img]);
    }
}
