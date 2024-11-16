<?php
include_once './app/models/producto.model.php';
require_once './app/views/json.view.php';

class ToyController
{
    private $modelToy;
    private $view;

    public function __construct()
    {
        $this->modelToy = new ToyModel();
        $this->view = new JSONView();
    }

    public function getToys($req, $res)
    {
        //ordenamiento por atibuto
        $orderBy = false;
        $direccion = null;
        if (isset($req->query->orderBy)) {
            $orderBy = $req->query->orderBy;
            if (isset($req->query->direccion))
                $direccion = $req->query->direccion;
        }
        //Paginacion
        $pagina = false;
        $limite = false;
        if (isset($req->query->pagina) && is_numeric($req->query->pagina) && isset($req->query->limite) && is_numeric($req->query->limite)) {
            $pagina = $req->query->pagina;
            $limite = $req->query->limite;
        }
        //filtros 
        $filtro = false;
        $valor = false;
        if ((isset($req->query->filtro)) && (isset($req->query->valor))) {
            $filtro = $req->query->filtro;
            $valor = $req->query->valor;
        }

        $toy = $this->modelProducto->getProductos($orderBy, $direccion, $pagina, $limite, $filtro, $valor);
        return $this->view->response($productos);
    }

    public function getToy($req, $res)
    {
        $id = $req->params->id;
        $toy = $this->modelProducto->getProducto($id);
        if (!$producto) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        return $this->view->response($producto);
    }



    public function createToy($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }

        if (empty($req->body->nombre)  || empty($req->body->precio) || empty($req->body->marca) || empty($req->body->descripcion) || empty($req->body->URL_imagen) || empty($req->body->categoria)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombreProducto = $req->body->nombreProducto;
        $precio = $req->body->precio;
        $material = $req->body->material;
        $id_marca = $req->body->id_marca;
        $codigo = $req->body->codigo;
        $img = $req->body->img;


        $id = $this->modelProducto->agregarProducto($nombreProducto, $precio, $material, $id_marca, $codigo, $img);
        if (!$id) {
            return $this->view->response("Error al insertar tarea", 500);
        }

        $toy = $this->modelToy->getProducto($id);
        return $this->view->response($toy, 201);
    }

    public function updateToy($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }

        $id = $req->params->id;
        $producto = $this->modelProducto->getProducto($id);

        if (!$toy) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        if (empty($req->body->nombre)  || empty($req->body->precio) || empty($req->body->marca) || empty($req->body->descripcion) || empty($req->body->URL_imagen) || empty($req->body->categoria)) {
            return $this->view->response('Faltan completar datos', 400);
        }
        $nombreProducto = $req->body->nombreProducto;
        $precio = $req->body->precio;
        $material = $req->body->material;
        $id_marca = $req->body->id_marca;
        $codigo = $req->body->codigo;
        $img = $req->body->img;

        $this->modelProducto->ediToy($id_juguete,$nombreProducto, $precio, $material, $id_marca, $codigo, $img);

        // obtengo la tarea modificada y la devuelvo en la respuesta
        $toy = $this->modelProducto->getProducto($id);
        $this->view->response($producto, 200);
    }
    public function deleteToy($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $toy = $this->modelProducto->getProducto($id);
        if (!$juguete) {
            return $this->view->response("El producto con el id=$id no existe", 404);
        }
        $this->modelToy->eraseToy($id);
        $this->view->response("El producto con el id=$id se eliminó con éxito");
    }
}
