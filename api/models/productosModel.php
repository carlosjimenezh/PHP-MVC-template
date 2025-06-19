<?php 
    class ProjectsModel {
        private $db, $query, $totalResultados;
        public function __construct() {
            include_once('db/connection.php');
            $this->db = lectura();
        }

        public function getProductos (int $page, int $limit = 16, string $search = '') {
            $page = $this->db->real_escape_string($page);
            $search = $this->db->real_escape_string($search);
            $offset = ($page - 1) * $limit;
            $query = "SELECT *
                FROM productos p
                WHERE 1=1";
            if (trim($search) !== '') {
                $query .= " AND p.nombre LIKE '%$search%'";
            }
            $query .= " ORDER BY nombre ASC";
            $this->setQuery($query);
            $this->setTotalResultados($query);
            $query .= " LIMIT $limit OFFSET $offset";
            $stmt = $this->db->query($query);
            $productos = [];
            while($item = $stmt->fetch_assoc()) {
                $imagen = file_exists("assets/productos/" . $item['idproducto'] . "_1.jpg") ? "assets/productos/" . $item['idproducto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                $imagen_s = file_exists("assets/productos_s/" . $item['idproducto'] . "_1.jpg") ? "assets/productos_s/" . $item['idproducto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                $producto = [
                    'producto' => $item,
                    'imagen' => $imagen,
                    'imagen_s' => $imagen_s,
                    'slug' => '',
                ];
                $productos[] = $producto;
            }
            return [
                'ok' => true,
                'total_resultados' => $this->getTotalResultados(),
                'pagina' => (int)$page,
                'paginas' => ceil($this->getTotalResultados() / $limit),
                'productos' => $productos,
                'search' => $search,
            ];
        }

        public function getProductoById (int $id) {
            $idproducto = $this->db->real_escape_string($id);
            $query = "SELECT *
                FROM productos p
                WHERE p.idproducto = '$idproducto'";
            $this->setQuery($query);
            $this->setTotalResultados($query);
            $query .= " LIMIT 1";
            $stmt = $this->db->query($query);
            $productos = [];
            $imagenes = [];
            while($item = $stmt->fetch_assoc()) {
                $imagen = file_exists("assets/productos/" . $item['idproducto'] . "_1.jpg") ? "assets/productos/" . $item['idproducto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                $imagen_s = file_exists("assets/productos_s/" . $item['idproducto'] . "_1.jpg") ? "assets/productos_s/" . $item['idproducto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                //buscar todas las imágenes que empiecen con el id del proyecto
                $total_imagenes = glob("assets/productos/".$item['idproducto']."_*.jpg");
                foreach ($total_imagenes as $imagen) {
                    $imagenes[] = $imagen;
                }
                $producto = [
                    'producto' => $item,
                    'imagen' => $imagen,
                    'imagen_s' => $imagen_s,
                    'imagenes' => empty($imagenes) ? ['assets/default.jpg'] : $imagenes,
                    'slug' => '',
                ];
                $productos[] = $producto;
            }
            return [
                'ok' => true,
                'total_resultados' => $this->getTotalResultados(),
                'producto' => $producto,
            ];
        }
        
        public function setTotalResultados ($query): void {
            $stmt = $this->db->query($query);
            $this->totalResultados = $stmt->num_rows;
        }

        public function getTotalResultados () {
            return $this->totalResultados;
        }

        public function setQuery ($query):void {
            $this->query = $query;
        }

        public function getQuery () {
            return $this->query;
        }

    }