<main class="main-2">
    <h1 class="project-title"><?= htmlspecialchars($project['title']); ?></h1>
    <section class="project-details">
        <div class="project-info">
            <p><strong>Beschrijving:</strong> <?= htmlspecialchars($project['description']); ?></p>
            <p><strong>Technologieën:</strong> <?= htmlspecialchars($project['technologies_used'] ?? 'N.v.t.'); ?></p>
            <div class="project-links">
                <a href="<?= htmlspecialchars($project['project_link']); ?>" class="button" target="_blank">Bekijk Project</a>
                <a href="<?= htmlspecialchars($project['github_link']); ?>" class="button" target="_blank">Bekijk op GitHub</a>
            </div>
        </div>
    </section>
</main>