<!--Add Manager Model-->
<div id="addprojectmodal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark-gradient">
                <h5 class="modal-title display-4" style="font-size:30px; color:#fff;">Add Project</h5>
                <button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color:#fff;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="POST" action="app_project_script.php">
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">Project Name</label>
                            <input type="text" class="form-control" name="project_name" placeholder="Project Name">
                        </div>
                        <div class="col">
                            <label class="col-form-label">Project Revenue (Optional)</label>
                            <input type="number" class="form-control" name="project_price" placeholder="Project Revenue">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">Customer First Name</label>
                            <input type="text" class="form-control" name="client_first_name" placeholder="Customer Name">
                        </div>
                        <div class="col">
                            <label class="col-form-label">Customer Last Name</label>
                            <input type="text" class="form-control" name="client_last_name" placeholder="Customer Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">Customer Email (Optional)</label>
                            <input type="email" class="form-control" name="client_email" placeholder="Customer Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">Project Deadline (Optional)</label>
                            <input type="date" class="form-control" name="project_deadline">
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" name="add_project" class="btn btn-dark">Add</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
