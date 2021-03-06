<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>{{ config('app.name', 'Laravel') }} | Manual</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">

    <style>
        @font-face {
            font-family: 'deendi';
            src:url("{{ asset('webfonts/Roboto/Quicksand-Bold.ttf')}}");
        }

        .deendi{
            font-family: deendi;
        }
        html {
            scroll-behavior: smooth;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .bg-navbar {
            background: #3a5184;
        }

    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body id="app">
    <nav class="navbar navbar-nav sticky-top bg-white shadow">
        <a class="font-weight-bold h5 text-decoration-none text-dark deendi" href="#">{{ config('app.name', 'Laravel') }}</a>
    </nav>

    <div class="container-fluid deendi">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item d-flex justify-content-center align-items-center mb-3">
                            <img src="{{asset('img/logo.png')}}" class="img-fluid" width="50px"><br/>
                        </li>
                        <li class="nav-item">
                           <span class="nav-link">Manual</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#intro">
                                <span data-feather="file"></span>
                                Introducci??n
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#registro">
                                <span data-feather="shopping-cart"></span>
                                Registro
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sesion">
                                <span data-feather="users"></span>
                                Iniciar sesi??n
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#reset_pass">
                                <span data-feather="layers"></span>
                                Restablecer contrase??a
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#encuesta">
                                <span data-feather="layers"></span>
                                Crear encuesta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#tipos_pregunta">
                                <span data-feather="layers"></span>
                                Tipos de pregunta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_abierta">
                                <span data-feather="layers"></span>
                                Pregunta abierta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_simple">
                                <span data-feather="layers"></span>
                                Pregunta opci??n simple
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_multiple">
                                <span data-feather="layers"></span>
                                Pregunta opci??n m??ltiple
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_desplegable">
                                <span data-feather="layers"></span>
                                Pregunta con men?? desplegable
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_numerica">
                                <span data-feather="layers"></span>
                                Pregunta de tipo escala num??rica
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_archivo">
                                <span data-feather="layers"></span>
                                Pregunta con archivo
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_tabla">
                                <span data-feather="layers"></span>
                                Tabla din??mica
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#pre_nota">
                                <span data-feather="layers"></span>
                                Nota
                            </a>
                        </li>
                    </ul>

                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Funciones</span>
                        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">

                        <li class="nav-item">
                            <a class="nav-link" href="#edit_pre">
                                <span data-feather="file-text"></span>
                                Eliminar / editar pregunta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Eliminar encuesta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#edit_enc">
                                <span data-feather="file-text"></span>
                                Editar encuesta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#compartir">
                                <span data-feather="file-text"></span>
                                Compartir encuesta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#responder">
                                <span data-feather="file-text"></span>
                                Responder encuesta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#analisis">
                                <span data-feather="file-text"></span>
                                Analizar resultados
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#reporte">
                                <span data-feather="file-text"></span>
                                Descargar reporte
                            </a>
                        </li>

                    </ul>

                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Administraci??n</span>
                        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">
                                <span data-feather="file-text"></span>
                                Registrar contactos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#grupos">
                                <span data-feather="file-text"></span>
                                Registrar grupos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#perfil">
                                <span data-feather="file-text"></span>
                                Perfil
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="p-3 text-justify">
                    <div></div>
                    <div class="container w-75 float-left pb-3" id="intro">
                        <div class="mt-5">
                            <h5 class="text-muted pb-4"><span class="text-success mr-1 h5">#</span>
                                Introducci??n
                            </h5>
                            <p>
                                Esta es un peque??o introductorio que como trabajar con la plataforma de DEENDI, donde se
                                explican algunas funcionalidades para obtener una mejor experiencia con la herramienta.
                            </p>

                            <strong>Empecemos</strong><br><br>
                            <p>
                                La plataforma deendi permite crear encuestas de forma din??mica, lo cual al implementar
                                este
                                tipo de encuesta ayuda a obtener mejores resultados, Optimiza los tiempos en desarrollar
                                una
                                encuesta, Analizar los datos obtenidos y adem??s le ofrecemos al usuario una forma m??s
                                interactiva en responda un formulario, asimismo cuenta con su propia administraci??n de
                                encuestas e usuarios con quienes trabajar para aplicar una encuesta.

                            </p>
                            <figure>
                                <img class="img-fluid w-50" src="{{asset('img/manual-img/intro.svg')}}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="registro">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Registro
                            </h5>
                            <p>
                                Para crear una cuenta en nuestra plataforma, solo debe de ingresar a la opci??n REGISTRO
                                que se encuentra disponible en la p??gina principal, una vez que se encuentre en la
                                secci??n de registro solo debe de llenar los campos con sus datos personales que se piden
                                en el formulario
                            </p>

                            <p class="alert alert-warning">
                                Todos los campos son obligatorios adem??s el correo electr??nico que proporcione debe ser
                                un correo valido ya que por medio de esa direcci??n se le llegara una notificaci??n para
                                la validaci??n de su correo electr??nico y proceder con su acceso a la plataforma.
                            </p>
                            <p>
                                En la siguiente imagen se visualiza el formulario de registro.
                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/1.png')}}" alt=""
                                    style="width: 350px;">
                            </figure>

                            <p>
                                Una vez que finalice de ingresar los datos en el formulario y presione el bot??n de
                                REGISTRO se le notificar?? a su correo electr??nico, lo cual para confirmar su correo debe
                                de ingresar a su cuenta de correo que proporciono en el registro y abrir el correo que
                                recibir?? desde DEENDI donde debe de confirmar su cuenta. En la siguiente imagen se
                                muestra una notificaci??n de la plataforma.
                            </p>

                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/2.png')}}" alt=""
                                    style="width: 450px;">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="sesion">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Iniciar sesion
                            </h5>
                            <p>
                                Si previamente ya se registr?? en la plataforma DEENDI, ahora debe de seleccionar la
                                opci??n del men?? iniciar sesi??n e ingresar sus datos de usuario en el formulario INICIAR
                                SESI??N para acceder a la plataforma.
                                Los datos de usuario que se solicitan son el correo electr??nico y una contrase??a que se
                                ingres?? al momento de registrarse en la plataforma.
                            </p>

                            <p class="alert alert-danger">
                                Si los datos son incorrectos la plataforma le notifica con un mensaje de alerta.
                            </p>


                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/3.png')}}" alt=""
                                    style="width: 300px;">
                            </figure>


                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="reset_pass">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Restablecer contrase??a
                            </h5>
                            <p>
                                Si en dado caso olvido su contrase??a, para poder restablecer una nueva deber?? de
                                seleccionar el enlace ??Olvidaste tu contrase??a? en la parte inferior del formulario de
                                iniciar sesi??n para ir a la p??gina de solicitar link de restablecer contrase??a, por lo
                                cual debe de ingresar su correo electr??nico con el que se registr?? en la plataforma para
                                poder solicitar el link de restablecer contrase??a.<br />
                                Formulario para solicitar link de restablecer contrase??a.

                            </p>

                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/4.png')}}" alt=""
                                    style="width: 300px;">
                            </figure>

                            <p>Formulario para restablecer contrase??a</p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/5.png')}}" alt=""
                                    style="width: 300px;">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="encuesta">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Crear encuesta
                            </h5>
                            <p>
                                Una de las funciones m??s importantes de DEENDI es la creaci??n de encuestas, por lo cual
                                para crear una encuesta solo debe de ir a la secci??n mis encuestas del men?? lateral de
                                la plataforma y seleccionar la opci??n nueva encuesta lo cual mostrar?? un formulario para
                                ingresar los datos de la encuesta a generar.
                            </p>

                            <figure>
                                <img class="img-fluid w-100" src="{{asset('img/manual-img/6.png')}}"
                                    alt="Crear encuesta">
                            </figure>

                            <p class="alert alert-warning">
                                Si ingresa un t??tulo de la encuesta ya existente en tu bandeja de encuesta, se le
                                notificara con un mensaje de alerta ya tiene registrado una encuesta con el mismo nombre
                                y ya no se crear??a la encuesta hasta que sea un t??tulo diferente de los que ya tiene
                                registrado<br />
                                <strong>NOTA</strong>: No puede crear encuestas con el mismo t??tulo que ya est??n
                                registrados.

                            </p>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="tipos_pregunta">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Tipos de pregunta
                            </h5>
                            <p>
                                Los tipos de preguntas que se puede utilizar en una encuesta pueden variar de acuerdo a
                                la informaci??n que se recopile, esta plataforma permite hasta 8 tipos de preguntas las
                                cuales son:
                            </p>

                            <ul class="list-group">
                                <li class="nav-item"><a class="nav-link" href="#pre_abierta">Pregunta abierta</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_simple">Pregunta de selecci??n
                                        ??nica</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_multiple">Pregunta se selecci??n
                                        m??ltiple</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_desplegable">Pregunta con men??
                                        desplegable</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_numerica">Pregunta tipo escala
                                        num??rica</a></li>
                                <li class="nav-item"><a class="nav-link" href="#imagen">Pregunta con archivo imagen</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#tabla">Pregunta con tabla din??mica</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#nota">Notas</a></li>
                            </ul>

                            <p>
                                Las preguntas se describen de manera m??s detallada en cada sesi??n cu??l es su uso y que
                                tipo de informaci??n le permite capturar de acuerdo al dise??o de su encuesta.</p>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_abierta">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5" id="abierta">#</span>
                                Pregunta abierta
                            </h5>
                            <p>
                                La pregunta de opci??n abierta contiene respuestas libres los cuales se clasifica en
                                respuestas cortas y de P??rrafo de acuerdo al tama??o que considere la captura de su
                                informaci??n.<br /><br />
                                Este tipo de preguntas son para que el encuestado tenga total libertad en responder la
                                pregunta con sus propias palabras o dando su opini??n sobre el tema o problem??tica.<br />
                                En la siguiente imagen se muestra el formulario para formular una pregunta de tipo
                                abierta.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/7.png')}}" alt="form abierta"
                                    style="width: 400px;">
                            </figure>

                            A continuaci??n, se visualiza una imagen de como se muestra una pregunta de tipo pregunta
                            abierta
                            en la encuesta.
                            <figure>
                                <img class="img-fluid w-100 mt-3" src="{{asset('img/manual-img/8.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_simple">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta de selecci??n ??nica
                            </h5> 
                            <p>
                                Las preguntas de selecci??n ??nica solo se elige una respuesta para este tipo de preguntas
                                los cuales pueden ser de tipo verdadero o falso, categor??as y rangos. Para agregar una
                                pregunta de tipo selecci??n simple solo deber?? de seleccionar del men?? y se desplegar?? un
                                formulario para ingresar la pregunta y las opciones que contendr?? la pregunta, al
                                mostrar la primera vez el formulario solo muestra dos campos para las opciones, para
                                agregar m??s opciones debe de seleccionar el icono de ???Mas??? para agregar m??s campos para
                                ingresar m??s opciones.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/9.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuaci??n, se visualiza una imagen de como se muestra una pregunta de selecci??n ??nico
                            en la encuesta.
                            <figure>
                                <img class="img-fluid w-100 mt-3" src="{{asset('img/manual-img/10.png')}}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_multiple">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta de selecci??n m??ltiple
                            </h5>
                            <p>
                                Las preguntas de opci??n m??ltiple permiten a los encuestados seleccionar una o varias
                                opciones de una lista de respuestas que t?? defines en el dise??o de la encuesta. Son
                                intuitivas, f??ciles de usar de distintas maneras, ayudan a generar datos f??ciles de
                                analizar y proporcionan opciones. Para agregar una pregunta de tipo selecci??n m??ltiple
                                solo debe de seleccionar del men?? de formularios y se desplegara un formulario para
                                ingresar la pregunta y las posibles opciones, de igual como la pregunta de selecci??n
                                ??nica solo muestra dos campos para las opciones, para agregar m??s campos solo debe de
                                seleccionar el icono ???Mas??? para registrar mas opciones.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/11.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuaci??n, se visualiza una imagen de c??mo se ve una pregunta de tipo opci??n m??ltiple
                            en la encuesta.

                            <figure>
                                <img class="img-fluid w-75" src="{{asset('img/manual-img/12.png')}}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_desplegable">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta desplegable
                            </h5>
                            <p>
                                Las preguntas con men?? desplegable son otra manera de mostrar opciones en lista, lo cual
                                ofrece una lista desplegable con opciones de respuesta y solicita a los usuarios que
                                seleccione una respuesta. Este es una excelente opci??n que te permite ahorrar espacio si
                                tiene un gran listado de opciones que presentar.<br /><br />
                                Para agregar una pregunta desplegable solo debe de seleccionar del men?? de formularios y
                                se desplegara un formulario para ingresar el t??tulo y las posibles opciones de igual
                                manera como las preguntas de selecci??n ??nica y m??ltiple.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/13.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuaci??n, se visualiza una imagen de como se ve una pregunta de opci??n desplegable.

                            <figure>
                                <img class="img-fluid w-100 mt-3" src="{{asset('img/manual-img/14.png')}}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_numerica">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta escala num??rica
                            </h5>
                            <p>
                                Las preguntas de tipo escala num??rica, permite a los encuestados que valoren una
                                declaraci??n mediante una escala numera que va desde 1 - 5 a 1-10, por lo cual se
                                establece un rango de menor a mayor. Para agregar una pregunta de tipo escala num??rica
                                solo debe seleccionar del men?? de formulario y se desplegar?? un formulario para agregar
                                la pregunta y establecer el rango, para establecer el l??mite de valoraci??n solo debe de
                                desplazar el control de rango que se encuentra debajo del campo para agregar la
                                pregunta.<br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/15.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuaci??n, se visualiza una imagen de como se ve una pregunta de tipo escala num??rica.

                            <figure>
                                <img class="img-fluid w-100 mt-3" src="{{asset('img/manual-img/16.png')}}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_archivo">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta con imagen
                            </h5>
                            <p>
                                La pregunta con archivo imagen te permite formular una pregunta donde el usuario tiene
                                la opci??n de responder con una imagen. Para agregar una pregunta de tipo archivo solo
                                debe de seleccionar del men?? de formulario, la cual se desplegar?? un formulario para
                                ingresar la pregunta y una lista desplegable para seleccionar el tipo de formato que se
                                aceptar?? en el formulario de subir archivo.
                                <br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid mt-3" src="{{asset('img/manual-img/17.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuaci??n, se visualiza una imagen de como se ve una pregunta de tipo archivo.

                            <figure>
                                <img class="img-fluid w-100" src="{{asset('img/manual-img/18.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_tabla">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta tabla din??mica
                            </h5>
                            <p>
                                La pregunta con tabla din??mica permite generar una pregunta con una tabla din??mica que
                                admite agregar m??ltiples respuestas.
                                Para agregar una pregunta se debe de seleccionar la opci??n tabla lo cual
                                despliega unas opciones para agregar campos y eliminar campos, en el que hay un m??ximo
                                de 10 columnas que se pueden agregar para formar una tabla. Los campos que se llegue a
                                insertar son los que se utilizan para formar el encabezado de cada columna de la tabla.
                                <br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/19.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuaci??n, se visualiza una imagen de una pregunta con Tabla din??mica.

                            <figure>
                                <img class="img-fluid w-100" src="{{asset('img/manual-img/20.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_nota">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Nota
                            </h5>
                            <p>
                                Adem??s de las preguntas tambi??n se pueden agregar notas dentro de la encuesta. Lo cual
                                este tipo de notas te permite insertar texto o p??rrafos dentro de tu encuesta para
                                describir o especificar cierta parte de tu encuesta como por ejemplo especificar un
                                bloque de preguntas.
                                <br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/21.png')}}" alt="Imagen del Formulario nota" style="width: 400px;">
                            </figure>

                        </div>
                    </div>


                    <div class="container w-75 float-left pb-3" id="edit_pre">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Eliminar / Editar pregunta
                            </h5>
                            <p>
                                Para editar o eliminar una pregunta registrado en la encuesta este debe de seleccionar
                                la pregunta y dar clic en el icono de editar o eliminar que se encuentra ubicado en el
                                lado superior derecho de la pregunta.
                                <br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid w-75" src="{{asset('img/manual-img/22.png')}}" alt="">
                            </figure>

                        </div>
                    </div>


                    <div class="container w-75 float-left pb-3" id="edit_enc">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Editar encuesta
                            </h5>
                            <p>
                                Para editar una encuesta debe de ingresar a la opci??n mis encuestas donde tendr?? una
                                consulta de todas las encuesta terminadas y pendientes, para empezar a editar una
                                encuesta este debe de estar en estado pendiente.
                            </p>
                            <figure>
                                <img class="img-fluid w-100" src="{{asset('img/manual-img/23.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="compartir">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Compartir
                            </h5>
                            <p>
                                Para compartir una encuesta, solo seleccione la encuesta a compartir en el listado de
                                encuestas creadas la opci??n<br />

                                Mas <span class="text-danger">></span> Compartir<br />
                                Una vez seleccionado compartir se mostrar?? un interfaz con un formulario donde debe de
                                seleccionar alg??nas opciones para establecer el modo de envi?? de la
                                encuesta.<br /><br />
                                Correo electr??nico<br />
                                Le permite enviar encuestas a usuarios ajenos de la plataforma.<br /><br />


                                Usuario de la plataforma DEENDI<br />
                                Le permite enviar encuestas a usuarios registrados en la plataforma.<br />

                                Seleccionar para quien, las cuales tiene las siguientes opciones.<br />
                                ??? Ingresar un correo electr??nico manualmente.<br />
                                ??? Seleccionar grupo de trabajo<br />
                                ??? Seleccionar un contacto ya registrado en la plataforma.<br />

                                <strong>Nota</strong>: Si el correo no est?? registrado en la plataforma no se podr??
                                enviar la encuesta y
                                esto se notifica con un mensaje de alerta que el correo no ha sido encontrado.

                            </p>
                            <figure>
                                <img class="img-fluid w-50" src="{{asset('img/manual-img/24.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="responder">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Responder encuesta
                            </h5>
                            <p>
                                Una vez que su encuesta est?? finalizada podr?? aplicar, para ello deber?? de seleccionar
                                la encuesta en la lista de encuestas creadas y seleccionar la opci??n.<br /> <br />
                                Mas <span class="text-danger">></span> Aplicar<br /> <br />
                                Este se abrir?? una pesta??a nueva con la encuesta a aplicar.
                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/25.png')}}" alt="Responder encuesta" style="width: 500px;">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="analisis">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Analizar resultados
                            </h5>
                            <p>
                                La plataforma te permite analizar resultados de cada encuesta aplicada como un resultado
                                resumido de toda la informaci??n obtenida, para esto debe de seleccionar la opci??n
                                resultados del men?? lateral. <br /><br />
                                Resultados <span class="text-danger">></span> seleccionar la encuesta <span
                                    class="text-danger">></span> seleccionar opci??n An??lisis.<br /><br />
                                En la siguiente imagen se muestra una consulta de todas las encuestas aplicadas.
                            </p>
                            <figure>
                                <img class="img-fluid w-75" src="{{asset('img/manual-img/26.png')}}" alt="">
                            </figure>

                            <p>
                                Para analizar los datos obtenidos de la encuesta aplicada debe de seleccionar una encuesta que dese analizar y seleccionar el icono de la gr??fica que se ubica de lado derecho de todas las encuestas consultados para ver los resultados recabados.  
                                <br/><br/>
                                Para ello podr?? analizar los datos de la siguiente manera. 
                            </p>

                            <p>Resumen general</p>

                            <p>
                                En resultado resumido muestra un total de todos los datos obtenidos, mostrado un listado
                                de todas las respuestas recabadas de la pregunta opci??n abierta, para las preguntas de
                                selecci??n muestra los resultados de forma gr??fica, para las preguntas con archivos
                                muestra un listado de todos los archivos recabados y para a pregunta con tabla muestra
                                un listado de todas las tablas recabadas de cada encuesta aplicada.
                            </p>
                            <p>
                                Graficas a visualizar
                                <ul>
                                    <li>Pie (Pregunta con opci??n ??nico y men?? desplegable)</li>
                                    <li>Dona (Pregunta con opci??n m??ltiple)</li>
                                    <li>Barra (Pregunta de tipo escala num??rica)</li>
                                </ul>
                            </p>

                            <p>
                                En la siguiente imagen se muestra un ejemplo de una encuesta aplicada con los datos obtenidos de forma resumido.<br/><br/>
                                <figure>
                                    <img class="img-fluid w-75" src="{{asset('img/manual-img/35.png')}}" alt="">
                                </figure>
                            </p>

                            <p>General</p>
                            <p>En resultado general tiene la posibilidad de analizar los resultados de cada encuesta
                                aplicada y analizar los resultados de los usuarios que respondieron la encuesta.</p>

                            <p>
                                En la siguiente imagen se muestra un ejemplo de consulta de resultados general de la encuesta aplicada. <br/><br/>
                                <figure>
                                    <img class="img-fluid w-75" src="{{asset('img/manual-img/32.png')}}" alt="">
                                </figure>
                            </p>    

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="reporte">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Descargar reporte
                            </h5>
                            <p>
                                Para generar un reporte de los resultados obtenidos, la plataforma ofrece la opci??n de
                                descargar un reporte en formato PDF de los resultados obtenidos, para ello debe de
                                ingresar en la opci??n del men??.<br /> <br />
                                Resultados <span class="text-danger">></span> 
                                An??lisis <span class="text-danger">></span> 
                                PDF 
                                <br /><br />
                                
                                Para ello al seleccionar la opci??n PDF este abrir?? una nueva pesta??a en su navegador, la cual muestra la encuesta con todos los datos obtenidos de las veces que ha sido aplicado.

                                <br/><br/>

                                Por lo tanto, una vez abierto la pesta??a debe de esperar unos segundos en lo que se activa la opci??n de descargar su reporte. Para esto se mostrar una ventana que le permitir?? descargar su reporte, adem??s del lado derecho tiene algunas configuraciones basicas para ajustar el color, m??rgenes, paginas, escala entre otras para su personalizaci??n. 

                                <br/><br/>
                                
                                En la siguiente ilustraci??n vera el panel para la descarga del reporte y de los ajustes para personalizar su reporte.

                                <br/><br/>

                                <figure>
                                    <img class="img-fluid w-75" src="{{asset('img/manual-img/34.png')}}" alt="">
                                </figure>

                                <br/><br/>
                                
                                Ajustes de personalizaci??n.

                                <br/><br/>

                                <figure>
                                    <img class="img-fluid w-50" src="{{asset('img/manual-img/33.png')}}" alt="">
                                </figure>

                                <strong>Nota</strong>: para poder descargar el reporte se debe de abrir desde el
                                navegador de Chrome.

                            </p>
                            

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="contacto">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Contactos
                            </h5>
                            <p>
                                Deendi tiene la funcionalidad de gestionar una agenda de contactos que te permite llevar
                                un control de quienes puedes compartir tu encuesta para que te respondan y as?? evitar la
                                fatiga de estar buscando correos de tus usuarios que desees enviar tus
                                encuestas.<br /><br />
                                Para poder registrar contactos debe de ingresar en la agenda y seleccionar la opci??n
                                nuevo contacto, este se desplegar?? una ventana modal con un formulario donde tiene que
                                ingresar el nombre, apellido paterno, apellido materno y correo electr??nico del usuario
                                a registrar. Adem??s, tiene la opci??n de activar la casilla de invitaci??n para notificar
                                al usuario que fue agregado como contacto en la plataforma DEENDI.
                            </p>
                            <p class="mt-2 alert alert-info">
                                <strong>Nota</strong>: La plataforma solo acepta correos de servidores de Gmail,
                                Outlook, Hotmail, Yahoo!
                            </p>
                            <figure>
                                <img class="img-fluid w-50" src="{{asset('img/manual-img/28.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="grupos">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Grupos de trabajo
                            </h5>
                            <p>
                                De igual manera como los contactos tambi??n deendi permite crear grupos de trabajos para
                                enviar en un solo envi?? a m??ltiples usuarios una encuesta.<br /><br />
                                Para crear grupos de trabajo en la plataforma, solo se necesita tener contactos
                                registrados ya que sin ellos no podr?? crear grupos.<br /><br />
                                Como primer paso es ingresar a la opci??n de grupos, una vez que se encuentre en la
                                interfaz de grupos deber?? de seleccionar la opci??n Crear grupo, este se desplegara una
                                ventana modal donde deber?? de ingresar el nombre del grupo como seleccionar los
                                integrantes que participaran en este grupo. Una vez que tenga seleccionado los contactos
                                que pertenecer??n al grupo, seleccione Crear grupo.

                            </p>
                            <p class="mt-2 alert alert-warning">
                                <strong>Nota</strong>: La plataforma no permite crear grupos con nombre repetidos.
                                Adem??s, si no tiene contactos registrados no podr?? crear grupos de trabajo.

                            </p>
                            <figure>
                                <img class="img-fluid w-50" src="{{asset('img/manual-img/29.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="perfil">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Cuenta
                            </h5>
                            <p>
                                Como usuario, una vez que haya creado una cuenta en nuestra plataforma podr?? actualizar
                                sus datos personales posteriormente.
                                Para realizar esta funci??n solo necesita entrar en su perfil y podr??s visualizar tus datos personales como la opci??n de actualizar algunas de tus datos para tu perfil. 
                            </p>

                            <figure>
                                <img class="img-fluid w-75" src="{{asset('img/manual-img/30.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 text-center float-left pb-3 bg-light-gray border-top">
                        <p class="pt-3">Derechos reservados &copy;2020</p>
                    </div>


            </main>
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="dashboard.js"></script>
</body>

</html>
