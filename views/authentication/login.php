<?php require_once '../../views/header.php'; ?>

<section class="vh-100 bg-custom">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10 p-2">
        <div class="rounded-card">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 mt-5 d-md-block">
              <img src="/roadsters/images/signIn.png" alt="login form" class="img-fluid rounded-img" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
              <form method="POST" action="/roadsters/controllers/AuthController.php?action=login<?php echo isset($_GET['redirect']) ? '&redirect=' . urlencode($_GET['redirect']) : ''; ?><?php echo isset($_GET['make']) ? '&make=' . urlencode($_GET['make']) : ''; ?><?php echo isset($_GET['model']) ? '&model=' . urlencode($_GET['model']) : ''; ?>" class="needs-validation" novalidate>

                
                <h5 class="fw-normal mb-3 pb-3 form-title">Sign into your account</h5>

                    <div class="form-outline mb-4">
                    <input placeholder="Username" type="text" id="username" name="username" class="form-control form-control-lg" required />
                    <div class="invalid-feedback">Please enter your username.</div>
                    </div>

                    <div class="form-outline mb-4">
                    <input placeholder="Password" type="password" id="password" name="password" class="form-control form-control-lg" required />
                    <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <div class="pt-1 mb-4">
                    <button class="btn-stndrd" type="submit">Login</button>
                    </div>
                </form>

    <div class="text-center mt-3">
                  <a href="/roadsters/views/authentication/register.php" class="small text-muted">Don't have an account? Register here</a>
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