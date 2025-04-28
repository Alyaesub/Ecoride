
<?php
//page de code qui gére le moteur de rendue pour les views
//fonction qui gére le moteur de rendu pour les views et donc le routage des views
// Les variables comme $title sont injectées automatiquement via extract($params)
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
