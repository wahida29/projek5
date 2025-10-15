<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>☕ CRUD Kopi & Non Kopi - Projek 5 CaffeShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="text-center mb-4">☕ CRUD Kopi & Non Kopi</h1>

  <!-- TABS -->
  <ul class="nav nav-tabs mb-4" id="crudTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#kopi">Kopi</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nonkopi">Non Kopi</a></li>
  </ul>

  <div class="tab-content">
    <!-- Kopi -->
    <div class="tab-pane fade show active" id="kopi">
      <h3>Data Kopi</h3>
      <table class="table table-bordered table-striped mt-3" id="tableKopi">
        <thead>
          <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>
        </thead>
        <tbody></tbody>
      </table>

      <h4 class="mt-4">Tambah / Edit Kopi</h4>
      <form id="formKopi">
        <input type="hidden" id="kopiId">
        <div class="mb-2"><input type="text" id="kopiName" class="form-control" placeholder="Nama Kopi"></div>
        <div class="mb-2"><input type="text" id="kopiDesc" class="form-control" placeholder="Deskripsi Kopi"></div>
        <div class="mb-2"><input type="number" id="kopiPrice" class="form-control" placeholder="Harga"></div>
        <div class="mb-2"><input type="text" id="kopiImage" class="form-control" placeholder="Nama Gambar"></div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="resetForm('kopi')">Bersihkan</button>
      </form>
    </div>

    <!-- Non Kopi -->
    <div class="tab-pane fade" id="nonkopi">
      <h3>Data Non Kopi</h3>
      <table class="table table-bordered table-striped mt-3" id="tableNonKopi">
        <thead>
          <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>
        </thead>
        <tbody></tbody>
      </table>

      <h4 class="mt-4">Tambah / Edit Non Kopi</h4>
      <form id="formNonKopi">
        <input type="hidden" id="nonkopiId">
        <div class="mb-2"><input type="text" id="nonkopiName" class="form-control" placeholder="Nama Minuman Non Kopi"></div>
        <div class="mb-2"><input type="text" id="nonkopiDesc" class="form-control" placeholder="Deskripsi"></div>
        <div class="mb-2"><input type="number" id="nonkopiPrice" class="form-control" placeholder="Harga"></div>
        <div class="mb-2"><input type="text" id="nonkopiImage" class="form-control" placeholder="Nama Gambar"></div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" onclick="resetForm('nonkopi')">Bersihkan</button>
      </form>
    </div>
  </div>
</div>

<script>
const API_BASE = "https://projek5-production.up.railway.app/api";

// ==== CRUD KOPI ====
async function loadKopi() {
  const res = await fetch(`${API_BASE}/kopi`);
  const data = await res.json();
  const tbody = document.querySelector("#tableKopi tbody");
  tbody.innerHTML = "";
  data.forEach(item => {
    tbody.innerHTML += `
      <tr>
        <td>${item.id}</td><td>${item.name}</td><td>${item.description}</td>
        <td>${item.price}</td><td>${item.image || "-"}</td>
        <td>
          <button class='btn btn-warning btn-sm' onclick='editKopi(${JSON.stringify(item)})'>Edit</button>
          <button class='btn btn-danger btn-sm' onclick='deleteKopi(${item.id})'>Hapus</button>
        </td>
      </tr>`;
  });
}

document.querySelector("#formKopi").addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = kopiId.value;
  const body = JSON.stringify({
    name: kopiName.value,
    description: kopiDesc.value,
    category: "kopi",
    price: kopiPrice.value,
    image: kopiImage.value
  });

  const method = id ? "PUT" : "POST";
  const url = id ? `${API_BASE}/kopi/${id}` : `${API_BASE}/kopi`;

  await fetch(url, { method, headers: { "Content-Type": "application/json" }, body });
  loadKopi();
  resetForm("kopi");
});

function editKopi(item) {
  kopiId.value = item.id;
  kopiName.value = item.name;
  kopiDesc.value = item.description;
  kopiPrice.value = item.price;
  kopiImage.value = item.image;
}

async function deleteKopi(id) {
  if (confirm("Yakin hapus data kopi ini?")) {
    await fetch(`${API_BASE}/kopi/${id}`, { method: "DELETE" });
    loadKopi();
  }
}

// ==== CRUD NON KOPI ====
async function loadNonKopi() {
  const res = await fetch(`${API_BASE}/nonkopi`);
  const data = await res.json();
  const tbody = document.querySelector("#tableNonKopi tbody");
  tbody.innerHTML = "";
  data.forEach(item => {
    tbody.innerHTML += `
      <tr>
        <td>${item.id}</td><td>${item.name}</td><td>${item.description}</td>
        <td>${item.price}</td><td>${item.image || "-"}</td>
        <td>
          <button class='btn btn-warning btn-sm' onclick='editNonKopi(${JSON.stringify(item)})'>Edit</button>
          <button class='btn btn-danger btn-sm' onclick='deleteNonKopi(${item.id})'>Hapus</button>
        </td>
      </tr>`;
  });
}

document.querySelector("#formNonKopi").addEventListener("submit", async (e) => {
  e.preventDefault();
  const id = nonkopiId.value;
  const body = JSON.stringify({
    name: nonkopiName.value,
    description: nonkopiDesc.value,
    category: "nonkopi",
    price: nonkopiPrice.value,
    image: nonkopiImage.value
  });

  const method = id ? "PUT" : "POST";
  const url = id ? `${API_BASE}/nonkopi/${id}` : `${API_BASE}/nonkopi`;

  await fetch(url, { method, headers: { "Content-Type": "application/json" }, body });
  loadNonKopi();
  resetForm("nonkopi");
});

function editNonKopi(item) {
  nonkopiId.value = item.id;
  nonkopiName.value = item.name;
  nonkopiDesc.value = item.description;
  nonkopiPrice.value = item.price;
  nonkopiImage.value = item.image;
}

async function deleteNonKopi(id) {
  if (confirm("Yakin hapus data non kopi ini?")) {
    await fetch(`${API_BASE}/nonkopi/${id}`, { method: "DELETE" });
    loadNonKopi();
  }
}

// ==== Reset Form ====
function resetForm(type) {
  document.querySelector(`#form${type.charAt(0).toUpperCase() + type.slice(1)}`).reset();
  document.getElementById(`${type}Id`).value = "";
}

// ==== Load Data Saat Awal ====
loadKopi();
loadNonKopi();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
