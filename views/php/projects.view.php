<main class="main-2">
    <h1><?= htmlspecialchars($title); ?></h1>

    <!-- Filter Formulier -->
    <form method="GET" action="">
        <label for="technology">Filter op Technologie:</label>
        <select name="technology" id="technology">
            <option value="">Alle technologieën</option>
            <option value="PHP" <?= $technology == 'PHP' ? 'selected' : '' ?>>PHP</option>
            <option value="JavaScript" <?= $technology == 'JavaScript' ? 'selected' : '' ?>>JavaScript</option>
            <option value="HTML" <?= $technology == 'HTML' ? 'selected' : '' ?>>HTML</option>
            <option value="CSS" <?= $technology == 'CSS' ? 'selected' : '' ?>>CSS</option>
            <option value="MySQL" <?= $technology == 'MySQL' ? 'selected' : '' ?>>MySQL</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <section class="project-section">
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
    <section/>
</main>
