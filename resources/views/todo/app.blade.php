<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
  <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" rel="stylesheet">
</head>

<body>

  <!-- 00. Navbar -->
  <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="#">
        <span class="has-text-weight-semibold">Simple To Do List</span>
      </a>
    </div>
  </nav>

  <div class="container mt-5">
    <!-- 01. Content -->
    <h1 class="title is-3">To Do List</h1>

    <div class="box">
      <!-- 02. Form input data -->
      @if (session('success'))
        <div class="notification is-success">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="notification is-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="todo-form" action="{{ route('todo.post') }}" method="post">
        @csrf
        <div class="field has-addons">
          <div class="control is-expanded">
            <input class="input" type="text" name="task" id="todo-input" placeholder="Tambah task baru" required
              value="{{ old('task') }}">
          </div>
          <div class="control">
            <button type="submit" class="button is-primary">Simpan</button>
          </div>
        </div>
      </form>

      <!-- 03. Searching -->
      <form id="todo-form" action="" method="get" class="mt-4">
        <div class="field has-addons">
          <div class="control is-expanded">
            <input class="input" type="text" name="search" value="" placeholder="Masukkan kata kunci">
          </div>
          <div class="control">
            <button type="submit" class="button is-info">Cari</button>
          </div>
        </div>
      </form>

      <ul id="todo-list" class="mt-5">
        <!-- 04. Display Data -->
        @foreach ($datatabel as $item)
          <li class="mb-1 is-flex is-justify-content-space-between is-align-items-center">
            {{-- menampilkan status task --}}
            <span class="task-text">
              {{ $item->is_done == '1' ? '✅' : '❌' }}
              {!! $item->is_done == '1' ? $item->task : '<del>' . $item->task . '</del>' !!}
            </span>
            <input type="text" class="input edit-input is-hidden" value="{{ $item->task }}">
            <div class="buttons">
              <button class="button is-danger is-small">✕</button>
              <!-- $loop->index adalah variabel bawaan dari Blade yang menyediakan indeks dari elemen saat ini dalam loop. -->
              <button class="button is-warning is-small" onclick="toggleUpdateForm({{ $loop->index }})">✎</button>
            </div>
          </li>

          <!-- 05. Update Data (Initially Hidden) -->
          <li class="box is-hidden" id="update-form-{{ $loop->index }}">
            <form action="{{ route('todo.update', ['id' => $item->id]) }}" method="POST">
              @csrf
              {{-- gunakan method PUT bawaan Laravel untuk mengirimkan data ke route update --}}
              @method('PUT')
              <div class="field is-grouped">
                <div class="control is-expanded">
                  <input type="text" name="task" class="input" value="{{ $item->task }}">
                </div>
                <div class="control">
                  <button type="submit" class="button is-primary">Update</button>
                </div>
              </div>
              <div class="is-flex is-align-items-center">
                <div class="control mr-2">
                  <label class="radio">
                    <input type="radio" value="1" name="is_done" {{ $item->is_done == '1' ? 'checked' : '' }}>
                    Selesai
                  </label>
                </div>
                <div class="control">
                  <label class="radio">
                    <input type="radio" value="0" name="is_done" {{ $item->is_done == '0' ? 'checked' : '' }}>
                    Belum
                  </label>
                </div>
              </div>

            </form>
          </li>
        @endforeach
      </ul>

      <script>
        function toggleUpdateForm(index) {
          // Mengakses elemen dengan id 'update-form-' yang diikuti oleh indeks dari loop Blade
          var updateForm = document.getElementById('update-form-' + index);
          if (updateForm.classList.contains('is-hidden')) {
            updateForm.classList.remove('is-hidden'); // Menampilkan form jika sebelumnya disembunyikan
          } else {
            updateForm.classList.add('is-hidden'); // Menyembunyikan form jika sebelumnya ditampilkan
          }
        }
      </script>

</body>

</html>
