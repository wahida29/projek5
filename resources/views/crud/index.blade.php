<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Makanan & Minuman - Kelompok 4</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="text-center mb-4">🍴 CRUD Makanan & Minuman</h1>

  <!-- TABS -->
  <ul class="nav nav-tabs mb-4" id="crudTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#makanan">Makanan</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#minuman">Minuman</a></li>
  </ul>

  <div class="tab-content">
    <!-- Makanan -->
    <div class="tab-pane fade show active" id="makanan">
      <h3>Data Makanan</h3>
      <table class="table table-bordered table-striped mt-3" id="tableMakanan">
        <thead>
          <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>
        </thead>
        <tbody></tbody>
      </table>

      <h4 class="mt-4">Tambah / Edit Makanan</h4>
      <form id="formMakanan">
        <input type="hidden" id="makananId">
        <div class="mb-2"><input type="text" id="makananName" class="form-control" placeholder="Nama"></div>
        <div class="mb-2"><input type="text" id="makananDesc" class="form-control" placeholder="Deskripsi"></div>
        <div class="mb-2"><input type="number" id="makananPrice" class="form-control" placeholder="Harga"></div>
        <div class="mb-2"><input type="text" id="makananImage" class="form-control" placeholder="Nama Gambar"></div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="resetForm('makanan')">Bersihkan</button>
      </form>
    </div>

    <!-- Minuman -->
    <div class="tab-pane fade" id="minuman">
      <h3>Data Minuman</h3>
      <table class="table table-bordered table-striped mt-3" id="tableMinuman">
        <thead>
          <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>
        </thead>
        <tbody></tbody>
      </table>

      <h4 class="mt-4">Tambah / Edit Minuman</h4>
      <form id="formMinuman">
        <input type="hidden" id="minumanId">
        <div class="mb-2"><input type="text" id="minumanName" class="form-control" placeholder="Nama"></div>
        <div class="mb-2"><input type="text" id="minumanDesc" class="form-control" placeholder="Deskripsi"></div>
        <div class="mb-2"><input type="number" id="minumanPrice" class="form-control" placeholder="Harga"></div>
        <div class="mb-2"><input type="text" id="minumanImage" class="form-control" placeholder="Nama Gambar"></div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="resetForm('minuman')">Bersihkan</button>
      </form>
    </div>
  </div>
</div>

<script>
const API_BASE = "https://projekkelompok4-production-3d9b.up.railway.app/api";

// ---- CRUD MAKANAN ----
async function loadMakanan() {
  const res = await fetch(`${API_BASE}/makanan`);
  const data = await res.json();
  const tbody = document.querySelector("#tableMakanan tbody");
  tbody.innerHTML = "";
  data.forEach(item => {
    tbody.innerHTML += `
      <tr>
        <td>${item.id}</td><td>${item.name}</td><td>${item.description}</td>
        <td>${item.price}</td><td>${item.image}</td>
        <td>
          <button class='btn btn-warning btn-sm' onclick='editMakanan(${JSON.stringify(item)})'>Edit</button>
          <button class='btn btn-danger btn-sm' onclick='deleteMakanan(${item.id})'>Hapus</button>
        </td>
      </tr>`;
  });
}

document.querySelector("#formMakanan").addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = makananId.value;
  const body = JSON.stringify({
    name: makananName.value,
    description: makananDesc.value,
    category: "makanan",
    price: makananPrice.value,
    image: makananImage.value
  });

  const method = id ? "PUT" : "POST";
  const url = id ? `${API_BASE}/makanan/${id}` : `${API_BASE}/makanan`;

  await fetch(url, { method, headers: { "Content-Type": "application/json" }, body });
  loadMakanan();
  resetForm("makanan");
});

function editMakanan(item) {
  makananId.value = item.id;
  makananName.value = item.name;
  makananDesc.value = item.description;
  makananPrice.value = item.price;
  makananImage.value = item.image;
}

async function deleteMakanan(id) {
  if (confirm("Yakin hapus data ini?")) {
    await fetch(`${API_BASE}/makanan/${id}`, { method: "DELETE" });
    loadMakanan();
  }
}

// ---- CRUD MINUMAN ----
async function loadMinuman() {
  const res = await fetch(`${API_BASE}/minuman`);
  const data = await res.json();
  const tbody = document.querySelector("#tableMinuman tbody");
  tbody.innerHTML = "";
  data.forEach(item => {
    tbody.innerHTML += `
      <tr>
        <td>${item.id}</td><td>${item.name}</td><td>${item.description}</td>
        <td>${item.price}</td><td>${item.image}</td>
        <td>
          <button class='btn btn-warning btn-sm' onclick='editMinuman(${JSON.stringify(item)})'>Edit</button>
          <button class='btn btn-danger btn-sm' onclick='deleteMinuman(${item.id})'>Hapus</button>
        </td>
      </tr>`;
  });
}

document.querySelector("#formMinuman").addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = minumanId.value;
  const body = JSON.stringify({
    name: minumanName.value,
    description: minumanDesc.value,
    category: "minuman",
    price: minumanPrice.value,
    image: minumanImage.value
  });

  const method = id ? "PUT" : "POST";
  const url = id ? `${API_BASE}/minuman/${id}` : `${API_BASE}/minuman`;

  await fetch(url, { method, headers: { "Content-Type": "application/json" }, body });
  loadMinuman();
  resetForm("minuman");
});

function editMinuman(item) {
  minumanId.value = item.id;
  minumanName.value = item.name;
  minumanDesc.value = item.description;
  minumanPrice.value = item.price;
  minumanImage.value = item.image;
}

async function deleteMinuman(id) {
  if (confirm("Yakin hapus data ini?")) {
    await fetch(`${API_BASE}/minuman/${id}`, { method: "DELETE" });
    loadMinuman();
  }
}

function resetForm(type) {
  document.querySelector(`#form${type.charAt(0).toUpperCase() + type.slice(1)}`).reset();
  document.getElementById(`${type}Id`).value = "";
}

loadMakanan();
loadMinuman();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
