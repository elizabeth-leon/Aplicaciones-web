    <!-- página web con información personal  -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="Página personal de Sarita León, analista de datos y software.">

    <title>Sarita León | Página personal</title>

    <!-- archivo que contiene el diseño de la página -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="pagina" id="inicio">

        <!--
            portada de la página
            la imagen de fondo se coloca desde el CSS
        -->
        <header class="portada">
            <div class="presentacion">
                <h1>Sarita Elizabeth<br>León Aguiar</h1>
                <p class="cargo">Analista de Datos y Software</p>
            </div>

            <img class="foto"
                 src="foto.png"
                 alt="Fotografía de Sarita León"
                 width="180"
                 height="180">
        </header>

        <!-- los enlaces permiten ir a cada sección -->
        <nav class="navegacion" aria-label="Menú principal">
            <a href="#perfil">Perfil</a>
            <a href="#experiencia">Experiencia</a>
            <a href="#proyectos">Proyectos</a>
            <a href="#formacion">Formación</a>
            <a href="#calculadora">Calculadora</a>
        </nav>

        <div class="distribucion">

            <!-- columna lateral con información de contacto -->
            <aside class="lateral">
                <section>
                    <h2>Mis datos</h2>

                    <p class="rotulo">UBICACIÓN</p>
                    <p>Riobamba, Ecuador</p>

                    <p class="rotulo">CORREO</p>
                    <a href="mailto:saritaelizabethleon@gmail.com">
                        saritaelizabethleon@gmail.com
                    </a>

                    <!-- cermite llamar desde un dispositivo compatible -->
                    <p class="rotulo">CELULAR</p>
                    <p>0987750281</p>

                    <p class="rotulo">ÁREA PROFESIONAL</p>
                    <p>Análisis de datos y desarrollo de software.</p>
                </section>

                <section>
                    <h2>Herramientas</h2>

                    <ul class="herramientas">
                        <li>Python</li>
                        <li>SQL</li>
                        <li>TypeScript</li>
                        <li>R</li>
                        <li>PostgreSQL</li>
                        <li>Power BI</li>
                    </ul>
                </section>

                <section>
                    <h2>Mis intereses</h2>

                    <ul>
                        <li>Ingeniería de datos.</li>
                        <li>Desarrollo web.</li>
                        <li>Automatización.</li>
                        <li>Innovación tecnológica.</li>
                    </ul>
                </section>

                <!-- abre la aplicación de correo del visitante -->
                <a class="boton-contacto"
                   href="mailto:saritaelizabethleon@gmail.com">
                    Contactarme
                </a>
            </aside>

            <!-- información principal de mi página -->
            <main class="contenido">

                <section id="perfil">
                    <h2>Perfil profesional</h2>

                    <p>
                        Soy una profesional con más de cuatro años de
                        experiencia en análisis de datos, desarrollo
                        de soluciones de software, diseño de bases
                        de datos e integración de sistemas.
                    </p>

                    <p>
                        He participado en proyectos de aplicaciones
                        web y móviles, automatización de procesos y
                        sistemas de monitoreo. Actualmente estudio
                        Ingeniería de Software en UNIANDES.
                    </p>

                    <div class="destacado">
                        Mi objetivo es crear soluciones tecnológicas
                        que faciliten los procesos y ayuden a tomar
                        mejores decisiones.
                    </div>
                </section>

                <!-- experiencia organizada desde la más reciente -->
                <section id="experiencia">
                    <h2>Experiencia profesional</h2>

                    <article class="experiencia">
                        <p class="fecha">Julio 2025 – Actualidad</p>
                        <h3>Analista de Software</h3>
                        <p class="empresa">RIOSOFT</p>

                        <ul>
                            <li>
                                Diseño y administración de bases de
                                datos en PostgreSQL.
                            </li>
                            <li>
                                Desarrollo y optimización de consultas SQL.
                            </li>
                            <li>
                                Participación en interfaces con
                                TypeScript e integración de API REST.
                            </li>
                            <li>
                                Elaboración de dashboards en Power BI.
                            </li>
                        </ul>
                    </article>

                    <article class="experiencia">
                        <p class="fecha">Abril 2025 – Octubre 2025</p>
                        <h3>Analista de Datos</h3>
                        <p class="empresa">NETBY</p>

                        <ul>
                            <li>
                                Desarrollo de procesos ETL con Python y SQL.
                            </li>
                            <li>
                                Limpieza, validación e integración de datos.
                            </li>
                            <li>
                                Automatización de actualizaciones
                                y creación de dashboards.
                            </li>
                        </ul>
                    </article>

                    <article class="experiencia">
                        <p class="fecha">Abril 2024 – Abril 2025</p>
                        <h3>Investigadora externa</h3>
                        <p class="empresa">ESPOCH · GRIISOFT</p>

                        <ul>
                            <li>
                                Participación en soluciones tecnológicas
                                de investigación e innovación.
                            </li>
                            <li>
                                Integración de sensores, aplicaciones
                                y sistemas de monitoreo.
                            </li>
                            <li>
                                Apoyo en procesamiento y visualización
                                de información.
                            </li>
                        </ul>
                    </article>

                    <article class="experiencia">
                        <p class="fecha">Abril 2022 – Abril 2024</p>
                        <h3>Analista de Datos</h3>
                        <p class="empresa">
                            Universidad del Azuay · Proyecto SWACH
                        </p>

                        <ul>
                            <li>
                                Procesamiento de datos hidrometeorológicos
                                con Python y R.
                            </li>
                            <li>
                                Automatización de análisis y aplicación
                                de modelos estadísticos y predictivos.
                            </li>
                            <li>
                                Desarrollo de dashboards en Power BI.
                            </li>
                        </ul>
                    </article>
                </section>

                <!-- Proyectos en los que he participado -->
                <section id="proyectos">
                    <h2>Proyectos destacados</h2>

                    <div class="proyectos">
                        <article class="tarjeta">
                            <span class="categoria">MONITOREO</span>
                            <h3>SMARTCUY</h3>

                            <p>
                                Participación en un sistema inteligente
                                de monitoreo y automatización de
                                parámetros ambientales y productivos
                                para la crianza de cuyes.
                            </p>

                            <p class="reconocimiento">
                                Ganador del Reto de Innovación del HUB ITT.
                            </p>
                        </article>

                        <article class="tarjeta">
                            <span class="categoria">MOVILIDAD</span>
                            <h3>RioMov</h3>

                            <p>
                                Participación en una aplicación móvil
                                para consultar rutas de transporte
                                público e indicadores de movilidad
                                de Riobamba.
                            </p>

                            <p class="reconocimiento">
                                Ganador del concurso RioInnova.
                            </p>
                        </article>

                        <article class="tarjeta">
                            <span class="categoria">ANÁLISIS DE DATOS</span>
                            <h3>Proyecto SWACH</h3>

                            <p>
                                Integración y análisis de información
                                climática e hidrológica mediante
                                Python, R y Power BI.
                            </p>
                        </article>
                    </div>
                </section>

                <!-- formación académica -->
                <section id="formacion">
                    <h2>Formación académica</h2>

                    <article class="estudio">
                        <span class="estado">En curso</span>
                        <h3>Ingeniería de Software</h3>
                        <p>Universidad Regional Autónoma de los Andes.</p>
                    </article>

                    <article class="estudio">
                        <span class="estado">Finalizado</span>
                        <h3>Ingeniería en Recursos Naturales Renovables</h3>
                        <p>Formación profesional de tercer nivel.</p>
                    </article>
                </section>

                <!--
                    solo se muestra el diseño de la calculadora
                    después con el PHP se realiza las operaciones
                -->
<!-- calculadora  -->
<section id="calculadora">
    <h2>Calculadora básica</h2>

    <?php
    /*
     variables para guardar el resultado
     y los mensajes de error
    */
    $resultado = null;
    $error = "";

    /*
     se reciben los datos al pulsar calcular
    */
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $numero1 = $_POST["numero1"] ?? "";
        $numero2 = $_POST["numero2"] ?? "";
        $operacion = $_POST["operacion"] ?? "";

        if (!is_numeric($numero1) || !is_numeric($numero2)) {
            $error = "Ingresa dos números válidos.";
        } else {
            $numero1 = (float) $numero1;
            $numero2 = (float) $numero2;

            /*
             se realiza la operación seleccionada
            */
            switch ($operacion) {
                case "sumar":
                    $resultado = $numero1 + $numero2;
                    break;

                case "restar":
                    $resultado = $numero1 - $numero2;
                    break;

                case "multiplicar":
                    $resultado = $numero1 * $numero2;
                    break;

                case "dividir":
                    if ($numero2 == 0) {
                        $error = "No se puede dividir entre cero.";
                    } else {
                        $resultado = $numero1 / $numero2;
                    }
                    break;

                default:
                    $error = "Selecciona una operación válida.";
            }
        }
    }
    ?>

    <div class="caja-calculadora">
        <form method="post" action="#calculadora">
            <fieldset>
                <legend>Operaciones con dos números</legend>

                <label for="numero1">Primer número</label>
                <input type="number"
                       id="numero1"
                       name="numero1"
                       step="any"
                       placeholder="Ejemplo: 10"
                       required>

                <label for="operacion">Operación</label>
                <select id="operacion" name="operacion" required>
                    <option value="sumar">Sumar (+)</option>
                    <option value="restar">Restar (−)</option>
                    <option value="multiplicar">Multiplicar (×)</option>
                    <option value="dividir">Dividir (÷)</option>
                </select>

                <label for="numero2">Segundo número</label>
                <input type="number"
                       id="numero2"
                       name="numero2"
                       step="any"
                       placeholder="Ejemplo: 5"
                       required>

                <button type="submit">Calcular</button>
            </fieldset>
        </form>

        <!-- se muestra el error o el resultado -->
        <?php if ($error !== ""): ?>
            <p class="mensaje-error" role="alert">
                <?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?>
            </p>

        <?php elseif ($resultado !== null): ?>
            <p class="resultado" role="status">
                <strong>Resultado:</strong>
                <?= htmlspecialchars(
                    (string) $resultado,
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>
            </p>
        <?php endif; ?>
    </div>
</section>
            </main>
        </div>

        <!-- pie de pagina -->
        <footer>
            <p>© 2026 Sarita León · Aplicaciones Web · UNIANDES</p>
            <a href="#inicio">Volver al inicio ↑</a>
        </footer>
    </div>
</body>
</html>