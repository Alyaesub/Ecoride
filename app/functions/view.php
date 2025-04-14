<!-- page de code qui gére le moteur de rendue pour les views -->
<?php

function render(string $viewPath, array $params = []): void
{
  extract($params);
  ob_start();
  require $viewPath;
  $pageContent = ob_get_clean();

  // Rendre $pageContent accessible dans layout.php
  extract(['pageContent' => $pageContent]);

  require __DIR__ . '/../views/layout.php';
}
