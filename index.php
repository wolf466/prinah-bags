<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Handbag Shop</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #fff8f0;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #ff69b4;
      padding: 10px 20px;
      flex-wrap: wrap;
    }
    .nav-left {
      display: flex;
      align-items: center;
    }
    .nav-logo {
      width: 40px;
      margin-right: 10px;
    }
    .company-name {
      font-size: 1.5em;
      color: white;
      font-weight: bold;
    }
    .nav-right {
      display: flex;
      gap: 15px;
    }
    .nav-right a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    .hamburger {
      display: none;
      font-size: 24px;
      color: white;
      cursor: pointer;
    }
    .banner marquee {
      background-color: #ffb6c1;
      color: #333;
      padding: 10px;
      font-weight: bold;
    }
    .director-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      flex-wrap: wrap;
    }
    .director-info {
      flex: 1;
      padding: 20px;
    }
    .director-img-container {
      flex: 1;
      text-align: right;
    }
    .director-img {
      width: 250px;
      height: auto;
      border-radius: 50%;
      border: 5px solid #ff69b4;
      animation: twinkle 2s infinite alternate;
    }
    @keyframes twinkle {
      0% { border-color: #ff69b4; }
      100% { border-color: #ffe600; }
    }
    .bag-list {
  display: grid;
  grid-template-columns: repeat(2, 2fr);
  gap: 30px;
  padding: 20px;
  justify-content: center;
}

.bag {
  background-color: #fff0f5;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 6px 14px rgba(0,0,0,0.1);
  text-align: center;
  transition: transform 0.3s ease;
  width: 100%;
  height: auto;
}

.bag:hover {
  transform: scale(1.05);
}

.bag img {
  width: 100%;
  height: auto;
  object-fit: cover;
  border-radius: 10px;
}

/* Responsive: On screens less than 768px, show only one column */
@media (max-width: 768px) {
  .bag-list {
    grid-template-columns: 1fr;
  }

  .bag {
    width: 100%;
  }
}

    footer {
      background-color: #ff69b4;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 30px;
    }
    @media (min-width: 768px) {
      .bag-list {
        width: 100%;
        grid-template-columns: repeat(2, 1fr);
      }
      .director-section {
        flex-direction: row;
      }
     
    }
    @media (max-width: 768px) {
      .nav-right {
        display: none;
        flex-direction: column;
        width: 100%;
        background-color: #ff69b4;
      }
      .nav-right.show {
        display: flex;
      }
      .hamburger {
        display: block;
      }
      .director-section {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      .director-img-container {
        text-align: center;
        margin-bottom: 15px;
      }
    }
  </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar">
  <div class="nav-left">
    <img src="image.png" alt="Logo" class="nav-logo">
    <span class="company-name">Elegant Handbags</span>
  </div>
  <div class="hamburger" onclick="toggleMenu()">
    <i class="fas fa-bars"></i>
  </div>
  <div class="nav-right" id="navLinks">
    <a href="#home">Home</a>
    <a href="#products">Products</a>
    <a href="#director">Director</a>
    <a href="#contact">Contact</a>
  </div>
</nav>

<!-- Sliding Banner -->
<div class="banner">
  <marquee behavior="scroll" direction="left" scrollamount="5">Welcome to Elegant Handbags under Prinah – Quality and Style in Every Stitch!</marquee>
</div>

<!-- Director Profile Section -->
<section id="director" class="director-section">
  <div class="director-img-container">
    <img src="pili.GIF" alt="Director Image" class="director-img">
  </div>
  <div class="director-info">
    <h2>Meet Our Director</h2>
    <p><strong>Prinah</strong> — Founder & Creative Director</p>
    <p>With vision and passion, Prinah crafts more than bags—she crafts confidence, elegance, and timeless beauty.</p>
  </div>
</section>

<!-- Product Section -->
<h2 id="products" style="text-align:center;">Available Handbags</h2>
<div class="bag-list">
<?php
$result = $conn->query("SELECT * FROM handbags");
while ($row = $result->fetch_assoc()) {
  echo "<div class='bag'>
    <img src='uploads/{$row['image']}' alt='Bag Image'>
    <strong>{$row['name']}</strong>
    <p>$ {$row['price']}</p>
    <p>{$row['description']}</p>
    <button onclick='orderBag({$row['id']})'>Order</button>
  </div>";
}
?>
</div>

<!-- Footer -->
<footer id="contact">
  <p>&copy; 2025 Elegant Handbags | Contact: info@eleganthandbags.com | Phone: +123 456 7890</p>
</footer>

<script>
function toggleMenu() {
  document.getElementById('navLinks').classList.toggle('show');
}

function orderBag(id) {
  const name = prompt("Enter your name:");
  const contact = prompt("Enter your contact:");
  if (name && contact) {
    fetch('order.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `bag_id=${id}&name=${name}&contact=${contact}`
    })
    .then(res => res.text())
    .then(data => alert(data));
  }
}
</script>

</body>
</html>
