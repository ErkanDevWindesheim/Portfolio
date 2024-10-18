<main class="main-2">
    <h1><?= htmlspecialchars($title); ?></h1>
    <div class="project-section">
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <div class="project-box">
                    <h2 class="project-title"><?= htmlspecialchars($project['title']); ?></h2>
                    <a href="/project?id=<?= htmlspecialchars($project['id']); ?>">
                        <button>Bekijk Project</button>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen projecten gevonden.</p>
        <?php endif; ?>
    </div>
</main>