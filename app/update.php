<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  
  if (!empty($name) && !empty($email)) {
    $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    
    if ($stmt->execute()) {
      header("Location: index.php");
      exit();
    } else {
      $error = "Error updating user: " . $conn->error;
    }
    $stmt->close();
  } else {
    $error = "Please fill in all fields!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit User - PHP MySQL CRUD</title>
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
      margin-bottom: 25px;
    }
    
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
      font-size: 0.95rem;
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
      background-color: #3498db;
      color: white;
    }
    
    .btn-primary:hover {
      background-color: #2980b9;
    }
    
    .btn-secondary {
      background-color: #95a5a6;
      color: white;
    }
    
    .btn-secondary:hover {
      background-color: #7f8c8d;
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
      <h1>Edit User</h1>
    </div>
    <div class="form-container">
      <?php if (isset($error)): ?>
        <div class='error-message'><?php echo $error; ?></div>
      <?php endif; ?>
      
      <form method="POST">
        <div class="form-group">
          <label for="name">Full Name:</label>
          <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        </div>
        
        <div class="btn-group">
          <button type="submit" name="update" class="btn btn-primary">Update User</button>
          <a href="index.php" class="btn btn-secondary">Back to List</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
