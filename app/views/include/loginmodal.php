<!-- Modal to login or r -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content form-elegant"
             id="login-popup-content-container">
            <!--Header-->
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Sign in</strong></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p id="login-form-error-message-placeholder" class="text-center
            rounded mx-3 p-2"></p>
            <!--Body-->
            <form class="modal-body mx-4 p-0" id="login-form">
                <!--     EMAIL      -->
                <div class="md-form mb-2">
                    <label id="login-form-label-for-email"
                           for="login-form-email">Votre email</label>
                    <input type="email" id="login-form-email"
                           class="form-control validate">
                </div>
                <!--     PASSWORD      -->
                <div class="md-form pb-3">
                    <label id="login-form-label-for-password"
                           for="login-form-password">Votre mot de
                        passe</label>
                    <input type="password" id="login-form-password" class="form-control validate">
                    <p class="font-small blue-text d-flex
                    justify-content-end">Oublié <a href="#" class="blue-text
                    ml-1">
                            le mot de passe?</a></p>
                </div>

                <!------------------------  submit button -->
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-info
                    btn-block">Se connecter</button>
                </div>

            </form>
            <!--Footer-->
            <div class="modal-footer mx-5 pt-3 mb-1">
                <p class="font-small grey-text d-flex
                justify-content-end">Pas de compte ? <a href=" <?php echo
                        URLROOT . 'users/register'?>" class="blue-text ml-1">
                        S'inscrire</a></p>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

