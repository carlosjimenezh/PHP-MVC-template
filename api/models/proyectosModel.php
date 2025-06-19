<?php 
    class ProyectosModel {
        private $db, $query, $totalResultados, $insertedId;
        public function __construct() {
            include_once('db/connection.php');
            $this->db = conn();
        }

        public function getProyectos (int $page, int $limit = 16, string $search = '') {
            $page = $this->db->real_escape_string($page);
            $search = $this->db->real_escape_string($search);
            $offset = ($page - 1) * $limit;
            $query = "SELECT *
                FROM proyectos p
                WHERE 1=1";
            if (trim($search) !== '') {
                $query .= " AND p.nombre LIKE '%$search%'";
            }
            $query .= " ORDER BY orden ASC";
            $this->setQuery($query);
            $this->setTotalResultados($query);
            $query .= " LIMIT $limit OFFSET $offset";
            $stmt = $this->db->query($query);
            $proyectos = [];
            while($item = $stmt->fetch_assoc()) {
                $imagen = file_exists("../assets/proyectos/" . $item['idproyecto'] . "_1.jpg") ? "assets/proyectos/" . $item['idproyecto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                $imagen_s = file_exists("../assets/proyectos_s/" . $item['idproyecto'] . "_1.jpg") ? "assets/proyectos_s/" . $item['idproyecto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                $proyecto = [
                    'proyecto' => $item,
                    'imagen' => $imagen,
                    'imagen_s' => $imagen_s,
                    'slug' => '',
                ];
                $proyectos[] = $proyecto;
            }
            return [
                'ok' => true,
                'total_resultados' => $this->getTotalResultados(),
                'pagina' => (int)$page,
                'paginas' => ceil($this->getTotalResultados() / $limit),
                'proyectos' => $proyectos,
                'search' => $search,
            ];
        }

        public function getProyectoById (int $id) {
            $idproyecto = $this->db->real_escape_string($id);
            $query = "SELECT *
                FROM proyectos p
                WHERE p.idproyecto = '$idproyecto'";
            $this->setQuery($query);
            $this->setTotalResultados($query);
            $query .= " LIMIT 1";
            $stmt = $this->db->query($query);
            $proyectos = [];
            $imagenes = [];
            while($item = $stmt->fetch_assoc()) {
                $imagen = file_exists("../assets/proyectos/" . $item['idproyecto'] . "_1.jpg") ? "assets/proyectos/" . $item['idproyecto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                $imagen_s = file_exists("../assets/proyectos_s/" . $item['idproyecto'] . "_1.jpg") ? "assets/proyectos_s/" . $item['idproyecto'] . "_1.jpg?".$item['actualizado'] : "assets/default.jpg";
                //buscar todas las imágenes que empiecen con el id del proyecto
                $total_imagenes = glob("../assets/proyectos/".$item['idproyecto']."_*.jpg");
                foreach ($total_imagenes as $img) {
                    $imagenes[] = str_replace('../', '', $img);
                }
                $proyecto = [
                    'proyecto' => $item,
                    'imagen' => $imagen,
                    'imagen_s' => $imagen_s,
                    'imagenes' => empty($imagenes) ? ['assets/default.jpg'] : $imagenes,
                    'slug' => '',
                ];
                $proyectos[] = $proyecto;
            }
            return [
                'ok' => true,
                'total_resultados' => $this->getTotalResultados(),
                'proyectos' => $proyectos,
            ];
        }


        public function crearProyecto (string $nombre, string $ubicacion, string $tour, int $orden)
        {
            $nombre = $this->db->real_escape_string($nombre);
            $ubicacion = $this->db->real_escape_string($ubicacion);
            $orden = (int)$orden;
            $tour = $this->db->real_escape_string($tour);
            $query = "INSERT INTO proyectos (nombre, ubicacion, 3dtour, orden) 
                VALUES('$nombre','$ubicacion','$tour','$orden')"
            ;
            if ($this->db->query($query)) {
                $this->setInsertedId($this->db->insert_id);
                try {
                    $this->reordenarOrden();
                } catch (\Throwable $th) {
                    error_log("Falló al reordenar proyectos ".$th->getMessage());
                }
                return [
                    'ok' => true,
                    'mensaje' => "se creo correctamente",
                ];
            }
            return [
                'ok' => false,
                'mensaje' => 'Hubo en la query',
            ];
        }

        public function eliminarProyecto (int $id) {
            $query = "DELETE FROM proyectos WHERE idproyecto = '$id'";
            if ($this->db->query($query)) {
                try {
                    $this->reordenarOrden();
                } catch (\Throwable $th) {
                    error_log("Falló al reordenar proyectos ".$th->getMessage());
                }
                return [
                    'ok' => true,
                    'mensaje' => 'Se eliminó correctamente',
                ];
            }
            return [
                'ok' => false,
                'mensaje' => 'Error al eliminar',
            ];
        }

        public function editarProyecto(int $id, string $nombre, string $ubicacion, int $orden, string $tour) {
            $nombre = $this->db->real_escape_string($nombre);
            $ubicacion = $this->db->real_escape_string($ubicacion);
            $orden = (int)$orden;
            $tour = $this->db->real_escape_string($tour);

            // Obtener el orden actual del proyecto
            $stmt = $this->db->query("SELECT orden FROM proyectos WHERE idproyecto = $id");
            if (!$stmt || $stmt->num_rows === 0) {
                return ['ok' => false, 'mensaje' => 'Proyecto no encontrado'];
            }

            $row = $stmt->fetch_assoc();
            $ordenActual = (int)$row['orden'];

            // Si el nuevo orden es diferente, hacer espacio en la posición deseada
            if ($orden !== $ordenActual) {
                if ($orden > $ordenActual) {
                    // Mover hacia arriba: reducir en 1 los que están entre actual y nuevo orden
                    $this->db->query("UPDATE proyectos SET orden = orden - 1 WHERE orden > $ordenActual AND orden <= $orden");
                } else {
                    // Mover hacia abajo: aumentar en 1 los que están entre nuevo orden y actual
                    $this->db->query("UPDATE proyectos SET orden = orden + 1 WHERE orden >= $orden AND orden < $ordenActual");
                }
            }

            $query = "UPDATE proyectos SET 
                nombre = '$nombre',
                ubicacion = '$ubicacion',
                orden = '$orden',
                3dtour = '$tour'
                WHERE idproyecto = '$id'
            ";
            if ($this->db->query($query)) {
                try {
                    $this->reordenarOrden();
                } catch (\Throwable $th) {
                    error_log("Falló al reordenar proyectos ".$th->getMessage());
                }
                return [
                    'ok' => true,
                    'mensaje' => "se actualizó correctamente",
                ];
            }
            return [
                'ok' => false,
                'mensaje' => 'Hubo un error en la query',
            ];
        }


        public function reordenarOrden () : void {
            //obtener todos los elementos por orden y por fecha de creación (para saber cuál ha cambiado)
            $stmt = $this->db->query("SELECT idproyecto FROM proyectos ORDER BY orden ASC, creado DESC");
            $items = $stmt->fetch_all(MYSQLI_ASSOC);
            $nuevoOrden = 1;
            foreach ($items as $item) {
                $idproyecto = $item['idproyecto'];
                $this->db->query("UPDATE proyectos SET orden = '$nuevoOrden' WHERE idproyecto = '$idproyecto'");
                $nuevoOrden++;
            }
        }

        public function getLastOrden () {
            $stmt = $this->db->query("SELECT MAX(orden) as orden FROM `proyectos`");
            $result = $stmt->fetch_assoc();
            $orden = $result['orden'] ?? 0;
            return [
                'ok' => true,
                'ultimo_orden' => $orden,
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

        public function setInsertedId ($id):void {
            $this->insertedId = $id;
        }

        public function getInsertedId () {
            return $this->insertedId;
        }

    }