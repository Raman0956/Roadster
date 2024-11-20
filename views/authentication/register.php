<?php require_once '../../views/header.php'; ?>

<section class="vh-100">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col col-xl-10 p-2">
        <div class="rounded-card">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 mt-5 d-md-block">
              <img src="/roadsters/images/register.png" alt="register form" class="img-fluid rounded-img" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body  text-black">

                <form method="POST" action="/roadsters/controllers/AuthController.php?action=register" class="needs-validation" novalidate>
                  <h5 class="fw-normal mb-3 pb-3 form-title">Create an account</h5>

                  <div class="form-outline mb-4">
                    <input type="text" placeholder="username" id="username" name="username" class="form-control form-control-lg" required />
                
                    <div class="invalid-feedback">Please enter a username.</div>
                  </div>

                  <div class="form-outline mb-4">
                    <input  placeholder="Email" type="email" id="email" name="email" class="form-control form-control-lg" required />
                    <div class="invalid-feedback">Please enter a valid email.</div>
                  </div>

                  <div class="form-outline mb-4">
                    <input  placeholder="Password" type="password" id="password" name="password" class="form-control form-control-lg" required />
                    
                    <div class="invalid-feedback">Please enter a password.</div>
                  </div>

                  <div class="form-outline mb-4">
                    <select id="role" name="role" class="form-select form-control-lg d-flex justify-content-start" required>
                      <option value="Client">Client</option>
                      <option value="Admin">Admin</option>
                    </select>
                    <div class="invalid-feedback">Please select a role.</div>
                  </div>

                  <div class="pt-1 mb-4">
                    <button type="submit" class="btn-stndrd">Register</button>
                  </div>

                </form>

                <div class="text-center mt-3">
                  <a href="/roadsters/views/authentication/login.php" class="small text-muted">Back to Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>