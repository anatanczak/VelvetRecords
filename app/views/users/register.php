<?php require APPROOT . '/views/include/header.php'; ?>
    <div class="container-fluid">
        <?php require APPROOT . '/views/include/navbar.php'; ?>
    </div>
    <div class="container justify-content-center mt-5">
        <h1 class="h2 text-center">Inscription</h1>
        <form action=" <?php echo URLROOT . 'users/register'?>" method="post">

            <!--  ---------------      LAST NAME GROUP ----------------   -->
            <div class="form-group">
                <label for="lastNameInput">Nom <sup class="text-danger">*</sup></label>
                <input type="text" name="lastName" class="form-control <?php
                echo (!empty($data['errors']['lastNameError'])) ? 'is-invalid' :
                    ''; ?>"
                       id="lastNameInput"
                       placeholder="Jones" value="<?php echo $data['lastName'];
                       ?>" required>
                <span class="invalid-feedback"><?php echo $data['errors']['lastNameError']; ?></span>
            </div>
            <!--  ---------------      FIRST NAME GROUP -----------------------  -->
            <div class="form-group">
                <label for="firstNameInput">Prénom <sup class="text-danger">*</sup></label>
                <input type="text" name="firstName" class="form-control <?php
                echo (!empty($data['errors']['firstNameError'])) ? 'is-invalid' : ''; ?>"
                       id="firstNameInput"
                       placeholder="Jessica" value="<?php echo $data['firstName']; ?>"  required>
                <span class="invalid-feedback"><?php echo $data['errors']['firstNameError']; ?></span>
            </div>

            <!--  ---------------      EMAIL GROUP    -------------------   -->
            <div class="form-group">
                <label for="emailInput">Email <sup class="text-danger">*</sup></label>
                <input type="email" name="email" class="form-control <?php
                echo (!empty($data['errors']['emailError'])) ? 'is-invalid' : ''; ?>"
                       id="emailInput"
                       placeholder="jessicajones@example.com" value="<?php
                echo $data['email']; ?>"  required>
                <span class="invalid-feedback"><?php echo $data['errors']['emailError']; ?></span>
            </div>

            <!--  ---------------      PASSWORD GROUP  ----------- -->
            <div class="form-group">
                <label for="passwordInput">Entrer votre mot de passe <sup class="text-danger">*</sup></label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control <?php
                    echo (!empty($data['errors']['passwordError'])) ? 'is-invalid' : ''; ?>"
                           id="passwordInput"
                           placeholder="*****"  required>
                    <div class="input-group-append bg-info rounded-right">
                        <img src=" <?php echo URLROOT .'/images/eye-icon.svg'; ?>"
                             width="20" height="20"
                             class="fluid-image my-auto mx-2" id="eyeIcon" alt="eye icon to
                         toggle
                 password visibility">
                    </div>
                    <span class="invalid-feedback"><?php echo
                        $data['errors']['passwordError']; ?></span>
                </div>
            </div>

            <!--  ---------------      CINFIRM PASSWORD GROUP  ----------- -->
            <div class="form-group">
                <label for="confirmPasswordInput">Confirmer votre mot de passe <sup
                            class="text-danger">*</sup></label>
                <div class="input-group">
                    <input type="password" name="confirmPassword"
                           class="form-control <?php
                           echo (!empty
                           ($data['errors']['confirmPasswordError'])) ? 'is-invalid' : ''; ?>"
                           id="confirmPasswordInput"
                           placeholder="*****"  required>
                    <div class="input-group-append bg-info rounded-right">
                        <img src=" <?php echo URLROOT .'/images/eye-icon.svg'; ?>"
                             width="20" height="20"
                             class="fluid-image my-auto mx-2" id="confirmEyeIcon"
                             alt="eye icon to
                         toggle
                 password visibility">
                    </div>
                    <span class="invalid-feedback"><?php echo
                        $data['errors']['confirmPasswordError']; ?></span>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input"
                       id="exampleCheck1"  required>
                <label class="form-check-label" for="exampleCheck1">J’accepte le traitement de mes données personnelles</label>
            </div>
            <button type="submit" class="btn btn-info btn-block
        mt-2">Submit</button>
        </form>

    </div>

<?php require APPROOT . '/views/include/footer.php'; ?>