<!--Add Manager Model-->
<div id="addmanagermodal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4" style="font-size:30px;">Add Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="POST" action="../login-system/sign-up.php">
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">First Name</label>
                            <input type="text" class="form-control" name="first" placeholder="First name">
                        </div>
                        <div class="col">
                            <label class="col-form-label">Last Name</label>
                            <input type="text" class="form-control" name="last" placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="col mb-3">
                            <label class="col-form-label">Re-Enter Password</label>
                            <input type="password" class="form-control" name="re-password" placeholder="Re-Enter Password">
                            <input type="hidden" name="user_type" value="2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="register" class="btn btn-dark">Add</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
