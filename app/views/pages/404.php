<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f7f7f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .error-container {
    text-align: center;
    max-width: 600px;
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.8s ease-in-out;
  }

  .error-container h1 {
    font-size: 6rem;
    margin: 0;
    color: #ff4e4e;
  }

  .error-container h2 {
    margin-top: 10px;
    font-size: 1.8rem;
    color: #333;
  }

  .error-container p {
    margin: 20px 0;
    font-size: 1.1rem;
    color: #666;
  }

  .error-container a {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    font-size: 1rem;
    text-decoration: none;
    background: #28a745;
    color: white;
    border-radius: 8px;
    transition: background 0.3s ease;
  }

  .error-container a:hover {
    background: #218838;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
<div class="error-container">
  <h1>404</h1>
  <h2>Oups ! Page introuvable</h2>
  <p>La page que tu cherches n’existe pas ou a été déplacée. 😢</p>
  <a href="<?= route('home') ?>">Retour à l'accueil</a>
</div>