<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .login-box-msg {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }

        .form-floating > label {
            right: 1rem;
            left: auto;
        }

        input::placeholder {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center bg-white border-0">
                <h4 class="fw-bold text-primary mb-0">مرحبا بعودتك</h4>
            </div>

            <div class="card-body">
                <p class="login-box-msg text-center mb-4">تسجيل الدخول</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- ✅ Display validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Email -->
                    <div class="input-group mb-3">
                        <div class="form-floating flex-grow-1">
                            <input
                                type="email"
                                name="email"
                                id="loginEmail"
                                class="form-control"
                                placeholder="Email"
                                required
                            >
                            <label for="loginEmail">البريد الإلكتروني</label>
                        </div>
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-4">
                        <div class="form-floating flex-grow-1">
                            <input
                                type="password"
                                name="password"
                                id="loginPassword"
                                class="form-control"
                                placeholder="Password"
                                required
                            >
                            <label for="loginPassword">كلمة المرور</label>
                        </div>
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>
</html>
