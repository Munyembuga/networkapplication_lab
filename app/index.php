<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP MySQL CRUD</title>
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
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
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
      font-size: 2.2rem;
      margin-bottom: 10px;
      font-weight: 300;
    }
    
    .header p {
      font-size: 1rem;
      opacity: 0.9;
      font-weight: 300;
    }
    
    .content {
      padding: 30px;
    }
    
    .add-btn {
      display: inline-block;
      background-color: #27ae60;
      color: white;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 4px;
      margin-bottom: 25px;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }
    
    .add-btn:hover {
      background-color: #229954;
    }
    
    .table-container {
      overflow-x: auto;
      border-radius: 4px;
      border: 1px solid #ddd;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }
    
    th {
      background-color: #34495e;
      color: white;
      padding: 12px 15px;
      text-align: left;
      font-weight: 500;
      font-size: 0.9rem;
    }
    
    td {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
    }
    
    tr:hover td {
      background-color: #f8f9fa;
    }
    
    tr:last-child td {
      border-bottom: none;
    }
    
    .action-links {
      display: flex;
      gap: 8px;
    }
    
    .action-links a {
      padding: 6px 12px;
      text-decoration: none;
      border-radius: 3px;
      font-size: 0.85rem;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }
    
    .edit-btn {
      background-color: #3498db;
      color: white;
    }
    
    .edit-btn:hover {
      background-color: #2980b9;
    }
    
    .delete-btn {
      background-color: #e74c3c;
      color: white;
    }
    
    .delete-btn:hover {
      background-color: #c0392b;
    }
    
    .empty-state {
      text-align: center;
      padding: 50px;
      color: #666;
    }
    
    .empty-state h3 {
      margin-bottom: 10px;
      color: #999;
    }
    
    @media (max-width: 768px) {
      .header h1 {
        font-size: 2rem;
      }
      
      .content {
        padding: 20px;
      }
      
      th, td {
        padding: 10px 8px;
        font-size: 0.9rem;
      }
      
      .action-links {
        flex-direction: column;
        gap: 5px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>User Management System</h1>
      <p>Manage your users with ease</p>
    </div>
    <div class="content">
      <?php if (isset($_GET['deleted']) && $_GET['deleted'] == '1'): ?>
        <div style="background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #28a745; font-weight: 500;">
          User deleted successfully!
        </div>
      <?php endif; ?>
      
      <a href="create.php" class="add-btn">Add New User</a>
      
      <div class="table-container">
        <table>
          <tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
          <?php
          $result = $conn->query("SELECT * FROM users");
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td class='action-links'>
                  <a href='update.php?id={$row['id']}' class='edit-btn'>Edit</a>
                  <a href='delete.php?id={$row['id']}' class='delete-btn'>Delete</a>
                </td>
              </tr>";
            }
          } else {
            echo "<tr><td colspan='4' class='empty-state'>
              <h3>No users found</h3>
              <p>Click 'Add New User' to get started!</p>
            </td></tr>";
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
