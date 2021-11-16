<div hidden id="hidden_register">
    <div class="modal-body mx-3 border-0">
        <div class="md-form mb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label for="defaultForm-firstName" data-error="wrong" data-success="right">Meno:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="defaultForm-firstName" class="form-control validate">
                    </div>
                </div>
            </div>
        </div>

        <div class="md-form mb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label for="defaultForm-lastName" data-error="wrong" data-success="right">Priezvisko:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="defaultForm-lastName" class="form-control validate">
                    </div>
                </div>
            </div>
        </div>

        <div class="md-form mb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label data-error="wrong" data-success="right" for="defaultForm-email">Vaša e-mailová adresa:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="email" id="defaultForm-email" class="form-control validate">
                    </div>
                </div>
            </div>
        </div>
        <div class="md-form mb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label data-error="wrong" data-success="right" for="defaultForm-password">Heslo (aspoň 8 znakov):</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" id="defaultForm-password" class="form-control validate">
                    </div>
                </div>
            </div>
        </div>

        <div class="md-form mb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label data-error="wrong" data-success="right" for="defaultForm-confirmPassword">Potvrdenie hesla:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="password" id="defaultForm-confirmPassword" class="form-control validate">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center border-0">
        <input type="checkbox" id="personal_checkbox">
        <label for="personal_checkbox">Súhlasím so spracovaním údajov</label>
        <button class="btn btn-outline-secondary">Registrovať</button>
    </div>
</div>
<div hidden id="hidden_login">
    <div class="modal-body mx-3 border-0">
        <div class="md-form mb-5">
            <label data-error="wrong" data-success="right" for="defaultForm-loginEmail">Emailová adresa:</label>
            <input type="email" id="defaultForm-loginEmail" class="form-control validate">
        </div>

        <div class="md-form mb-4">
            <label data-error="wrong" data-success="right" for="defaultForm-loginPassword">Heslo:</label>
            <input type="password" id="defaultForm-loginPassword" class="form-control validate">
        </div>

        <a href="">Zabudli ste heslo?</a>
    </div>

    <div class="modal-footer d-flex justify-content-center border-0">
        <button class="btn btn-outline-secondary">Prihlásiť</button>
    </div>
</div>

<div class="modal fade" id="modal_login_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center border-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3 content-left border-right text-center" id="login_underline">
                            <button class="btn btn-defaulty" id="login_choice">Prihlásenie</button>
                        </div>

                        <div class="col-md-3 content-right border-left text-center" id="register_underline">
                            <button class="btn btn-default" id="register_choice">Registrácia</button>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>

            <div class="modal-content border-0" id="login_register">

            </div>
        </div>
    </div>
</div>
