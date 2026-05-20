<?php
require 'header.php';


$isLoggedIn = $user instanceof User;
?>

<div class="container main-content">

    <h1 class="page-title">
        <?= $isLoggedIn ? 'My Account' : 'Register' ?>
    </h1>

    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-error">
            <p><?= htmlspecialchars($errors['general']) ?></p>
        </div>
    <?php endif; ?>

    <!-- ================= REGISTER ================= -->
    <?php if (!$isLoggedIn): ?>
    <form method="POST" action="index.php?page=registration&action=process" class="user-form">

        <fieldset class="form-section">
            <legend class="section-title">Create Account</legend>

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text"
                       name="username"
                       id="username"
                       value="<?= htmlspecialchars($formData['username'] ?? '') ?>"
                       required>

                <?php if (!empty($errors['username'])): ?>
                    <p class="form-error"><?= htmlspecialchars($errors['username']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password"
                       name="password"
                       id="password"
                       required>

                <?php if (!empty($errors['password'])): ?>
                    <p class="form-error"><?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>

            <!-- First Name -->
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text"
                       name="firstName"
                       id="firstName"
                       value="<?= htmlspecialchars($formData['firstName'] ?? '') ?>"
                       required>

                <?php if (!empty($errors['firstName'])): ?>
                    <p class="form-error"><?= htmlspecialchars($errors['firstName']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text"
                       name="lastName"
                       id="lastName"
                       value="<?= htmlspecialchars($formData['lastName'] ?? '') ?>"
                       required>

                <?php if (!empty($errors['lastName'])): ?>
                    <p class="form-error"><?= htmlspecialchars($errors['lastName']) ?></p>
                <?php endif; ?>
            </div>


            <!-- Street -->
            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text"
                    name="street"
                    id="street"
                    value="<?= htmlspecialchars($formData['street'] ?? '') ?>"
                    required>
            </div>

            <!-- Town -->
            <div class="form-group">
                <label for="town">Town:</label>
                <input type="text"
                    name="town"
                    id="town"
                    value="<?= htmlspecialchars($formData['town'] ?? '') ?>"
                    required>
            </div>

            <!-- State -->
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text"
                    name="state"
                    id="state"
                    value="<?= htmlspecialchars($formData['state'] ?? '') ?>"
                    required>
            </div>

            <!-- Postcode -->
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text"
                    name="postcode"
                    id="postcode"
                    value="<?= htmlspecialchars($formData['postcode'] ?? '') ?>"
                    required>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" name="phone" id="phone" value="<?=
                htmlspecialchars($formData['phone'] ?? ($user ? $user->getPhone
                () : '')) ?>" placeholder="04xx xxx xxx or (0x) xxxx xxxx"
                pattern="^(\+61|0)[2-478](?:[ -]?[0-9]){8}$" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email"
                    name="email"
                    id="email"
                    value="<?= htmlspecialchars($formData['email'] ?? '') ?>"
                    required>
            </div>

        </fieldset>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>

    </form>
    <?php endif; ?>



    <!-- ================= ACCOUNT ================= -->
    <?php if ($isLoggedIn): ?>

        <hr>

        

        <form method="POST" action="index.php?page=registration&action=update" class="user-form">

            <fieldset class="form-section">
                <legend class="section-title">Edit Details</legend>

                <!-- Username -->
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text"
                           name="username"
                           value="<?= htmlspecialchars($user->getUsername()) ?>">  
                           
                </div>

                <!-- First Name -->
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text"
                           name="firstName"
                           value="<?= htmlspecialchars($user->getFirstName()) ?>"
                           required>
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text"
                           name="lastName"
                           value="<?= htmlspecialchars($user->getLastName()) ?>"
                           required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>New Password:</label>
                    <input type="password" name="password">
                    <small>Leave blank to keep current password</small>
                </div>

                <!-- Street -->
                <div class="form-group">
                    <label>Street:</label>
                    <input type="text" name="street"
                        value="<?= htmlspecialchars($user->getStreet()) ?>">
                </div>

                <!-- Town -->
                <div class="form-group">
                    <label>Town:</label>
                    <input type="text" name="town"
                        value="<?= htmlspecialchars($user->getTown()) ?>">
                </div>

                <!-- State -->
                <div class="form-group">
                    <label>State:</label>
                    <input type="text" name="state"
                        value="<?= htmlspecialchars($user->getState()) ?>">
                </div>

                <!-- Postcode -->
                <div class="form-group">
                    <label>Postcode:</label>
                    <input type="text" name="postcode"
                        value="<?= htmlspecialchars($user->getPostcode()) ?>">
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone"
                        value="<?= htmlspecialchars($user->getPhone()) ?>">
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email"
                        value="<?= htmlspecialchars($user->getEmail()) ?>">
                </div>

            </fieldset>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Details</button>
            </div>
        </form>

        <!-- Delete -->
        <form method="POST" action="index.php?page=registration&action=delete"
              onsubmit="return confirm('Are you sure you want to delete your account?');">
            <button class="btn btn-danger">Delete Account</button>
        </form>

    <?php endif; ?>

</div>

<?php require 'footer.php'; ?>