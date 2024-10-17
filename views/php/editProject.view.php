<?php if (isset($project)): ?>
<form action="/admin/editProject?id=<?= $project['id'] ?>" method="POST">
    <label for="title">Titel:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($project['title']) ?>" required>
    
    <label for="description">Beschrijving:</label>
    <textarea id="description" name="description" required><?= htmlspecialchars($project['description']) ?></textarea>

    <label for="technologies_used">Technologieën:</label>
    <input type="text" id="technologies_used" name="technologies_used" value="<?= htmlspecialchars($project['technologies_used']) ?>" required>

    <label for="project_link">Project Link:</label>
    <input type="url" id="project_link" name="project_link" value="<?= htmlspecialchars($project['project_link']) ?>" placeholder="https://example.com" required>

    <label for="github_link">GitHub Link:</label>
    <input type="url" id="github_link" name="github_link" value="<?= htmlspecialchars($project['github_link']) ?>" placeholder="https://github.com/example" required>

    <button type="submit">Update Project</button>
</form>
<?php else: ?>
<p>Project niet gevonden.</p>
<?php endif; ?>