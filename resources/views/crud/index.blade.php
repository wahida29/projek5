<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>🌐 Dashboard Kolaborasi CRUD 6 Kelompok</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background: #f8f9fa; }
    h1 { font-weight: 700; color: #222; }
    .tab-pane { animation: fadeIn 0.4s ease-in-out; }
    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
    .reload-btn { float: right; font-size: 0.9rem; }
    .spinner { text-align: center; padding: 30px; color: #888; font-style: italic; }
  </style>
</head>
<body>
<div class="container py-4">
  <h1 class="text-center mb-4">🌐 Dashboard Kolaborasi CRUD 6 Kelompok</h1>

  <ul class="nav nav-tabs mb-4">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#k5">☕ CaffeShop</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k4">🍔 Krusit (K4)</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#promo">💸 SobatPromo</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#justbuy">🛍️ JustBuy</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#reservasi">📅 Reservasi</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#public">🌍 Public API</a></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="k5">
      <h3>☕ CaffeShop (Kelompok 5)
        <button class="btn btn-sm btn-outline-dark reload-btn" onclick="loadKelompok5()">🔁 Reload</button>
      </h3>
      <div id="tableKopi" class="spinner">⏳ Memuat data...</div>
    </div>

    <div class="tab-pane fade" id="k4">
      <h3>🍔 Krusit (Kelompok 4)
        <button class="btn btn-sm btn-outline-primary reload-btn" onclick="loadKelompok4()">🔁 Reload</button>
      </h3>
      <div id="tableK4" class="spinner">⏳ Memuat data...</div>
    </div>

    <div class="tab-pane fade" id="promo">
      <h3>💸 SobatPromo
        <button class="btn btn-sm btn-outline-success reload-btn" onclick="loadSobatPromo()">🔁 Reload</button>
      </h3>
      <div id="tablePromo" class="spinner">⏳ Memuat data...</div>
    </div>

    <div class="tab-pane fade" id="justbuy">
      <h3>🛍️ JustBuy
        <button class="btn btn-sm btn-outline-warning reload-btn" onclick="loadJustBuy()">🔁 Reload</button>
      </h3>
      <div id="tableJustBuy" class="spinner">⏳ Memuat data...</div>
    </div>

    <div class="tab-pane fade" id="reservasi">
      <h3>📅 Reservasi (Kelompok 6)
        <button class="btn btn-sm btn-outline-danger reload-btn" onclick="loadReservasi()">🔁 Reload</button>
      </h3>
      <div id="tableReservasi" class="spinner">⏳ Memuat data...</div>
    </div>

    <div class="tab-pane fade" id="public">
      <h3>🌍 Public API
        <button class="btn btn-sm btn-outline-secondary reload-btn" onclick="loadPublic()">🔁 Reload</button>
      </h3>
      <div id="tablePublic" class="spinner">⏳ Memuat data...</div>
    </div>
  </div>
</div>

<script>
const API_K5 = "https://projek5-production.up.railway.app/api";
const API_K4 = "https://projekkelompok4-production-3d9b.up.railway.app/api";
const API_PROMO = "https://sobatpromo-api-production.up.railway.app/api.php";
const API_JB = "https://justbuy-production.up.railway.app/api";
const API_RES = "https://reservasi-production.up.railway.app/api";
const API_PUBLIC = "https://jsonplaceholder.typicode.com/posts";

async function safeFetch(url) {
  const res = await fetch(url);
  if (!res.ok) throw new Error("Error fetch");
  const type = res.headers.get("content-type");
  return type && type.includes("application/json") ? await res.json() : [];
}

// === KELOMPOK 5 ===
async function loadKelompok5() {
  const el = document.querySelector("#tableKopi");
  el.innerHTML = `<div class="spinner">⏳ Memuat data...</div>`;
  try {
    const kopiRes = await safeFetch(`${API_K5}/kopi`);
    const nonRes = await safeFetch(`${API_K5}/nonkopi`);
    const kopi = kopiRes.data || kopiRes;
    const nonkopi = nonRes.data || nonRes;

    el.innerHTML = `
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Gambar</th></tr>
        </thead>
        <tbody>
          ${[...kopi, ...nonkopi].map(i => `
            <tr>
              <td>${i.id}</td>
              <td>${i.name}</td>
              <td>${i.description}</td>
              <td>${i.price}</td>
              <td>${i.image || '-'}</td>
            </tr>`).join('')}
        </tbody>
      </table>`;
  } catch (e) {
    el.innerHTML = `<div class="alert alert-warning">⚠️ API Kelompok 5 tidak merespon</div>`;
  }
}

// === KELOMPOK 4 ===
async function loadKelompok4() {
  const el = document.querySelector("#tableK4");
  el.innerHTML = `<div class="spinner">⏳ Memuat data...</div>`;
  try {
    const makanan = await safeFetch(`${API_K4}/makanan`);
    const minuman = await safeFetch(`${API_K4}/minuman`);
    el.innerHTML = `
      <table class="table table-bordered">
        <thead class="table-primary"><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th></tr></thead>
        <tbody>${[...makanan, ...minuman].map(i => `<tr><td>${i.id}</td><td>${i.name}</td><td>${i.description}</td><td>${i.price}</td></tr>`).join('')}</tbody>
      </table>`;
  } catch {
    el.innerHTML = `<div class="alert alert-warning">⚠️ API Kelompok 4 tidak merespon</div>`;
  }
}

// === SOBATPROMO ===
async function loadSobatPromo() {
  const el = document.querySelector("#tablePromo");
  el.innerHTML = `<div class="spinner">⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(`${API_PROMO}?action=list`);
    el.innerHTML = `
      <table class="table table-hover">
        <thead class="table-success"><tr><th>Judul</th><th>Deskripsi</th><th>Berlaku Sampai</th></tr></thead>
        <tbody>${data.map(p => `<tr><td>${p.title || '-'}</td><td>${p.description || '-'}</td><td>${p.valid_until || '-'}</td></tr>`).join('')}</tbody>
      </table>`;
  } catch {
    el.innerHTML = `<div class="alert alert-warning">⚠️ API SobatPromo tidak merespon</div>`;
  }
}

// === JUSTBUY ===
async function loadJustBuy() {
  const el = document.querySelector("#tableJustBuy");
  el.innerHTML = `<div class="spinner">⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(`${API_JB}/produk`);
    const arr = data.data || data;
    el.innerHTML = `
      <table class="table table-hover">
        <thead class="table-warning"><tr><th>ID</th><th>Nama Produk</th><th>Harga</th></tr></thead>
        <tbody>${arr.map(i => `<tr><td>${i.id}</td><td>${i.name || i.nama}</td><td>${i.price || i.harga}</td></tr>`).join('')}</tbody>
      </table>`;
  } catch {
    el.innerHTML = `<div class="alert alert-warning">⚠️ API JustBuy tidak merespon</div>`;
  }
}

// === RESERVASI ===
async function loadReservasi() {
  const el = document.querySelector("#tableReservasi");
  el.innerHTML = `<div class="spinner">⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(`${API_RES}/reservasi`);
    const arr = data.data || data;
    el.innerHTML = `
      <table class="table table-hover">
        <thead class="table-danger"><tr><th>ID</th><th>Nama</th><th>Tanggal</th><th>Jam</th></tr></thead>
        <tbody>${arr.map(r => `<tr><td>${r.id}</td><td>${r.nama || r.name}</td><td>${r.tanggal || '-'}</td><td>${r.jam || '-'}</td></tr>`).join('')}</tbody>
      </table>`;
  } catch {
    el.innerHTML = `<div class="alert alert-warning">⚠️ API Reservasi tidak merespon</div>`;
  }
}

// === PUBLIC API ===
async function loadPublic() {
  const el = document.querySelector("#tablePublic");
  el.innerHTML = `<div class="spinner">⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(API_PUBLIC);
    el.innerHTML = `
      <table class="table table-hover">
        <thead class="table-secondary"><tr><th>ID</th><th>Judul</th><th>Konten</th></tr></thead>
        <tbody>${data.slice(0,10).map(p => `<tr><td>${p.id}</td><td>${p.title}</td><td>${p.body}</td></tr>`).join('')}</tbody>
      </table>`;
  } catch {
    el.innerHTML = `<div class="alert alert-warning">⚠️ API Public tidak merespon</div>`;
  }
}

// === Load semua data di awal ===
loadKelompok5();
loadKelompok4();
loadSobatPromo();
loadJustBuy();
loadReservasi();
loadPublic();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
