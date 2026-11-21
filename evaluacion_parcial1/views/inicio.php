<section class="intro">
                <h1>Organiza tus eventos deportivos</h1>
                <p>Administra competencias, registra deportistas y controla las inscripciones desde una sola plataforma.</p>
                <a class="btn" href="<?= h(url('evento_form')) ?>">+ Crear evento</a>
            </section>
            <div class="stats">
                <div class="stat"><strong><?= $totalEventos ?></strong><span>Eventos registrados</span></div>
                <div class="stat"><strong><?= $totalParticipantes ?></strong><span>Participantes</span></div>
                <div class="stat"><strong><?= $totalInscripciones ?></strong><span>Inscripciones</span></div>
            </div>
            <section class="panel"><div class="headline"><div><h2>Próximos eventos</h2><p class="subtitle">Actividades programadas desde hoy.</p></div><a class="btn btn-light" href="<?= h(url('eventos')) ?>">Ver todos</a></div>
            <div class="table-wrap"><table><thead><tr><th>Evento</th><th>Fecha</th><th>Ubicación</th><th>Inscritos</th></tr></thead><tbody>
            <?php foreach ($proximos as $e): ?><tr><td><?= h($e['nombre']) ?></td><td><?= h($e['fecha']) ?></td><td><?= h($e['ubicacion']) ?></td><td><span class="pill"><?= (int)$e['cantidad'] ?></span></td></tr><?php endforeach; ?>
            <?php if (!$proximos): ?><tr><td colspan="4" class="empty">No hay eventos próximos. Puedes crear el primero.</td></tr><?php endif; ?>
            </tbody></table></div></section>
