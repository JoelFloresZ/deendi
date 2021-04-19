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
                                Introducción
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
                                Iniciar sesión
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#reset_pass">
                                <span data-feather="layers"></span>
                                Restablecer contraseña
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
                                Pregunta opción simple
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_multiple">
                                <span data-feather="layers"></span>
                                Pregunta opción múltiple
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_desplegable">
                                <span data-feather="layers"></span>
                                Pregunta con menú desplegable
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#pre_numerica">
                                <span data-feather="layers"></span>
                                Pregunta de tipo escala numérica
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
                                Tabla dinámica
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
                        <span>Administración</span>
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
                                Introducción
                            </h5>
                            <p>
                                Esta es un pequeño introductorio que como trabajar con la plataforma de DEENDI, donde se
                                explican algunas funcionalidades para obtener una mejor experiencia con la herramienta.
                            </p>

                            <strong>Empecemos</strong><br><br>
                            <p>
                                La plataforma deendi permite crear encuestas de forma dinámica, lo cual al implementar
                                este
                                tipo de encuesta ayuda a obtener mejores resultados, Optimiza los tiempos en desarrollar
                                una
                                encuesta, Analizar los datos obtenidos y además le ofrecemos al usuario una forma más
                                interactiva en responda un formulario, asimismo cuenta con su propia administración de
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
                                Para crear una cuenta en nuestra plataforma, solo debe de ingresar a la opción REGISTRO
                                que se encuentra disponible en la página principal, una vez que se encuentre en la
                                sección de registro solo debe de llenar los campos con sus datos personales que se piden
                                en el formulario
                            </p>

                            <p class="alert alert-warning">
                                Todos los campos son obligatorios además el correo electrónico que proporcione debe ser
                                un correo valido ya que por medio de esa dirección se le llegara una notificación para
                                la validación de su correo electrónico y proceder con su acceso a la plataforma.
                            </p>
                            <p>
                                En la siguiente imagen se visualiza el formulario de registro.
                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/1.png')}}" alt=""
                                    style="width: 350px;">
                            </figure>

                            <p>
                                Una vez que finalice de ingresar los datos en el formulario y presione el botón de
                                REGISTRO se le notificará a su correo electrónico, lo cual para confirmar su correo debe
                                de ingresar a su cuenta de correo que proporciono en el registro y abrir el correo que
                                recibirá desde DEENDI donde debe de confirmar su cuenta. En la siguiente imagen se
                                muestra una notificación de la plataforma.
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
                                Si previamente ya se registró en la plataforma DEENDI, ahora debe de seleccionar la
                                opción del menú iniciar sesión e ingresar sus datos de usuario en el formulario INICIAR
                                SESIÓN para acceder a la plataforma.
                                Los datos de usuario que se solicitan son el correo electrónico y una contraseña que se
                                ingresó al momento de registrarse en la plataforma.
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
                                Restablecer contraseña
                            </h5>
                            <p>
                                Si en dado caso olvido su contraseña, para poder restablecer una nueva deberá de
                                seleccionar el enlace ¿Olvidaste tu contraseña? en la parte inferior del formulario de
                                iniciar sesión para ir a la página de solicitar link de restablecer contraseña, por lo
                                cual debe de ingresar su correo electrónico con el que se registró en la plataforma para
                                poder solicitar el link de restablecer contraseña.<br />
                                Formulario para solicitar link de restablecer contraseña.

                            </p>

                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/4.png')}}" alt=""
                                    style="width: 300px;">
                            </figure>

                            <p>Formulario para restablecer contraseña</p>
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
                                Una de las funciones más importantes de DEENDI es la creación de encuestas, por lo cual
                                para crear una encuesta solo debe de ir a la sección mis encuestas del menú lateral de
                                la plataforma y seleccionar la opción nueva encuesta lo cual mostrará un formulario para
                                ingresar los datos de la encuesta a generar.
                            </p>

                            <figure>
                                <img class="img-fluid w-100" src="{{asset('img/manual-img/6.png')}}"
                                    alt="Crear encuesta">
                            </figure>

                            <p class="alert alert-warning">
                                Si ingresa un título de la encuesta ya existente en tu bandeja de encuesta, se le
                                notificara con un mensaje de alerta ya tiene registrado una encuesta con el mismo nombre
                                y ya no se crearía la encuesta hasta que sea un título diferente de los que ya tiene
                                registrado<br />
                                <strong>NOTA</strong>: No puede crear encuestas con el mismo título que ya están
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
                                la información que se recopile, esta plataforma permite hasta 8 tipos de preguntas las
                                cuales son:
                            </p>

                            <ul class="list-group">
                                <li class="nav-item"><a class="nav-link" href="#pre_abierta">Pregunta abierta</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_simple">Pregunta de selección
                                        única</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_multiple">Pregunta se selección
                                        múltiple</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_desplegable">Pregunta con menú
                                        desplegable</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pre_numerica">Pregunta tipo escala
                                        numérica</a></li>
                                <li class="nav-item"><a class="nav-link" href="#imagen">Pregunta con archivo imagen</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#tabla">Pregunta con tabla dinámica</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#nota">Notas</a></li>
                            </ul>

                            <p>
                                Las preguntas se describen de manera más detallada en cada sesión cuál es su uso y que
                                tipo de información le permite capturar de acuerdo al diseño de su encuesta.</p>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_abierta">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5" id="abierta">#</span>
                                Pregunta abierta
                            </h5>
                            <p>
                                La pregunta de opción abierta contiene respuestas libres los cuales se clasifica en
                                respuestas cortas y de Párrafo de acuerdo al tamaño que considere la captura de su
                                información.<br /><br />
                                Este tipo de preguntas son para que el encuestado tenga total libertad en responder la
                                pregunta con sus propias palabras o dando su opinión sobre el tema o problemática.<br />
                                En la siguiente imagen se muestra el formulario para formular una pregunta de tipo
                                abierta.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/7.png')}}" alt="form abierta"
                                    style="width: 400px;">
                            </figure>

                            A continuación, se visualiza una imagen de como se muestra una pregunta de tipo pregunta
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
                                Pregunta de selección única
                            </h5> 
                            <p>
                                Las preguntas de selección única solo se elige una respuesta para este tipo de preguntas
                                los cuales pueden ser de tipo verdadero o falso, categorías y rangos. Para agregar una
                                pregunta de tipo selección simple solo deberá de seleccionar del menú y se desplegará un
                                formulario para ingresar la pregunta y las opciones que contendrá la pregunta, al
                                mostrar la primera vez el formulario solo muestra dos campos para las opciones, para
                                agregar más opciones debe de seleccionar el icono de “Mas” para agregar más campos para
                                ingresar más opciones.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/9.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuación, se visualiza una imagen de como se muestra una pregunta de selección único
                            en la encuesta.
                            <figure>
                                <img class="img-fluid w-100 mt-3" src="{{asset('img/manual-img/10.png')}}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_multiple">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta de selección múltiple
                            </h5>
                            <p>
                                Las preguntas de opción múltiple permiten a los encuestados seleccionar una o varias
                                opciones de una lista de respuestas que tú defines en el diseño de la encuesta. Son
                                intuitivas, fáciles de usar de distintas maneras, ayudan a generar datos fáciles de
                                analizar y proporcionan opciones. Para agregar una pregunta de tipo selección múltiple
                                solo debe de seleccionar del menú de formularios y se desplegara un formulario para
                                ingresar la pregunta y las posibles opciones, de igual como la pregunta de selección
                                única solo muestra dos campos para las opciones, para agregar más campos solo debe de
                                seleccionar el icono “Mas” para registrar mas opciones.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/11.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuación, se visualiza una imagen de cómo se ve una pregunta de tipo opción múltiple
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
                                Las preguntas con menú desplegable son otra manera de mostrar opciones en lista, lo cual
                                ofrece una lista desplegable con opciones de respuesta y solicita a los usuarios que
                                seleccione una respuesta. Este es una excelente opción que te permite ahorrar espacio si
                                tiene un gran listado de opciones que presentar.<br /><br />
                                Para agregar una pregunta desplegable solo debe de seleccionar del menú de formularios y
                                se desplegara un formulario para ingresar el título y las posibles opciones de igual
                                manera como las preguntas de selección única y múltiple.

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/13.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuación, se visualiza una imagen de como se ve una pregunta de opción desplegable.

                            <figure>
                                <img class="img-fluid w-100 mt-3" src="{{asset('img/manual-img/14.png')}}" alt="">
                            </figure>
                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_numerica">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta escala numérica
                            </h5>
                            <p>
                                Las preguntas de tipo escala numérica, permite a los encuestados que valoren una
                                declaración mediante una escala numera que va desde 1 - 5 a 1-10, por lo cual se
                                establece un rango de menor a mayor. Para agregar una pregunta de tipo escala numérica
                                solo debe seleccionar del menú de formulario y se desplegará un formulario para agregar
                                la pregunta y establecer el rango, para establecer el límite de valoración solo debe de
                                desplazar el control de rango que se encuentra debajo del campo para agregar la
                                pregunta.<br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/15.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuación, se visualiza una imagen de como se ve una pregunta de tipo escala numérica.

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
                                la opción de responder con una imagen. Para agregar una pregunta de tipo archivo solo
                                debe de seleccionar del menú de formulario, la cual se desplegará un formulario para
                                ingresar la pregunta y una lista desplegable para seleccionar el tipo de formato que se
                                aceptará en el formulario de subir archivo.
                                <br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid mt-3" src="{{asset('img/manual-img/17.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuación, se visualiza una imagen de como se ve una pregunta de tipo archivo.

                            <figure>
                                <img class="img-fluid w-100" src="{{asset('img/manual-img/18.png')}}" alt="">
                            </figure>

                        </div>
                    </div>

                    <div class="container w-75 float-left pb-3" id="pre_tabla">
                        <div class="mt-5">
                            <h5 class="text-muted pt-4"><span class="text-success mr-1 h5">#</span>
                                Pregunta tabla dinámica
                            </h5>
                            <p>
                                La pregunta con tabla dinámica permite generar una pregunta con una tabla dinámica que
                                admite agregar múltiples respuestas.
                                Para agregar una pregunta se debe de seleccionar la opción tabla lo cual
                                despliega unas opciones para agregar campos y eliminar campos, en el que hay un máximo
                                de 10 columnas que se pueden agregar para formar una tabla. Los campos que se llegue a
                                insertar son los que se utilizan para formar el encabezado de cada columna de la tabla.
                                <br /><br />

                            </p>
                            <figure>
                                <img class="img-fluid" src="{{asset('img/manual-img/19.png')}}" alt="" style="width: 400px;">
                            </figure>

                            A continuación, se visualiza una imagen de una pregunta con Tabla dinámica.

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
                                Además de las preguntas también se pueden agregar notas dentro de la encuesta. Lo cual
                                este tipo de notas te permite insertar texto o párrafos dentro de tu encuesta para
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
                                Para editar una encuesta debe de ingresar a la opción mis encuestas donde tendrá una
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
                                encuestas creadas la opción<br />

                                Mas <span class="text-danger">></span> Compartir<br />
                                Una vez seleccionado compartir se mostrará un interfaz con un formulario donde debe de
                                seleccionar algúnas opciones para establecer el modo de envió de la
                                encuesta.<br /><br />
                                Correo electrónico<br />
                                Le permite enviar encuestas a usuarios ajenos de la plataforma.<br /><br />


                                Usuario de la plataforma DEENDI<br />
                                Le permite enviar encuestas a usuarios registrados en la plataforma.<br />

                                Seleccionar para quien, las cuales tiene las siguientes opciones.<br />
                                • Ingresar un correo electrónico manualmente.<br />
                                • Seleccionar grupo de trabajo<br />
                                • Seleccionar un contacto ya registrado en la plataforma.<br />

                                <strong>Nota</strong>: Si el correo no está registrado en la plataforma no se podrá
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
                                Una vez que su encuesta esté finalizada podrá aplicar, para ello deberá de seleccionar
                                la encuesta en la lista de encuestas creadas y seleccionar la opción.<br /> <br />
                                Mas <span class="text-danger">></span> Aplicar<br /> <br />
                                Este se abrirá una pestaña nueva con la encuesta a aplicar.
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
                                resumido de toda la información obtenida, para esto debe de seleccionar la opción
                                resultados del menú lateral. <br /><br />
                                Resultados <span class="text-danger">></span> seleccionar la encuesta <span
                                    class="text-danger">></span> seleccionar opción Análisis.<br /><br />
                                En la siguiente imagen se muestra una consulta de todas las encuestas aplicadas.
                            </p>
                            <figure>
                                <img class="img-fluid w-75" src="{{asset('img/manual-img/26.png')}}" alt="">
                            </figure>

                            <p>
                                Para analizar los datos obtenidos de la encuesta aplicada debe de seleccionar una encuesta que dese analizar y seleccionar el icono de la gráfica que se ubica de lado derecho de todas las encuestas consultados para ver los resultados recabados.  
                                <br/><br/>
                                Para ello podrá analizar los datos de la siguiente manera. 
                            </p>

                            <p>Resumen general</p>

                            <p>
                                En resultado resumido muestra un total de todos los datos obtenidos, mostrado un listado
                                de todas las respuestas recabadas de la pregunta opción abierta, para las preguntas de
                                selección muestra los resultados de forma gráfica, para las preguntas con archivos
                                muestra un listado de todos los archivos recabados y para a pregunta con tabla muestra
                                un listado de todas las tablas recabadas de cada encuesta aplicada.
                            </p>
                            <p>
                                Graficas a visualizar
                                <ul>
                                    <li>Pie (Pregunta con opción único y menú desplegable)</li>
                                    <li>Dona (Pregunta con opción múltiple)</li>
                                    <li>Barra (Pregunta de tipo escala numérica)</li>
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
                                Para generar un reporte de los resultados obtenidos, la plataforma ofrece la opción de
                                descargar un reporte en formato PDF de los resultados obtenidos, para ello debe de
                                ingresar en la opción del menú.<br /> <br />
                                Resultados <span class="text-danger">></span> 
                                Análisis <span class="text-danger">></span> 
                                PDF 
                                <br /><br />
                                
                                Para ello al seleccionar la opción PDF este abrirá una nueva pestaña en su navegador, la cual muestra la encuesta con todos los datos obtenidos de las veces que ha sido aplicado.

                                <br/><br/>

                                Por lo tanto, una vez abierto la pestaña debe de esperar unos segundos en lo que se activa la opción de descargar su reporte. Para esto se mostrar una ventana que le permitirá descargar su reporte, además del lado derecho tiene algunas configuraciones basicas para ajustar el color, márgenes, paginas, escala entre otras para su personalización. 

                                <br/><br/>
                                
                                En la siguiente ilustración vera el panel para la descarga del reporte y de los ajustes para personalizar su reporte.

                                <br/><br/>

                                <figure>
                                    <img class="img-fluid w-75" src="{{asset('img/manual-img/34.png')}}" alt="">
                                </figure>

                                <br/><br/>
                                
                                Ajustes de personalización.

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
                                un control de quienes puedes compartir tu encuesta para que te respondan y así evitar la
                                fatiga de estar buscando correos de tus usuarios que desees enviar tus
                                encuestas.<br /><br />
                                Para poder registrar contactos debe de ingresar en la agenda y seleccionar la opción
                                nuevo contacto, este se desplegará una ventana modal con un formulario donde tiene que
                                ingresar el nombre, apellido paterno, apellido materno y correo electrónico del usuario
                                a registrar. Además, tiene la opción de activar la casilla de invitación para notificar
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
                                De igual manera como los contactos también deendi permite crear grupos de trabajos para
                                enviar en un solo envió a múltiples usuarios una encuesta.<br /><br />
                                Para crear grupos de trabajo en la plataforma, solo se necesita tener contactos
                                registrados ya que sin ellos no podrá crear grupos.<br /><br />
                                Como primer paso es ingresar a la opción de grupos, una vez que se encuentre en la
                                interfaz de grupos deberá de seleccionar la opción Crear grupo, este se desplegara una
                                ventana modal donde deberá de ingresar el nombre del grupo como seleccionar los
                                integrantes que participaran en este grupo. Una vez que tenga seleccionado los contactos
                                que pertenecerán al grupo, seleccione Crear grupo.

                            </p>
                            <p class="mt-2 alert alert-warning">
                                <strong>Nota</strong>: La plataforma no permite crear grupos con nombre repetidos.
                                Además, si no tiene contactos registrados no podrá crear grupos de trabajo.

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
                                Como usuario, una vez que haya creado una cuenta en nuestra plataforma podrá actualizar
                                sus datos personales posteriormente.
                                Para realizar esta función solo necesita entrar en su perfil y podrás visualizar tus datos personales como la opción de actualizar algunas de tus datos para tu perfil. 
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
