<div class="container justify-content-center mt-5">
    <div class="row justify-content-md-center">
        <div class="col-4 align-items-center">
            <h5>Please log in.</h5>
            <p class="text-danger">{{Content}}</p>
            <form action="/content-management-system/Login" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Admin">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </form>
        </div>
    </div>
</div>