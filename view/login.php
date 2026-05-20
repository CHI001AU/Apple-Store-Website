<?php require 'header.php'; ?>

<div class="container main-content">
    <h1 class="page-title">Login</h1>

    <?php if (!empty($errors['login'])): ?>
        <div class="alert alert-error">
            <p><?= htmlspecialchars($errors['login']) ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=login&action=process" class="user-form">
        <fieldset class="form-section">
            <legend class="section-title">Enter Credentials</legend>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" 
                       value="<?= htmlspecialchars($formData['username'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
        </fieldset>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>