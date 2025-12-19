<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Add User - PHP MySQL CRUD</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
      min-height: 100vh;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .container {
      max-width: 500px;
      width: 100%;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    
    .header {
      background-color: #2c3e50;
      color: white;
      padding: 30px;
      text-align: center;
    }
    
    .header h1 {
      font-size: 1.8rem;
      font-weight: 300;
    }
    
    .form-container {
      padding: 40px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #333;
      font-size: 0.9rem;
    }
    
    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }
    
    input[type="text"]:focus, input[type="email"]:focus {
      outline: none;
      border-color: #3498db;
    }
    
    .btn-group {
      display: flex;
      gap: 10px;
      margin-top: 25px;
    }
    
    .btn {
      flex: 1;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.3s ease;
      text-decoration: none;
      text-align: center;
      display: inline-block;
    }
    
    .btn-primary {
      background-color: #27ae60;
      color: white;
    }
    
    .btn-primary:hover {
      background-color: #229954;
    }
    
    .btn-secondary {
      background-color: #95a5a6;
      color: white;
    }
    
    .btn-secondary:hover {
      background-color: #7f8c8d;
    }
    
    .success-message {
      background-color: #d4edda;
      color: #155724;
      padding: 12px;
      border-radius: 4px;
      margin-bottom: 20px;
      border-left: 4px solid #28a745;
    }
    
    .error-message {
      background-color: #f8d7da;
      color: #721c24;
      padding: 12px;
      border-radius: 4px;
      margin-bottom: 20px;
      border-left: 4px solid #dc3545;
    }
    
    @media (max-width: 768px) {
      .form-container {
        padding: 30px 20px;
      }
      
      .btn-group {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Add New User</h1>
    </div>
    <div class="form-container">
      <?php
      if (isset($_POST['submit'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        
        if (!empty($name) && !empty($email)) {
          $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
          $stmt->bind_param("ss", $name, $email);
          
          if ($stmt->execute()) {
            echo "<div class='success-message'> User added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 2000);</script>";
          } else {
            echo "<div class='error-message'> Error: " . $conn->error . "</div>";
          }
          $stmt->close();
        } else {
          echo "<div class='error-message'> Please fill in all fields!</div>";
        }
      }
      ?>
      
      <form method="POST">
        <div class="form-group">
          <label for="name">Full Name:</label>
          <input type="text" id="name" name="name" required placeholder="Enter full name">
        </div>
        
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required placeholder="Enter email address">
        </div>
        
        <div class="btn-group">
          <button type="submit" name="submit" class="btn btn-primary">Save User</button>
          <a href="index.php" class="btn btn-secondary">Back to List</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
