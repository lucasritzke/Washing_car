<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Motorcycle Washing</title>
  <link rel="stylesheet" href="style.css">
</head>

<style>
    #content {
        /* Estilos para o modo claro (default) */
        background-color: #f0f0f0;
        color: #000;
    }

    .dark-mode #content {
        /* Estilos para o modo escuro */
        background-color: #555;
        color: #fff;
    }
</style>

<body>
  <div id="background-paragraph"></div>
  <section id="menu">
    <header>
      <h1>Bennin-Motorcycles Washing</h1>
      <nav>
        <ul>
          <?php
          $servername = "mysql-server";
          $username = "root";
          $password = "lritzke";
          $database = "washing_project";

          $conn = new mysqli($servername, $username, $password, $database);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM menu";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<li><a href="' . $row["file_name"] . '">' . $row["display_name"] . '</a></li>';
              }
          } else {
              echo "0 results";
          }

          $conn->close();
          ?>
        </ul>
      </nav>
    </header>
  </section>
  <button id="toggleButton" onclick="toggleDarkMode()" style="margin-left: 1221px;">Toggle White Mode</button>
<div id="content" style="width: 935px;padding: 3px;border-radius: 15px;"  >
  <main>
    <section>
      <h2>Welcome to our Car Wash!</h2>
      <p>We offer a wide range of car wash services, ensuring maximum quality in every detail.</p>
    </section>
    <section id="about-us">
      <h2>About Us</h2>
      <p>We are a car enthusiast company specializing in car wash services since 2010. Our commitment is to provide our customers with the best care for their vehicles, with exceptional service.</p>
      <p>Phone: (11) 1234-5678</p>
      <p>Address: Fictional Street, 123 - Fictional City</p>
    </section>
  </main>
</div>

  <script>
    function toggleDarkMode() {
      const body = document.body;
      const menu = document.getElementById('menu');
      const div = document.getElementById('div');
      const paragraphs = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, a');
      const toggleButton = document.getElementById('toggleButton');

      body.classList.toggle('dark-mode');
      menu.classList.toggle('dark-mode');

      paragraphs.forEach((element) => {
        element.classList.toggle('dark-mode');
      });

      // Dynamically change button text
      toggleButton.innerText = body.classList.contains('dark-mode') ? 'Toggle Dark Mode' : 'Toggle Light Mode';
    }
  </script>
</body>

</html>
