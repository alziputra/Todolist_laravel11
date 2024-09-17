<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
</head>

<body>

  <!-- 00. Navbar -->
  <nav>
    <div>
      <span>Simple To Do List</span>
    </div>
  </nav>

  <div>
    <!-- 01. Content -->
    <h1>To Do List</h1>
    <div>
      <div>
        <!-- 02. Form input data -->
        <form id="todo-form" action="" method="post">
          <div>
            <input type="text" name="task" id="todo-input" placeholder="Tambah task baru" required>
            <button type="submit">Simpan</button>
          </div>
        </form>
      </div>

      <div>
        <!-- 03. Searching -->
        <form id="todo-form" action="" method="get">
          <div>
            <input type="text" name="search" value="" placeholder="Masukkan kata kunci">
            <button type="submit">Cari</button>
          </div>
        </form>

        <ul id="todo-list">
          <!-- 04. Display Data -->
          <li>
            <span class="task-text">Coding</span>
            <input type="text" class="edit-input" style="display: none;" value="Coding">
            <div>
              <button>✕</button>
              <button>✎</button>
            </div>
          </li>

          <!-- 05. Update Data -->
          <li>
            <form action="" method="POST">
              <div>
                <div>
                  <input type="text" name="task" value="Coding">
                  <button type="button">Update</button>
                </div>
              </div>
              <div>
                <div>
                  <label>
                    <input type="radio" value="1" name="is_done"> Selesai
                  </label>
                </div>
                <div>
                  <label>
                    <input type="radio" value="0" name="is_done"> Belum
                  </label>
                </div>
              </div>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>

</body>

</html>
