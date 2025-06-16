<?php
session_start();
include("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$pageId = 'profile';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['emailAddress'];
    $contact = $_POST['contact'];
    $profile_pic = $_POST['profile_pic'];

    $stmt = $conn->prepare("UPDATE users SET username=?, full_name=?, gender=?, address=?, emailAddress=?, contact=?, profile_pic=? WHERE id=?");
    $stmt->bind_param("sssssssi", $username, $full_name, $gender, $address, $email, $contact, $profile_pic, $user_id);
    $stmt->execute();
    $stmt->close();

    header("Location: profile.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/profile-styles.css">
    <title>Fitna - Profile</title>
</head>
<body>
    <div class="nav">
        <ul>
            <li>
                <a href="home.php" class="<?= ($pageId == 'home') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/home-icon.webp" alt="">
                        <p>Home</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="workouts.php" class="<?= ($pageId == 'workouts') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/workouts-icon.webp" alt="">
                        <p>Workouts</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="plans.php" class="<?= ($pageId == 'plans') ? 'active' : '' ?>" >
                    <div>
                        <img src="assets/images/plans-icon.webp" alt="">
                        <p>Plans</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="history.php" class="<?= ($pageId == 'history') ? 'active' : '' ?>" >
                    <div>
                        <img src="assets/images/history-icon.webp" alt="">
                        <p>History</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="progress.php" class="<?= ($pageId == 'progress') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/progress-icon.webp" alt="">
                        <p>Progress</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="profile.php" class="<?= ($pageId == 'profile') ? 'active' : '' ?>">
                    <div>
                        <img src="assets/images/profile-icon.svg" alt="">
                        <p>Profile</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="content">

        <div class="profile-header">
            <div class="profile-header-bg">
                <img src="assets/images/profile-background.png" alt="Cover Image" />
            </div>
            <div class="profile-header-content">
                <img class="avatar" src="assets/images/default.png" alt=" " />
                <div class="info">
                    <h1 id="main-username">username_123</h1>
                    <p id="main-fullname">Full name</p>
                </div>
                <div class="buttons">
                    <button>Edit profile</button>
                    <button onclick="window.location.href='logout.php'">Logout</button>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="profile-section" id="about">
                <h2>About</h2>
                <p><img src="assets/images/gender.svg"> <span id="main-gender">Male</span></p>
                <p><img src="assets/images/location.svg"><span id="main-address">Cavite, Philippines</span></p>
                <p><img src="assets/images/email.svg"><span id="main-email">naruto123@gmail.com</span></p>
                <p><img src="assets/images/number.svg"><span id="main-contact">0912 345 6789</span></p>
            </div>
            
        </div>
    </div>
    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <h2>Edit Profile</h2>
            <hr>
            <div class="profile-pictures">
            <img src="assets/images/avatar1.jpg" class="profile-pic-option" alt="Profile 1">
            <img src="assets/images/avatar2.jpg" class="profile-pic-option" alt="Profile 2">
            <img src="assets/images/avatar3.jpg" class="profile-pic-option" alt="Profile 3">
            <img src="assets/images/avatar4.jpg" class="profile-pic-option" alt="Profile 4">
            <img src="assets/images/avatar5.jpg" class="profile-pic-option" alt="Profile 5">
            </div>
            <hr>
            <form class="edit-profile-form" method="POST" action="profile.php">
                <input type="hidden" name="profile_pic" id="profile_pic_input" value="<?= htmlspecialchars($user['profile_pic']) ?>">
                <label>Username
                    <input type="text" id="edit-username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                </label>
                <label>Name
                    <input type="text" id="edit-fullname" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                </label>
                <label>Gender
                    <select id="edit-gender" name="gender">
                        <option <?= $user['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                        <option <?= $user['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                        <option <?= $user['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </label>
                <label>Address
                    <input type="text" id="edit-address" name="address" value="<?= htmlspecialchars($user['address']) ?>">
                </label>
                <label>Email Address
                    <input type="email" id="edit-email" name="emailAddress" value="<?= htmlspecialchars($user['emailAddress']) ?>">
                </label>
                <label>Contact
                    <input type="text" id="edit-contact" name="contact" value="<?= htmlspecialchars($user['contact']) ?>">
                </label>
                <button type="submit">Done</button>
            </form>
        </div>
    </div>
    <script>
        // Open modal on "Edit profile" click
        document.querySelector('.buttons button').onclick = function() {
            document.getElementById('editProfileModal').style.display = 'flex';
        };

        // Track selected avatar
        let selectedAvatarSrc = document.querySelector('.avatar').src;
        // Highlight the current avatar in the modal
        document.querySelectorAll('.profile-pic-option').forEach(img => {
            if (img.src === selectedAvatarSrc) {
                img.classList.add('selected');
            }
            img.onclick = function() {
                document.querySelectorAll('.profile-pic-option').forEach(i => i.classList.remove('selected'));
                this.classList.add('selected');
                selectedAvatarSrc = this.src;
                document.getElementById('profile_pic_input').value = this.getAttribute('src');
            }
        });
        
        // Close modal and update avatar on "Done"
        document.getElementById('closeModalBtn').onclick = function() {
            document.getElementById('editProfileModal').style.display = 'none';
            // Update main avatar
            if(selectedAvatarSrc) {
                document.querySelector('.avatar').src = selectedAvatarSrc;
            }
            // Update main profile info
            document.getElementById('main-username').textContent = document.getElementById('edit-username').value;
            document.getElementById('main-fullname').textContent = document.getElementById('edit-fullname').value;
            document.getElementById('main-gender').textContent = document.getElementById('edit-gender').value;
            document.getElementById('main-address').textContent = document.getElementById('edit-address').value;
            document.getElementById('main-email').textContent = document.getElementById('edit-email').value;
            document.getElementById('main-contact').textContent = document.getElementById('edit-contact').value;
        };

        // Close modal when clicking outside modal content
        document.getElementById('editProfileModal').onclick = function(e) {
            if (e.target === this) this.style.display = 'none';
        };

        
    </script>
</body>
</html>

<?php
    mysqli_close($conn);
?>