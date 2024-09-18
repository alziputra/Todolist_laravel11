<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
  <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" rel="stylesheet">
</head>

<body>

  {{-- 00. Navbar --}}
  <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="#">
        <span class="has-text-weight-semibold">Simple To Do List</span>
      </a>
    </div>
  </nav>

  <div class="container is-max-desktop">
    {{-- 01. Content --}}
    <div class="box p-4 mt-5 bg-slate-200">
      {{-- Menampilkan pesan sukses jika ada --}}
      @if (session('success'))
        <div id="successMessage" class="notification is-success">
          {{ session('success') }}
        </div>
      @endif

      {{-- Menampilkan pesan error jika ada --}}
      @if ($errors->any())
        <div class="notification is-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- 02. Form input data --}}
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
    </div>

    <div class="box p-4 ">
      {{-- 03. Searching --}}
      <form id="todo-form" action="{{ route('todo') }}" method="get">
        <div class="field has-addons">
          <div class="control is-expanded">
            <input class="input" type="text" name="search" value="{{ request('search') }}"
              placeholder="Masukkan kata kunci">
          </div>
          <div class="control">
            <button type="submit" class="button is-info">Cari</button>
          </div>
        </div>
      </form>

      <ul id="todo-list" class="mt-5 mb-5">
        {{-- 04. Display Data --}}
        @foreach ($datatabel as $item)
          <li class="mb-1 is-flex is-justify-content-space-between is-align-items-center">
            {{-- Menampilkan status task --}}
            <span class="task-text">
              {{ $item->is_done == '1' ? '✅' : '❌' }}
              {!! $item->is_done == '1' ? $item->task : '<del>' . $item->task . '</del>' !!}
            </span>
            <input type="text" class="input edit-input is-hidden" value="{{ $item->task }}">
            <div class="buttons is-grouped">
              <form action="{{ route('todo.delete', ['id' => $item->id]) }}" method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <button type="button"class="button is-danger is-small delete-button mr-1"
                  data-index="{{ $loop->index }}">✕</button>
              </form>
              <!-- $loop->index adalah variabel bawaan dari Blade yang menyediakan indeks dari elemen saat ini dalam loop. -->
              <button class="button is-warning is-small" onclick="toggleUpdateForm({{ $loop->index }})">✎</button>
            </div>
          </li>

          {{-- Menampilkan created_at dan updated_at di bawah task --}}
          <li class="mb-1">
            <p class="is-size-7">Dibuat pada: {{ $item->created_at->format('d M Y, H:i') }}</p>
            <p class="is-size-7">Diperbarui pada: {{ $item->updated_at->format('d M Y, H:i') }}</p>
          </li>

          <!-- Modal -->
          <div class="modal" id="delete-modal">
            <div class="modal-background"></div>
            <div class="modal-card">
              <header class="modal-card-head">
                <p class="modal-card-title">Konfirmasi Hapus</p>
                <button class="delete" aria-label="close" id="close-modal"></button>
              </header>
              <section class="modal-card-body">
                <p>Yakin akan menghapus data ini?</p>
              </section>
              <footer class="modal-card-foot">
                <button class="button is-danger" id="confirm-delete">Ya</button>
                <button class="button" id="cancel-delete">Batal</button>
              </footer>
            </div>
          </div>

          {{-- 05. Update Data (Initially Hidden) --}}
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
                    <input type="radio" value="0" name="is_done"
                      {{ $item->is_done == '0' ? 'checked' : '' }}>
                    Belum
                  </label>
                </div>
              </div>

            </form>
          </li>
        @endforeach
      </ul>
      {{ $datatabel->links('pagination.bulma') }}
    </div>
  </div>
  </div>


  <script>
    // Setelah 8 detik, sembunyikan pesan sukses dan refresh halaman
    setTimeout(function() {
      // Cek apakah elemen pesan sukses ada
      var successMessage = document.getElementById('successMessage');
      if (successMessage) {
        // Sembunyikan pesan
        successMessage.style.display = 'none';
        // Refresh halaman setelah pesan sukses hilang
        location.reload();
      }
    }, 5000); // 5000 milidetik = 5 detik

    function toggleUpdateForm(index) {
      // Mengakses elemen dengan id 'update-form-' yang diikuti oleh indeks dari loop Blade
      var updateForm = document.getElementById('update-form-' + index);
      if (updateForm.classList.contains('is-hidden')) {
        updateForm.classList.remove('is-hidden'); // Menampilkan form jika sebelumnya disembunyikan
      } else {
        updateForm.classList.add('is-hidden'); // Menyembunyikan form jika sebelumnya ditampilkan
      }
    }

    // Ambil semua tombol delete
    const deleteButtons = document.querySelectorAll('.delete-button');
    const deleteModal = document.getElementById('delete-modal');
    const closeModalButton = document.getElementById('close-modal');
    const confirmDeleteButton = document.getElementById('confirm-delete');
    const cancelDeleteButton = document.getElementById('cancel-delete');

    let formToSubmit = null; // Untuk menyimpan form yang akan dihapus

    // Fungsi untuk membuka modal saat tombol delete diklik
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function(event) {
        formToSubmit = button.closest('form'); // Simpan form yang terkait dengan tombol delete
        deleteModal.classList.add('is-active'); // Tampilkan modal
      });
    });

    // Tutup modal saat tombol X atau "Batal" diklik
    closeModalButton.addEventListener('click', function() {
      deleteModal.classList.remove('is-active');
    });

    cancelDeleteButton.addEventListener('click', function() {
      deleteModal.classList.remove('is-active');
    });

    // Lanjutkan proses penghapusan saat tombol "Ya" diklik
    confirmDeleteButton.addEventListener('click', function() {
      if (formToSubmit) {
        formToSubmit.submit(); // Submit form yang disimpan di formToSubmit
      }
    });
  </script>
</body>

</html>
