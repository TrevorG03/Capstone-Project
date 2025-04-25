<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $name }} - Country Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="row g-0">
        <div class="col-md-5 d-flex align-items-center justify-content-center bg-light p-4 rounded-start">
          <img 
            src="https://flagcdn.com/w640/{{ strtolower($code) }}.png" 
            alt="Flag of {{ $name }}" 
            class="img-fluid rounded shadow"
          >
        </div>

        <div class="col-md-7 p-4">
          <h1 class="mb-3 fw-bold">{{ $name }}</h1>

          <p class="text-muted mb-4">Explore Information and attractions in <strong>{{ $name }}</strong>.</p>

          <div class="d-flex gap-3">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary rounded-pill px-4">
              ← Back
            </a>
            <a href="{{ route('review', ['country' => $code]) }}" class="btn btn-primary rounded-pill px-4">
              🌟 View More
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-5 p-4 bg-body-tertiary rounded-4 shadow-sm">
      <h3 class="mb-3">More About {{ $name }}</h3>
      <p>
        Information about {{ $name }} will go here.
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
