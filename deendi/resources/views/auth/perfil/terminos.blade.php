<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} | Terminos y condiciones</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">

    <style type="text/css">
        @font-face {
        font-family: 'Roboto';
          src:url("{{ asset('webfonts/Roboto/Roboto-Regular.ttf')}}");
        }
  
        @font-face {
        font-family: 'deendi';
          src:url("{{ asset('webfonts/Roboto/Quicksand-Bold.ttf')}}");
        }
  
        .deendi{
          font-family: deendi;
        }
        body{
        font-family: Roboto;
        }
  
        .bg-navbar {
          background:#3a5184;
        }
    </style>
</head>
<body>
    <div class="container w-75 pb-4">
        <p class="text-black-50 pt-5">CONDICIONES DE NUESTRO SERVICIO</p>

            <h5 class="mt-5">Te damos la bienvenida a DiseñandoEncuestas</h5>

            <P>Te agredecemos que uses los servicios que ofrece nuestra plataforma Aplicandoencuestas.</P>
            <p>El uso de nuestros servicos implica la aceptación de estas condiciones. Te recomendamos que leas detenidamente.</p>

            <h5 class="mt-5">Uso de nuestros servicios</h5>
           <div class="container text-justify">
            <p>
                La importancia de hacer uso de la información de manera correcta es de gran relevancia para no causar daño a la sociedad con la divulgación de datos, la responsabilidad es de la persona que recopila la información como de quien otorga el consentimiento de hacer buen uso de ella. Como usuario  debe leer el aviso de privacidad de la plataforma y al desarrollar su encuesta tiene que crear su aviso de privacidad para notificar el uso y finalidad de la obtención de la información a recopilar.
                Los datos a tener en cuenta para la seguridad de la información en la plataforma de encuestas de prioridad son los siguientes:

                <p>Datos de identificación: Nombre completo, dirección, número telefónico o celular, estado civil, Registro Federal de Contribuyentes (RFC), Número de Seguridad Social (NSS), Clave Única de Registro de Población (CURP), lugar y fecha de nacimiento, nombre de familiares, dependientes y beneficiarios</p>
                <p>Datos profesionales: Ocupación, puesto, salario, lugar de trabajo, correo electrónico, historial académico y historial de desempeño.</p>
                <p>Datos financieros: Historial de crédito, seguros, afores y servicios contratados.</p>
                <p>Datos patrimoniales: Bienes, muebles y propiedades.</p>
                <p>Datos biométricos: Datos de menores de edad, preferencia sexual, ideología, religión y origen étnico.</p>
                <p>Para la obtención de estos datos mencionados es obligatorio realizar su aviso de seguridad especificando detalladamente ¿Quién eres? y ¿Cuál es la finalidad del uso de la información? Los encuestados están en todo su derecho de no contestar la encuesta, pedir que elimines la información otorgada y solicitar que modifiques la información. El aviso de privacidad puede ser de manera verbal, mensaje a través de correo electrónico y publicación en el sitio web.</p>

                <strong>“El usuario de la plataforma o encuestado autoriza el uso de su información al aceptar estar de acuerdo con el aviso de privacidad” </strong>
            </p>
           </div>
    </div>
</body>
</html>