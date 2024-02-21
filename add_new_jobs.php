<?php
$servername = "mysql-server";
$username = "root";
$password = "lritzke";
$database = "washing_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlMenu = "SELECT * FROM menu";
$resultMenu = $conn->query($sqlMenu);

$sqlHamburger = "SELECT * FROM hamburger";
$resultHamburger = $conn->query($sqlHamburger);
?>

<?php
$servername = "mysql-server";
$username = "root";
$password = "lritzke";
$database = "washing_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit_funcionario"])) {
        $nome_completo = $_POST["nome_completo"];
        $data_nascimento = $_POST["data_nascimento"];
        $sexo = $_POST["sexo"];
        $cpf_worker = $_POST["cpf_worker"];

        $edit_informations = isset($_POST["permissions"]) && in_array("edit_informations", $_POST["permissions"]) ? 1 : 0;
        $search_informations = isset($_POST["permissions"]) && in_array("search_informations", $_POST["permissions"]) ? 1 : 0;
        $create_new_jobs = isset($_POST["permissions"]) && in_array("create_new_jobs", $_POST["permissions"]) ? 1 : 0;
        $add_workers = isset($_POST["permissions"]) && in_array("add_workers", $_POST["permissions"]) ? 1 : 0;
        $remove_workers = isset($_POST["permissions"]) && in_array("remove_workers", $_POST["permissions"]) ? 1 : 0;
        $edit_workers = isset($_POST["permissions"]) && in_array("edit_workers", $_POST["permissions"]) ? 1 : 0;

        $verify_cpf = $_POST["cpf_verify"];
        $check_permission_sql = "SELECT add_workers FROM workers WHERE cpf = '$verify_cpf'";
        $result_permission = $conn->query($check_permission_sql);

        if ($result_permission->num_rows > 0) {
            $row = $result_permission->fetch_assoc();
            if ($row["add_workers"] == 1) {
                $stmt = $conn->prepare("INSERT INTO workers (name, birthdate, sex, cpf, edit_informations, search_informations, create_new_jobs, add_workers, remove_workers, edit_workers) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssiiiiii", $nome_completo, $data_nascimento, $sexo, $cpf_worker, $edit_informations, $search_informations, $create_new_jobs, $add_workers, $remove_workers, $edit_workers);

                if ($stmt->execute()) {
                    echo "";
                } else {
                    echo " " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo '<script>alert("Sem permissao.");</script>';
                echo '<script>window.location.href = window.location.href;</script>';
                exit;
            }
        } else {
            echo '<script>alert("Cpf invalido.");</script>';
        }
    } elseif (isset($_POST["submit_trabalho"])) {
        $nome_trabalho = $_POST["nome_trabalho"];
        $cpf_remove_verify = $_POST["cpf_remove_verify"]; // Adicionando esta linha

        $check_permission_sql = "SELECT create_new_jobs FROM workers WHERE cpf = '$cpf_remove_verify'";
        $result_permission = $conn->query($check_permission_sql);

        if ($result_permission->num_rows > 0) {
            $row = $result_permission->fetch_assoc();
            if ($row["create_new_jobs"] == 1) {
                $stmt = $conn->prepare("INSERT INTO jobs (job_name) VALUES (?)");
                $stmt->bind_param("s", $nome_trabalho);

                if ($stmt->execute()) {
                    echo "";
                } else {
                    echo "" . $stmt->error;
                }

                $stmt->close();
            } else {
                echo '<script>alert("sem permicao.");</script>';
                echo '<script>window.location.href = window.location.href;</script>';
                exit;
            }
        } else {
            echo '<script>alert("cpf nao encontrado.");</script>';
        }
    } elseif (isset($_POST["submit-remove-worker"])) {
        $cpf_worker = $_POST["cpf-worker"];
        $cpf_remove_verify = $_POST["cpf_remove_verify"];

        $check_cpf_sql = "SELECT * FROM workers WHERE cpf = '$cpf_worker'";
        $result_check_cpf = $conn->query($check_cpf_sql);

        if ($result_check_cpf->num_rows > 0) {
            $check_permission_sql = "SELECT remove_workers FROM workers WHERE cpf = '$cpf_remove_verify'";
            $result_permission = $conn->query($check_permission_sql);

            if ($result_permission->num_rows > 0) {
                $row = $result_permission->fetch_assoc();
                if ($row["remove_workers"] == 1) {
                    $remove_worker_sql = "DELETE FROM workers WHERE cpf = '$cpf_worker'";

                    if ($conn->query($remove_worker_sql) === TRUE) {
                        echo "";
                    } else {
                        echo "" . $conn->error;
                    }
                } else {
                    echo '<script>alert("sem permicao.");</script>';
                }
            } else {
                echo '<script>alert("cpf invalido.");</script>';
            }
        } else {
            echo '<script>alert("cpf invalido.");</script>';
        }
    } elseif (isset($_POST["remove_trabalho"])) {
        // Código para remover um trabalho (adicione aqui o código fornecido)
        $nome_trabalho = $_POST["nome_trabalho"];
        $cpf_remove_verify = $_POST["cpf_remove_verify"];

        $check_permission_sql = "SELECT create_new_jobs FROM workers WHERE cpf = '$cpf_remove_verify'";
        $result_permission = $conn->query($check_permission_sql);

        if ($result_permission->num_rows > 0) {
            $row = $result_permission->fetch_assoc();
            if ($row["remove_workers"] == 1) {
                $delete_job_sql = "DELETE FROM jobs WHERE job_name='$nome_trabalho'";

                if ($conn->query($delete_job_sql) === TRUE) {
                    echo "Job removed successfully";
                    // Refresh the page to reflect the changes
                    echo '<script>window.location.href = window.location.href;</script>';
                    exit;
                } else {
                    echo "Error removing job: " . $conn->error;
                }
            } else {
                echo '<script>alert("Sem permissão para remover trabalho.");</script>';
            }
        } else {
            echo '<script>alert("CPF não encontrado.");</script>';
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Washing</title>
    <link rel="stylesheet" href="style.css">
    <style>
.dark-mode button.tab {
  background-color: #aeaeae;
  color: #000 !important;
}

button.tab {
  background-color: ##595959;
  color: #fff;
  border: none;
  cursor: pointer;
}

        #content {
            background-color: #f0f0f0;
            color: #fff;
        }

        .dark-mode #content {
            background-color: #f0f0f0;
            color: #000;
        }

        .form-section {
            display: none;
        }
    </style>
</head>

<body>
    <div id="background-paragraph"></div>
<section id="menu">
    <header>
	<button id="toggleButton" onclick="toggleDarkMode()" style="margin-left: 1218px; font-size: 25px;">
<svg  style="width: 22px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M375.7 19.7c-1.5-8-6.9-14.7-14.4-17.8s-16.1-2.2-22.8 2.4L256 61.1 173.5 4.2c-6.7-4.6-15.3-5.5-22.8-2.4s-12.9 9.8-14.4 17.8l-18.1 98.5L19.7 136.3c-8 1.5-14.7 6.9-17.8 14.4s-2.2 16.1 2.4 22.8L61.1 256 4.2 338.5c-4.6 6.7-5.5 15.3-2.4 22.8s9.8 13 17.8 14.4l98.5 18.1 18.1 98.5c1.5 8 6.9 14.7 14.4 17.8s16.1 2.2 22.8-2.4L256 450.9l82.5 56.9c6.7 4.6 15.3 5.5 22.8 2.4s12.9-9.8 14.4-17.8l18.1-98.5 98.5-18.1c8-1.5 14.7-6.9 17.8-14.4s2.2-16.1-2.4-22.8L450.9 256l56.9-82.5c4.6-6.7 5.5-15.3 2.4-22.8s-9.8-12.9-17.8-14.4l-98.5-18.1L375.7 19.7zM269.6 110l65.6-45.2 14.4 78.3c1.8 9.8 9.5 17.5 19.3 19.3l78.3 14.4L402 242.4c-5.7 8.2-5.7 19 0 27.2l45.2 65.6-78.3 14.4c-9.8 1.8-17.5 9.5-19.3 19.3l-14.4 78.3L269.6 402c-8.2-5.7-19-5.7-27.2 0l-65.6 45.2-14.4-78.3c-1.8-9.8-9.5-17.5-19.3-19.3L64.8 335.2 110 269.6c5.7-8.2 5.7-19 0-27.2L64.8 176.8l78.3-14.4c9.8-1.8 17.5-9.5 19.3-19.3l14.4-78.3L242.4 110c8.2 5.7 19 5.7 27.2 0zM256 368a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM192 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/></svg>
</button>
        <div style="margin-top: -70px;">
            <h1>Bennin-Motorcycles Washing</h1>
            <nav>
                <ul>
                    <?php
                    if ($resultMenu->num_rows > 0) {
                        while ($rowMenu = $resultMenu->fetch_assoc()) {
                            echo '<li><a href="' . $rowMenu["file_name"] . '">' . $rowMenu["display_name"] . '</a></li>';
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </ul>
            </nav>
        </div>
<div id="hamburger" class="hamburger" style="position: absolute; top: 10px; right: 1162px;width: 171px;text-align: left;border-radius: 10px;" >
    <div style="border-radius: 8px;" >
	<button id="hamburgerButton" onclick="toggleHamburgerMenu()"  style="margin-top: 15px;font-size: 34px; border-radius: 10px;"    >
<svg id="hamburgerIcon" style="width: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
</button>
        <ul id="hamburgerMenu" style="display: none;">
            <?php
            if ($resultHamburger->num_rows > 0) {
                while ($rowHamburger = $resultHamburger->fetch_assoc()) {
                    echo '<li><a href="' . $rowHamburger["file_name"] . '">' . $rowHamburger["display_name"] . '</a></li>';
                }
            }
            ?>
        </ul>
    </div>
</div>
    </header>
</section>
    <div id="content" style="width: 613px;padding: 3px;border-radius: 15px;margin-left: 372px;margin-top: 115px;">
        <main>
            <section>
                <center>
                    <h2>Choose an option</h2>
                    <button onclick="showForm('addWorkerForm')" class="tab" style="width: 19pc;padding: 18px;border-radius: 15px;font-size: 19px;"  >Add Employe</button>
                    <button onclick="showForm('addJobForm')"  class="tab" style="width: 19pc;padding: 18px;border-radius: 15px;font-size: 19px;"  >New Job Post</button>
                    <button onclick="showForm('removeworker')"  class="tab" style="width: 19pc;padding: 18px;border-radius: 15px;font-size: 19px;"  >Remove Employe</button>
                    <button onclick="showForm('removeJob')"  class="tab" style="width: 19pc;padding: 18px;border-radius: 15px;font-size: 19px;"  >Remove Job Post</button>

                    <div class="form-section" id="addWorkerForm">
                        <h2>New Employe</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <label for="nome_completo">Full name:</label>
                            <input type="text" name="nome_completo" required><br>

                            <label for="data_nascimento">Date of birth:</label>
                            <input type="date" name="data_nascimento" required><br>

                            <label for="sexo">Sex:</label>
                            <select name="sexo" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select><br>

                            <label for="cpf">CPF:</label>
                            <input type="text" name="cpf_worker" required><br>

                            <h2>Permissions</h2>
                            <div style="text-align: left;margin-left: 52px;padding: 22px;">
                                <div>
                                    <input type="checkbox" id="edit_informations" name="permissions[]" value="edit_informations">
                                    <label for="edit_informations">Edit informations</label>
                                </div>

                                <div>
                                    <input type="checkbox" id="search_informations" name="permissions[]" value="search_informations">
                                    <label for="search_informations">Search informations</label>
                                </div>

                                <div>
                                    <input type="checkbox" id="create_new_jobs" name="permissions[]" value="create_new_jobs">
                                    <label for="create_new_jobs">Create new jobs</label>
                                </div>

                                <div>
                                    <input type="checkbox" id="add_workers" name="permissions[]" value="add_workers">
                                    <label for="add_workers">Add workers</label>
                                </div>

                                <div>
                                    <input type="checkbox" id="remove_workers" name="permissions[]" value="remove_workers">
                                    <label for="remove_workers">Remove workers</label>
                                </div>

                                <div>
                                    <input type="checkbox" id="edit_workers" name="permissions[]" value="edit_workers">
                                    <label for="edit_workers">Edit workers</label>
                                </div>

                            </div>
                            <input type="hidden" name="cpf_verify" id="cpf_verify" value="">
                            <input type="submit" name="submit_funcionario" value="Save" onclick="verifyPermission()">
                        </form>
                    </div>

                    <div class="form-section" id="addJobForm">
                        <h2>New Job Post</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <label for="nome_trabalho">Job name:</label>
                            <input type="text" name="nome_trabalho" required><br>
			    <input type="hidden" name="cpf_remove_verify" id="cpf_remove_verify" value="">
			    <input type="submit" name="submit_trabalho" value="Save" onclick="verifyJobPermission()">
                        </form>

                    </div>

                    <div class="form-section" id="removeworker">
                        <h2>Remove Employe</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <label for="cpf-worker">What is the cpf of worker</label>
			    <input type="text" name="cpf-worker" required><br>
		       	    <input type="hidden" name="cpf_remove_verify" id="cpf_remove_verify" value="">
			    <input type="submit" name="submit-remove-worker" value="Remove" onclick="verifyRemovePermission()">
                        </form>
                    </div>
		    <div class="form-section" id="removeJob">
                        <h2>Remove Job Post</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <label for="nome_trabalho">Which job do you want to remove</label>
                            <select id="jobType" class="nome_trabalho" name="nome_trabalho" style="border-radius: 11px;padding: 8px;">
                                <?php
                                $servername = "mysql-server";
                                $username = "root";
                                $password = "lritzke";
                                $database = "washing_project";

                                $conn = new mysqli($servername, $username, $password, $database);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT job_name FROM jobs";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $jobName = $row['job_name'];
                                        echo "<option value='$jobName'>$jobName</option>";
                                    }
                                } else {
                                    echo "<option value=''>No service types found</option>";
                                }

                                $conn->close();
                                ?>
                                </select>
                            <input type="hidden" name="cpf_remove_verify" id="cpf_remove_verify" value="">
                            <input type="submit" name="remove_trabalho" value="Remove" onclick="verifyJobPermission()" style="margin-top: 21px;border-radius: 9px;" >
                        </form>
                    </div>

                </center>
            </section>
        </main>
    </div>

    <script>
    function toggleHamburgerMenu() {
        const hamburgerMenu = document.getElementById('hamburgerMenu');
        hamburgerMenu.style.display = (hamburgerMenu.style.display === 'none' || hamburgerMenu.style.display === '') ? 'block' : 'none';
    }
        function toggleDarkMode() {
            const body = document.body;
            const menu = document.getElementById('menu');
            const paragraphs = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, a');
            const toggleButton = document.getElementById('toggleButton');

            body.classList.toggle('dark-mode');
            menu.classList.toggle('dark-mode');

            paragraphs.forEach((element) => {
                element.classList.toggle('dark-mode');
            });
      toggleButton.innerHTML = body.classList.contains('dark-mode') ? '<svg style="width: 22px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#000000" d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/></svg>' : '<svg style="width: 22px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M375.7 19.7c-1.5-8-6.9-14.7-14.4-17.8s-16.1-2.2-22.8 2.4L256 61.1 173.5 4.2c-6.7-4.6-15.3-5.5-22.8-2.4s-12.9 9.8-14.4 17.8l-18.1 98.5L19.7 136.3c-8 1.5-14.7 6.9-17.8 14.4s-2.2 16.1 2.4 22.8L61.1 256 4.2 338.5c-4.6 6.7-5.5 15.3-2.4 22.8s9.8 13 17.8 14.4l98.5 18.1 18.1 98.5c1.5 8 6.9 14.7 14.4 17.8s16.1 2.2 22.8-2.4L256 450.9l82.5 56.9c6.7 4.6 15.3 5.5 22.8 2.4s12.9-9.8 14.4-17.8l18.1-98.5 98.5-18.1c8-1.5 14.7-6.9 17.8-14.4s2.2-16.1-2.4-22.8L450.9 256l56.9-82.5c4.6-6.7 5.5-15.3 2.4-22.8s-9.8-12.9-17.8-14.4l-98.5-18.1L375.7 19.7zM269.6 110l65.6-45.2 14.4 78.3c1.8 9.8 9.5 17.5 19.3 19.3l78.3 14.4L402 242.4c-5.7 8.2-5.7 19 0 27.2l45.2 65.6-78.3 14.4c-9.8 1.8-17.5 9.5-19.3 19.3l-14.4 78.3L269.6 402c-8.2-5.7-19-5.7-27.2 0l-65.6 45.2-14.4-78.3c-1.8-9.8-9.5-17.5-19.3-19.3L64.8 335.2 110 269.6c5.7-8.2 5.7-19 0-27.2L64.8 176.8l78.3-14.4c9.8-1.8 17.5-9.5 19.3-19.3l14.4-78.3L242.4 110c8.2 5.7 19 5.7 27.2 0zM256 368a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM192 256a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/></svg>';

	          hamburgerIcon.innerHTML = body.classList.contains('dark-mode') ? '<svg style="width: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>' : '<svg style="width: 25px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>';
        }

        function showForm(formId) {
            const formSections = document.querySelectorAll('.form-section');
            formSections.forEach((section) => {
                section.style.display = 'none';
            });

            const selectedForm = document.getElementById(formId);
            if (selectedForm) {
                selectedForm.style.display = 'block';
            }
        }

        function verifyPermission() {
            const cpf_verify = prompt("Digite seu CPF:");

            document.getElementById("cpf_verify").value = cpf_verify;
        }
function verifyRemovePermission() {
    const cpf_remove_verify = prompt("Digite seu cpf:");

    document.getElementById("cpf_remove_verify").value = cpf_remove_verify;
}
function verifyJobPermission() {
    const cpf_remove_verify = prompt("Digite seu cpf:");

    document.getElementById("cpf_remove_verify").value = cpf_remove_verify;
}

    </script>
</body>

</html>
