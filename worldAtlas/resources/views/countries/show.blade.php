
@section('content')
  <div class="container">
    <h1>{{ $name }}</h1>

    <img 
      src="https://flagcdn.com/w320/{{ strtolower($code) }}.png" 
      alt="Flag of {{ $name }}" 
      style="max-width: 100%; height: auto; margin-bottom: 1rem;"
    >

    <p>Information about {{ $name }} will go here.</p>
    {{-- You can later load data from database or API --}}
  </div>