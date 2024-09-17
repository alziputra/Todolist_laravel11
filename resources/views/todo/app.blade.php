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
        <span class="has-text-white">Simple To Do List</span>
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

      <form id="todo-form" action="{{ url('/todo') }}" method="post">
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
        <li class="box is-flex is-justify-content-space-between is-align-items-center">
          <span class="task-text">Coding</span>
          <input type="text" class="input edit-input is-hidden" value="Coding">
          <div class="buttons">
            <button class="button is-danger is-small">✕</button>
            <button class="button is-warning is-small" onclick="toggleUpdateForm()">✎</button>
          </div>
        </li>

        <!-- 05. Update Data (Initially Hidden) -->
        <li class="box is-hidden" id="update-form">
          <form action="" method="POST">
            <div class="field is-grouped">
              <div class="control is-expanded">
                <input type="text" name="task" class="input" value="Coding">
              </div>
              <div class="control">
                <button type="button" class="button is-primary">Update</button>
              </div>
            </div>
            <div class="field mt-3">
              <div class="control">
                <label class="radio">
                  <input type="radio" value="1" name="is_done">
                  Selesai
                </label>
              </div>
              <div class="control">
                <label class="radio">
                  <input type="radio" value="0" name="is_done">
                  Belum
                </label>
              </div>
            </div>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <script>
    function toggleUpdateForm() {
      var updateForm = document.getElementById('update-form');
      if (updateForm.classList.contains('is-hidden')) {
        updateForm.classList.remove('is-hidden');
      } else {
        updateForm.classList.add('is-hidden');
      }
    }
  </script>

</body>

</html>
