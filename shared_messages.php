<?php if (!empty($_SESSION["success"])): ?>
    <p class="message success"><?php echo htmlspecialchars($_SESSION["success"]); ?></p>
    <?php unset($_SESSION["success"]); ?>
<?php endif; ?>

<?php if (!empty($_SESSION["error"])): ?>
    <p class="message error"><?php echo htmlspecialchars($_SESSION["error"]); ?></p>
    <?php unset($_SESSION["error"]); ?>
<?php endif; ?>
