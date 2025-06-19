<?php
  $body = "<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>
            <head>
              <meta charset='utf-8'>
              <title>".WEBSITE."</title>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
              <meta http-equiv='X-UA-Compatible' content='IE=edge' />
              <meta name='description' content='Crateronfire'>
              <meta name='author' content='Crateronfire'>
              <style type='text/css'>
              img{max-width: 100%;text-align: center;margin: 0 auto; display: block;}
              table{font-family: 'Arial';font-size: 13px;}
              strong{color: #fff!important;}
              </style>
            </head>
            <body>
              <table width='100%' border='0' cellspacing='2' cellpadding='2'>
                <tr>
                  <td colspan='2' width='20%' align='center' bgcolor='#ff7f5f'>
                    <strong style='color:#ffffff;'>DATOS PERSONALES</strong>
                  </td>
                </tr>";

    if(!empty($nombre))
    {
      $body .= "<tr>
                  <td width='20%' align='center' bgcolor='#484848'>
                    <strong style='color:#fff;'>Nombre</strong>
                  </td>
                  <td width='80%'>".$nombre."</td>
                </tr>";
    }

    if(!empty($tel))
    {
      $body .= "<tr>
                  <td width='20%' align='center' bgcolor='#484848'>
                    <strong style='color:#fff;'>Teléfono</strong>
                  </td>
                  <td width='80%'>".$tel."</td>
                </tr>";
    }

    if(!empty($email))
    {
      $body .= "<tr>
                  <td width='20%' align='center' bgcolor='#484848'>
                    <strong style='color:#fff;'>Correo</strong>
                  </td>
                  <td width='80%'>".$email."</td>
                </tr>";
    }

     if(!empty($mensaje))
    {
      $body .= "<tr>
                  <td width='20%' align='center' bgcolor='#484848'>
                    <strong style='color:#fff;'>Mensaje</strong>
                  </td>
                  <td width='80%'>".$mensaje."</td>
                </tr>";
    }

    if(!empty($comentario))
    {
      $body .= "<tr>
                  <td width='20%' align='center' bgcolor='#484848'>
                    <strong style='color:#fff;'>Comentario</strong>
                  </td>
                  <td width='80%'>".$comentario."</td>
                </tr>";
    }

    $body .= "</table>
            </body>
          </html>";