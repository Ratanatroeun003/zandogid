<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <style>
    /* Reset default margin/padding */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      color: white;
      text-align: center;
    }

    .welcome-container {
      background: rgba(0, 0, 0, 0.4);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      animation: fadeIn 1.5s ease;
    }

    h1 {
      font-size: 3rem;
      margin-bottom: 15px;
    }

    p {
      font-size: 1.2rem;
      margin-bottom: 20px;
    }

    a {
      display: inline-block;
      padding: 12px 25px;
      font-size: 1rem;
      font-weight: bold;
      text-decoration: none;
      background: #fff;
      color: #4facfe;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    a:hover {
      background: #4facfe;
      color: white;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-50px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="welcome-container">
    <h1>Welcome!</h1>
    <p>Thanks for visiting my website.</p>
    <a href="code/main.php">Enter Site</a>
  </div>
</body>
</html>
