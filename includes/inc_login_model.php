<!--Sign-up Model-->
	<div id="signupmodal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title display-4" style="font-size:30px;">Sign-up</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form  method="POST" action="login-system/sign-up.php">
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
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="register" class="btn btn-dark">Sign-up</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!--Sign-in Model-->
	<div id="signinmodal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
				    <h5 class="modal-title display-4" style="font-size:30px;">Sign-in</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				    </button>
			    </div>
			    <div class="modal-body">
				    <form method="POST" action="login-system/sign-in.php">
					    <div class="form-group">
							<label class="col-form-label">E-mail</label>
							<input type="email" class="form-control" name="email" placeholder="E-mail">
						</div>
						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>

						<div class="modal-footer">
							<button type="submit" name="login" class="btn btn-dark">Sign-in</button>
					    	<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
					    </div>
				    </form>
			    </div>
		    </div>
	 	</div>
	</div>
