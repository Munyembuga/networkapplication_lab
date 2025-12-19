<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get user details first for confirmation
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
    
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            header("Location: index.php?deleted=1");
            exit();
        } else {
            $error = "Error deleting user: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete User - PHP MySQL CRUD</title>
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
      background-color: #e74c3c;
      color: white;
      padding: 30px;
      text-align: center;
    }
    
    .header h1 {
      font-size: 1.8rem;
      font-weight: 300;
    }
    
    .content {
      padding: 40px;
      text-align: center;
    }
    
    .user-info {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      margin: 20px 0;
      border-left: 4px solid #e74c3c;
    }
    
    .user-info h3 {
      color: #333;
      margin-bottom: 10px;
    }
    
    .user-detail {
      color: #666;
      margin: 5px 0;
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
    
    .btn-danger {
      background-color: #e74c3c;
      color: white;
    }
    
    .btn-danger:hover {
      background-color: #c0392b;
    }
    
    .btn-secondary {
      background-color: #95a5a6;
      color: white;
    }
    
    .btn-secondary:hover {
      background-color: #7f8c8d;
    }
    
    .warning-text {
      color: #721c24;
      font-weight: 500;
      margin: 20px 0;
      line-height: 1.5;
    }
    
    @media (max-width: 768px) {
      .content {
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
      <h1>Delete User</h1>
    </div>
    <div class="content">
      <?php if (isset($user)): ?>
        <h2>Are you sure?</h2>
        <p class="warning-text">This action cannot be undone. The user will be permanently deleted from the database.</p>
        
        <div class="user-info">
          <h3>User Details:</h3>
          <!-- <div class="user-detail"><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></div> -->
          <div class="user-detail"><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></div>
          <div class="user-detail"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></div>
        </div>
        
        <div class="btn-group">
          <a href="delete.php?id=<?php echo $user['id']; ?>&confirm=yes" class="btn btn-danger">Yes, Delete</a>
          <a href="index.php" class="btn btn-secondary">Cancel</a>
        </div>
      <?php else: ?>
        <h2>User not found</h2>
        <p class="warning-text">The user you're trying to delete does not exist.</p>
        <a href="index.php" class="btn btn-secondary">Back to List</a>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
