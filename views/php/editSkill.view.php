<form action="/admin/editSkill?id=<?= htmlspecialchars($skill['id']) ?>" method="POST" class="form-container">
    <label for="skill_name">Naam Vaardigheid:</label>
    <input type="text" id="skill_name" name="skill_name" value="<?= htmlspecialchars($skill['skill_name']) ?>" required>

    <button type="submit">Update Skill</button>
</form>