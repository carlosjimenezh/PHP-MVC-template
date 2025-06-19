<?php
    //declarado estricto de variables
    declare(strict_types = 1);


    function kebapCaseToCamelCase (string $texto) :string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $texto))));
    }


    function stringToKebabCase (string $string) :string
    {
        // 1. Quitar acentos
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        // 2. Convertir a minúsculas
        $string = strtolower($string);
        // 3. Reemplazar espacios y guiones por guión medio
        $string = preg_replace('/[\s\_]+/', '-', $string);
        // 4. Quitar todo lo que no sea letras, números o guión medio
        $string = preg_replace('/[^a-z0-9\-]/', '', $string);
        // 5. Quitar guiones medios duplicados
        $string = preg_replace('/-+/', '-', $string);
        // 6. Eliminar guión medio inicial o final si lo hay
        $string = trim($string, '-');
        return $string;
    }



    //hacer llamadas a la api desde php
    function callApi($method, $url, $data = [], $headers = []) : array
    {
    $url = BASE_URL . $url;
    $curl = curl_init();

    $defaultHeaders = [
        'Content-Type: application/json',
    ];

    $allHeaders = array_merge($defaultHeaders, $headers);

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $allHeaders,
    ];

    switch (strtoupper($method)) {
        case 'GET':
            if (!empty($data)) {
                $url .= '?' . http_build_query($data);
                $options[CURLOPT_URL] = $url;
            }
            break;

        case 'POST':
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
            break;

        case 'PUT':
        case 'DELETE':
            $options[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
            if (!empty($data)) {
                $options[CURLOPT_POSTFIELDS] = json_encode($data);
            }
            break;

        default:
            throw new Exception("Método HTTP no soportado: $method");
    }

    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if ($error) {
        throw new Exception("Error procesando la solicitud: $error");
    }


    return json_decode($response, true); 
    }



    function sendMail(string $from, string $to, string $template, array $data) : bool
    {
        //verificar que los valores de envio y destino sean validos
        if (!isset($from) || empty($from) || !filter_var($from, FILTER_VALIDATE_EMAIL) || !isset($to) || empty($to) || !filter_var($to, FILTER_VALIDATE_EMAIL )) {
            throw new Exception("Es necesario un valor valido para el correo de envio y el correo de destino");
            exit();
        }

        //varificar que exista el template del correo
        if (!file_exists("templates/$template.php")) {
            throw new Exception("No existe el template $template");
            exit();
        }


        $email_from = $from;
        $email_to= $to;


         //sacar los valores de data (nombre, tel, etc)
        extract($data);

        include_once("templates/$template.php");
        $email_txt = $body;
        
        $email_subject = "Contacto de ".$nombre;
        
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers.= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
        $headers.= 'From: '.$email_from. "\r\n";    
        
        $email_message = $email_txt;
        
        $ok = @mail($email_to, $email_subject, $email_message, $headers);
        if (!$ok) {
            throw new Exception("Error al enviar el correo");
        }
        return true;
    }


    function isAdmin () {
        return isset($_SESSION['sflag']) && $_SESSION['sflag'] === 3;
    }

    //Desarrollado por Crater On Fire
    //www.crateronfire.com
    //28-10-13 corregido png, crop mejorado
    //26-06-17 agregada la opcion de borde blanco de 10px, medidas fijas 430x430 origen, 450x450 destino
    function resizer($ruta_orig, $rutas, $width, $height, $imgs, $espng=0, $rutasbn="", $crop="", $crecer="",$borde=0){
        $calidad=100;
        $imgs=$imgs-1;

        for ($i=0;$i<=$imgs;$i++)
        {
            list($width_orig, $height_orig) = getimagesize($ruta_orig);
            if($width_orig>$width[$i] || $height_orig>$height[$i] || $crecer[$i]==1){
                if($crop[$i]==1)
                {
                    $ratio = max($width[$i]/$width_orig, $height[$i]/$height_orig);
                    $height_orig = $height[$i] / $ratio;
                    $x = ($width_orig - $width[$i] / $ratio) / 2;
                    $width_orig = $width[$i] / $ratio;
                }
                else{
                    if ($width_orig < $height_orig) { //si es foto vertical
                        $width[$i] = ($height[$i] / $height_orig) * $width_orig;
                    } else {
                        $heighttmp = ($width[$i] / $width_orig) * $height_orig;
                        if($heighttmp>$height[$i]){//para q no se pase
                            $width[$i] = ($height[$i] / $height_orig) * $width_orig;
                        }
                        else
                            $height[$i]=$heighttmp;
                        
                    }
                    $x=0;
                }
                
                $image_p = imagecreatetruecolor((int)$width[$i], (int)$height[$i]); 
                if($espng==1){
                    $image = imagecreatefrompng($ruta_orig);
                    imagealphablending($image_p, false);
                    $colorTransparent = imagecolorallocatealpha($image_p, 0, 0, 0, 127);
                    imagefill($image_p, 0, 0, $colorTransparent);
                    imagesavealpha($image_p, true);
                
                    imagecopyresampled($image_p, $image, 0, 0, $x, 0, (int)$width[$i], (int)$height[$i], (int)$width_orig, (int)$height_orig); 
                    imagepng($image_p, $rutas[$i], 9);    
                }
                else{
                    $image = imagecreatefromjpeg($ruta_orig);
                    if($borde[$i]==1){
                        imagecopyresampled($image_p, $image, 0, 0, $x, 0, (int)$width[$i], (int)$height[$i], (int)$width_orig, (int)$height_orig); 
                        //imagecopyresampled($image_p, $image_p, 10, 10, 0, 0, 450, 450, $width[$i], $width[$i]); 
                        //imagecopymerge($img1, $img2, 0, 0, 0, 0, $x, $y, 100);
                        $img2 = imagecreatetruecolor(450, 450);
                        $bg=imagecolorallocate($img2, 255, 255, 255);
                        imagefill($img2, 0, 0, $bg);
                        imagecopymerge($img2,$image_p, 10, 10, 0, 0, 430, 430, 100);
                        imagejpeg($img2, $rutas[$i], $calidad);
                        imagedestroy($img2);
                    }
                    else{
                        imagecopyresampled($image_p, $image, 0, 0, $x, 0, (int)$width[$i], (int)$height[$i], (int)$width_orig, (int)$height_orig);
                        imagejpeg($image_p, $rutas[$i], $calidad);            
                    }
                    

                }
                imagedestroy($image);
                
                
                //miniatura B/N
                if(isset($rutasbn[$i]) && $rutasbn[$i]!=""){
                    $imbn = imagecreate($width[$i],$height[$i]);
                    for ($c = 0; $c < 256; $c++) {    
                        imagecolorallocate($imbn, $c,$c,$c);
                    }
                    imagecopymerge($imbn,$image_p,0,0,0,0, $width[$i], $height[$i], 100);
                    imagejpeg($imbn, $rutasbn[$i], $calidad);
                }
                //fin B/N
                
                imagedestroy($image_p);
            }else{
                //si la imagen mide menos
                copy($ruta_orig,$rutas[$i]);
            }
        }
    }
