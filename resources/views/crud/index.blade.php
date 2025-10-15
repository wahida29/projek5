<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>🌐 Dashboard Kolaborasi CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background:#f8f9fa; font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial; }
    h1 { font-weight:700; color:#222; }
    .tab-pane { animation: fadeIn .25s ease-in-out; }
    @keyframes fadeIn { from{opacity:0} to{opacity:1} }
    .spinner { text-align:center; padding:30px; color:#666; font-style:italic; }
    .table thead th { white-space:nowrap; }
    .badge { font-weight:500; }
  </style>
</head>
<body>
<div class="container py-4">
  <h1 class="text-center mb-4">🌐 Dashboard Kolaborasi CRUD</h1>

  <!-- Tabs -->
  <ul class="nav nav-tabs mb-4">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#k5">☕ CaffeShop</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k4">🍔 Krusit (K4)</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k3">📱 Gadget House</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#promo">💸 SobatPromo</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#justbuy">🛍️ JustBuy</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#reservasi">📅 Reservasi</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#public">🌍 Public API</a></li>
  </ul>

  <!-- ==================== ISI TAB ==================== -->
  <div class="tab-content">

    <!-- ===== K5 ===== -->
    <div class="tab-pane fade show active" id="k5">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>☕ CaffeShop</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-success" onclick="openModal('k5',{category:'kopi'})">➕ Tambah Kopi</button>
          <button class="btn btn-sm btn-success" onclick="openModal('k5',{category:'nonkopi'})">➕ Tambah Non Kopi</button>
          <button class="btn btn-sm btn-outline-dark" onclick="loadK5()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK5" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- ===== K4 ===== -->
    <div class="tab-pane fade" id="k4">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>🍔 Krusit (K4)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-primary" onclick="openModal('k4',{_base:'makanan'})">➕ Tambah Makanan</button>
          <button class="btn btn-sm btn-primary" onclick="openModal('k4',{_base:'minuman'})">➕ Tambah Minuman</button>
          <button class="btn btn-sm btn-outline-primary" onclick="loadK4()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK4" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- ===== K3 ===== -->
    <div class="tab-pane fade" id="k3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>📱 Gadget House (K3)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-info" onclick="openModal('k3')">➕ Tambah Produk</button>
          <button class="btn btn-sm btn-outline-info" onclick="loadK3()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK3" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- ===== Promo ===== -->
    <div class="tab-pane fade" id="promo">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>💸 SobatPromo</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-success" onclick="openModal('promo')">➕ Tambah Promo</button>
          <button class="btn btn-sm btn-outline-success" onclick="loadPromo()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePromo" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- ===== JustBuy ===== -->
    <div class="tab-pane fade" id="justbuy">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>🛍️ JustBuy</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-warning" onclick="openModal('justbuy')">➕ Tambah Produk</button>
          <button class="btn btn-sm btn-outline-warning" onclick="loadJB()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableJB" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- ===== Reservasi ===== -->
    <div class="tab-pane fade" id="reservasi">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>📅 Reservasi</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-danger" onclick="openModal('reservasi')">➕ Tambah Reservasi</button>
          <button class="btn btn-sm btn-outline-danger" onclick="loadRes()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableRes" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- ===== Public ===== -->
    <div class="tab-pane fade" id="public">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3>🌍 Public API (Simulasi CRUD)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-secondary" onclick="openModal('public')">➕ Tambah Post</button>
          <button class="btn btn-sm btn-outline-secondary" onclick="loadPublic()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePublic" class="spinner">⏳ Memuat data...</div>
      <small class="text-muted">Perubahan di Public API hanya simulasi (tidak disimpan permanen).</small>
    </div>
  </div>
</div>

<!-- ==================== MODAL ==================== -->
<div class="modal fade" id="crudModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crudTitle">Form</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="crudForm">
        <div class="modal-body" id="crudBody"></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
/* =============== KONFIGURASI PROXY =============== */
const API_K3     = "/proxy/k3";
const API_K4     = "/proxy/k4";
const API_K5     = "/proxy/k5";
const API_PROMO  = "/proxy/promo";
const API_JB     = "/proxy/justbuy";
const API_RES    = "/proxy/reservasi";
const API_PUBLIC = "https://jsonplaceholder.typicode.com/posts";

/* =============== FETCH HELPER =============== */
async function safeFetch(url, opt={}) {
  const res = await fetch(url, opt);
  if (!res.ok) throw new Error(`${res.status} ${url}`);
  const ct = res.headers.get('content-type') || '';
  return ct.includes('application/json') ? res.json() : res.text();
}

/* =============== BUILD TABLE =============== */
function buildTable({id, theadClass, columns, rows, actions}) {
  const el = document.getElementById(id);
  if (!rows || rows.length === 0) {
    el.innerHTML = `<div class="alert alert-info">Tidak ada data.</div>`;
    return;
  }
  const head = `<thead class="${theadClass||''}"><tr>${columns.map(c=>`<th>${c.label}</th>`).join('')}${actions?'<th>Aksi</th>':''}</tr></thead>`;
  const body = `<tbody>${rows.map(r=>`<tr>${columns.map(c=>`<td>${r[c.key]??'-'}</td>`).join('')}${actions?`<td class="text-nowrap">${actions(r)}</td>`:''}</tr>`).join('')}</tbody>`;
  el.innerHTML = `<div class="table-responsive"><table class="table table-striped table-hover">${head}${body}</table></div>`;
}

/* =============== LOAD DATA CAFFESHOP FIX =============== */
async function loadK5(){
  const el = document.getElementById('tableK5');
  el.innerHTML = '⏳ Memuat data...';
  try {
    const kopi = await safeFetch(`${API_K5}/kopi`);
    const non  = await safeFetch(`${API_K5}/nonkopi`);

    // ✅ handle struktur {status, data}
    const kopiData = Array.isArray(kopi) ? kopi : (kopi.data || []);
    const nonData  = Array.isArray(non)  ? non  : (non.data || []);
    const rows = [...kopiData.map(x=>({...x,category:'kopi'})), ...nonData.map(x=>({...x,category:'nonkopi'}))];

    buildTable({
      id:'tableK5', theadClass:'table-dark',
      columns:[
        {key:'id',label:'ID'},
        {key:'name',label:'Nama'},
        {key:'description',label:'Deskripsi'},
        {key:'price',label:'Harga'},
        {key:'category',label:'Kategori'}
      ],
      rows
    });
  } catch(e){
    el.innerHTML = `<div class='alert alert-danger'>⚠️ Gagal memuat data CaffeShop.<br>${e}</div>`;
    console.error(e);
  }
}

/* =============== INISIAL LOAD =============== */
document.addEventListener('DOMContentLoaded', loadK5);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
