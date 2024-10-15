<main class="main-2">
    <h1><?= htmlspecialchars($title); ?></h1>
    <div class="project-section">
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <div class="project-box">
                    <h2 class="project-title"><?= htmlspecialchars($project['title']); ?></h2>
                    <p><?= htmlspecialchars($project['description']); ?></p>
                    <a href="<?= htmlspecialchars($project['project_link']); ?>" target="_blank">
                        <button>BEKIJK PROJECT</button>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen projecten gevonden.</p>
        <?php endif; ?>
    </div>
</main>ss