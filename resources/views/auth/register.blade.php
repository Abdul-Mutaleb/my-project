<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@include('User.header')

<style>
    body {
        min-height: 100vh;
        background: #f5f7fb;
    }

    .register-wrapper {
        min-height: calc(100vh - 80px);
        padding: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-card {
        border-radius: 12px;
        overflow: hidden;
        width: 100%;
        max-width: 480px;
        margin: auto;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .register-card .card-header {
        background: #fff;
        border-bottom: none;
        font-size: 1.5rem;
        font-weight: 600;
        text-align: center;
        padding: 1.5rem 1rem;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
    }

    .btn-register {
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
    }

    @media (max-width: 576px) {
        .register-card {
            box-shadow: none;
        }

        .register-card .card-header {
            font-size: 1.25rem;
        }
    }
</style>

<div class="container register-wrapper">
    <div class="card register-card">
        <div class="card-header">
            <i class="bi bi-person-plus text-primary"></i> Register
        </div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" 
                           placeholder="Enter your name" required autofocus>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" 
                           placeholder="Enter your email" required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" placeholder="Enter password" required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" 
                           class="form-control" 
                           name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <!-- Button -->
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary btn-register">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
