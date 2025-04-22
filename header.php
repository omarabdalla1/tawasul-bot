<?php session_start(); ?>
<div style="background:#eee; padding:10px; font-family:Cairo;">
  <a href="index.php">الرئيسية</a> |
  <a href="products.php">المنتجات</a> |
  <?php if (isset($_SESSION['access_token'])): ?>
    <a href="logout.php">تسجيل الخروج</a>
  <?php else: ?>
    <a href="login.php">تسجيل الدخول</a>
  <?php endif; ?>
</div>