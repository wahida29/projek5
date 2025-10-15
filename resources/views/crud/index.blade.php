<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard CRUD API — 7 Kelompok</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root{
      --brown:#6f4e37; --brown-dark:#3e2723; --cream:#f8f5f2;
    }
    html,body{background:var(--cream)}
    h1{color:var(--brown-dark);font-weight:800}
    .nav-tabs .nav-link.active{background:var(--brown-dark);color:#fff !important;border:none}
    .nav-tabs .nav-link{color:var(--brown-dark)}
    .card{border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06)}
    .table th{background:var(--brown-dark);color:#fff;vertical-align:middle}
    .btn-brown{background:var(--brown);color:#fff;border:none}
    .btn-brown:hover{background:#5c4033}
    .endpoint{font-size:.75rem;background:#eef;border:1px solid #dde;color:#334;padding:.2rem .5rem;border-radius:.4rem}
    .muted{color:#6c757d}
    .modal-header{background:var(--brown-dark);color:#fff}
    .toolbar{gap:.5rem}
  </style>
</head>
<body>
<div class="container py-5">
  <h1 class="text-center mb-4"><i class="bi bi-database-gear"></i> Dashboard CRUD API</h1>
  <p class="text-center muted mb-4">Semua kelompok aktif. Jika API down, tabel tetap tampil dan ada pesan status.</p>

  <!-- Tabs -->
  <ul class="nav nav-tabs justify-content-center">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#sp">SobatPromo</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#jb">JustBuy</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#gh">Gadget House</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#kr">Krusit</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#cs">CoffeeShop</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#rv">Reservasi</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#mg">Maguru</a></li>
  </ul>

  <div class="tab-content mt-4">

    <!-- ============= SOBATPROMO ============= -->
    <div class="tab-pane fade show active" id="sp">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">SobatPromo <span class="endpoint" id="ep-sp"></span></h4>
        <div class="toolbar d-flex">
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-sp" onclick="openCreate('sobatpromo')"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" onclick="reloadResource('sobatpromo')"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div id="table-sp" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
      </div></div>
    </div>

    <!-- ============= JUSTBUY ============= -->
    <div class="tab-pane fade" id="jb">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">JustBuy <span class="endpoint" id="ep-jb"></span></h4>
        <div class="toolbar d-flex">
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-jb" onclick="openCreate('justbuy')"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" onclick="reloadResource('justbuy')"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div id="table-jb" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
      </div></div>
    </div>

    <!-- ============= GADGET HOUSE ============= -->
    <div class="tab-pane fade" id="gh">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Gadget House <span class="endpoint" id="ep-gh"></span></h4>
        <div class="toolbar d-flex">
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-gh" onclick="openCreate('gadget')"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" onclick="reloadResource('gadget')"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div id="table-gh" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
      </div></div>
    </div>

    <!-- ============= KRUSIT ============= -->
    <div class="tab-pane fade" id="kr">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Krusit <span class="endpoint" id="ep-kr"></span></h4>
        <div class="toolbar d-flex">
          <button class="btn btn-outline-secondary btn-sm" onclick="reloadResource('krusit')"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="mb-0">Makanan</h5>
            <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-krm" onclick="openCreate('krusit-makanan')"><i class="bi bi-plus-circle"></i> Tambah</button>
          </div>
          <div class="card"><div class="card-body">
            <div id="table-krm" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
          </div></div>
        </div>

        <div class="col-lg-6">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="mb-0">Minuman</h5>
            <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-kri" onclick="openCreate('krusit-minuman')"><i class="bi bi-plus-circle"></i> Tambah</button>
          </div>
          <div class="card"><div class="card-body">
            <div id="table-kri" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
          </div></div>
        </div>
      </div>
    </div>

    <!-- ============= COFFEESHOP ============= -->
    <div class="tab-pane fade" id="cs">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">CoffeeShop <span class="endpoint" id="ep-cs"></span></h4>
        <div class="toolbar d-flex">
          <button class="btn btn-outline-secondary btn-sm" onclick="reloadResource('coffeeshop')"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="mb-0">Kopi</h5>
            <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-ck" onclick="openCreate('cs-kopi')"><i class="bi bi-plus-circle"></i> Tambah</button>
          </div>
          <div class="card"><div class="card-body">
            <div id="table-ck" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
          </div></div>
        </div>

        <div class="col-lg-6">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="mb-0">NonKopi</h5>
            <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-cn" onclick="openCreate('cs-nonkopi')"><i class="bi bi-plus-circle"></i> Tambah</button>
          </div>
          <div class="card"><div class="card-body">
            <div id="table-cn" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
          </div></div>
        </div>
      </div>
    </div>

    <!-- ============= RESERVASI ============= -->
    <div class="tab-pane fade" id="rv">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Reservasi <span class="endpoint" id="ep-rv"></span></h4>
        <div class="toolbar d-flex">
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-rv" onclick="openCreate('reservasi')"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" onclick="reloadResource('reservasi')"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div id="table-rv" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
      </div></div>
    </div>

    <!-- ============= MAGURU ============= -->
    <div class="tab-pane fade" id="mg">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Maguru <span class="endpoint" id="ep-mg"></span></h4>
        <div class="toolbar d-flex">
          <button class="btn btn-outline-secondary btn-sm" onclick="reloadResource('maguru')"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="mb-0">Products</h5>
            <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-mgp" onclick="openCreate('mg-products')"><i class="bi bi-plus-circle"></i> Tambah</button>
          </div>
          <div class="card"><div class="card-body">
            <div id="table-mgp" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
          </div></div>
        </div>

        <div class="col-lg-6">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="mb-0">Categories</h5>
            <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modal-mgc" onclick="openCreate('mg-categories')"><i class="bi bi-plus-circle"></i> Tambah</button>
          </div>
          <div class="card"><div class="card-body">
            <div id="table-mgc" class="table-responsive"><div class="text-center py-3 muted">Memuat…</div></div>
          </div></div>
        </div>
      </div>
    </div>

  </div><!-- /tab-content -->
</div><!-- /container -->

<!-- ========= MODALS (Tambah/Edit) ========= -->
<!-- SobatPromo -->
<div class="modal fade" id="modal-sp" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-sp">
    <div class="modal-header"><h5 class="modal-title">SobatPromo</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="sp-id">
      <div class="col-12"><input class="form-control" id="sp-title" placeholder="Judul" required></div>
      <div class="col-12"><input class="form-control" id="sp-desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="date" class="form-control" id="sp-until" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- JustBuy -->
<div class="modal fade" id="modal-jb" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-jb">
    <div class="modal-header"><h5 class="modal-title">JustBuy - Akun</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="jb-id">
      <div class="col-12"><input class="form-control" id="jb-username" placeholder="Username" required></div>
      <div class="col-12"><input class="form-control" id="jb-email" placeholder="Email" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Gadget -->
<div class="modal fade" id="modal-gh" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-gh">
    <div class="modal-header"><h5 class="modal-title">Gadget House - Produk</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="gh-id">
      <div class="col-12"><input class="form-control" id="gh-name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="gh-brand" placeholder="Brand" required></div>
      <div class="col-12"><input type="number" class="form-control" id="gh-price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Krusit: Makanan -->
<div class="modal fade" id="modal-krm" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-krm">
    <div class="modal-header"><h5 class="modal-title">Krusit - Makanan</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="krm-id">
      <div class="col-12"><input class="form-control" id="krm-name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="krm-desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="krm-price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Krusit: Minuman -->
<div class="modal fade" id="modal-kri" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-kri">
    <div class="modal-header"><h5 class="modal-title">Krusit - Minuman</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="kri-id">
      <div class="col-12"><input class="form-control" id="kri-name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="kri-desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="kri-price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Coffee: Kopi -->
<div class="modal fade" id="modal-ck" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-ck">
    <div class="modal-header"><h5 class="modal-title">CoffeeShop - Kopi</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="ck-id">
      <div class="col-12"><input class="form-control" id="ck-name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="ck-desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="ck-price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Coffee: NonKopi -->
<div class="modal fade" id="modal-cn" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-cn">
    <div class="modal-header"><h5 class="modal-title">CoffeeShop - NonKopi</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="cn-id">
      <div class="col-12"><input class="form-control" id="cn-name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="cn-desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="cn-price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Reservasi -->
<div class="modal fade" id="modal-rv" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-rv">
    <div class="modal-header"><h5 class="modal-title">Reservasi</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="rv-id">
      <div class="col-12"><input class="form-control" id="rv-nama" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="rv-telp" placeholder="Telepon" required></div>
      <div class="col-12"><input type="datetime-local" class="form-control" id="rv-waktu" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Maguru: Products -->
<div class="modal fade" id="modal-mgp" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-mgp">
    <div class="modal-header"><h5 class="modal-title">Maguru - Product</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="mgp-id">
      <div class="col-12"><input class="form-control" id="mgp-name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="mgp-desc" placeholder="Deskripsi"></div>
      <div class="col-12"><input type="number" class="form-control" id="mgp-price" placeholder="Harga"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Maguru: Categories -->
<div class="modal fade" id="modal-mgc" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="form-mgc">
    <div class="modal-header"><h5 class="modal-title">Maguru - Category</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="mgc-id">
      <div class="col-12"><input class="form-control" id="mgc-name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="mgc-slug" placeholder="Slug" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>
<!-- ======== /MODALS ======== -->

<script>
/* =================== KONFIGURASI ENDPOINT =================== */
/* Kamu boleh ganti nilai di sini kalau domain/route kalian berbeda */
const API = {
  // SobatPromo pakai query ?action=... (list/create/update/delete)
  SOBATPROMO: "https://sobatpromo-api-production.up.railway.app/api.php",

  // JustBuy: sesuaikan path resource (contoh /accounts). Jika belum ada, tools akan tetap render tabel kosong.
  JUSTBUY: "https://projekkelompok9-production.up.railway.app/api",

  // Gadget House: sesuaikan /products
  GADGET: "https://your-gadget-house-api.example.com/api",

  // Krusit (Kelompok 4) — sudah pasti: /makanan & /minuman
  KRUSIT: "https://projekkelompok4-production-3d9b.up.railway.app/api",

  // CoffeeShop (Kelompok 5) — /kopi & /nonkopi
  COFFEE: "https://projek5-production.up.railway.app/api",

  // Reservasi (Kelompok 6) — silakan ganti ke endpoint nyata kalian
  RESERVASI: "https://your-reservasi-api.example.com/api",

  // Maguru public API (default dev di localhost — ganti ke domain deploy bila ada)
  MAGURU: "http://localhost:3001/api/public"
};
// tampilkan endpoint di badge
document.addEventListener('DOMContentLoaded', ()=>{
  document.getElementById('ep-sp').textContent = API.SOBATPROMO;
  document.getElementById('ep-jb').textContent = API.JUSTBUY;
  document.getElementById('ep-gh').textContent = API.GADGET;
  document.getElementById('ep-kr').textContent = API.KRUSIT;
  document.getElementById('ep-cs').textContent = API.COFFEE;
  document.getElementById('ep-rv').textContent = API.RESERVASI;
  document.getElementById('ep-mg').textContent = API.MAGURU;
});

/* =================== UTIL INTI FETCH =================== */
async function http(method, url, payload=null){
  const headers = {'Content-Type':'application/json'};
  // Coba method asli dulu
  const tryReq = async (m, body) => fetch(url, {method:m, headers, body: body?JSON.stringify(body):null});
  let res = await tryReq(method, payload);
  if (!res.ok && method !== 'GET'){ // fallback: POST + _method
    const fb = await tryReq('POST', {...(payload||{}), _method: method});
    res = fb;
  }
  if (!res.ok) {
    const txt = await res.text().catch(()=>res.statusText);
    throw new Error(`${res.status} ${res.statusText} — ${txt.slice(0,180)}`);
  }
  const ct = res.headers.get('content-type')||'';
  return ct.includes('json') ? res.json() : res.text();
}
function renderTable(containerId, columns, rows, onEdit, onDelete){
  const el = document.getElementById(containerId);
  const thead = `<thead><tr>${columns.map(c=>`<th>${c.label}</th>`).join('')}<th>Aksi</th></tr></thead>`;
  const tbody = rows.length ? `<tbody>${
    rows.map(r=>{
      const tds = columns.map(c => `<td>${(r[c.key]??'')}</td>`).join('');
      const eid = r._idForEdit ?? r.id ?? r._id ?? r.uuid ?? '';
      return `<tr>${tds}
        <td>
          <button class="btn btn-warning btn-sm me-1" ${eid===''?'disabled':''}
            onclick='(${onEdit})(${JSON.stringify(r)})'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" ${eid===''?'disabled':''}
            onclick='(${onDelete})(${JSON.stringify(r)})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`;
    }).join('')
  }</tbody>` : `<tbody><tr><td colspan="${columns.length+1}" class="text-center muted py-3">Tidak ada data</td></tr></tbody>`;
  el.innerHTML = `<table class="table table-bordered align-middle text-center">${thead}${tbody}</table>`;
}
function normalizeId(x){
  return x.id ?? x._id ?? x.uuid ?? x.id_menu ?? null;
}
function safe(v){ return (v??'')+''; } // to string

/* =================== SOBATPROMO =================== */
async function loadSobatPromo(){
  const box = 'table-sp';
  try{
    const data = await http('GET', `${API.SOBATPROMO}?action=list`);
    const rows = Array.isArray(data)?data: (data?.data || data?.promos || []);
    const mapped = rows.map(x=>({
      id: normalizeId(x),
      title: x.title ?? '',
      description: x.description ?? '',
      valid_until: (x.valid_until??'').toString().substring(0,10),
      _idForEdit: normalizeId(x)
    }));
    renderTable(box,
      [{key:'id',label:'ID'},{key:'title',label:'Judul'},{key:'description',label:'Deskripsi'},{key:'valid_until',label:'Berlaku Sampai'}],
      mapped,
      (row)=>{ // onEdit
        document.getElementById('sp-id').value = row.id||'';
        document.getElementById('sp-title').value = safe(row.title);
        document.getElementById('sp-desc').value = safe(row.description);
        document.getElementById('sp-until').value = row.valid_until || '';
        new bootstrap.Modal(document.getElementById('modal-sp')).show();
      },
      async (row)=>{ // onDelete
        if(!confirm('Hapus promo ini?')) return;
        try{
          await http('DELETE', `${API.SOBATPROMO}?action=delete&id=${row.id}`);
          await loadSobatPromo();
        }catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById(box).innerHTML = `<div class="text-danger">Gagal memuat SobatPromo: ${e.message}</div>`;
  }
}
document.getElementById('form-sp').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id = document.getElementById('sp-id').value;
  const body = {
    title: document.getElementById('sp-title').value,
    description: document.getElementById('sp-desc').value,
    valid_until: document.getElementById('sp-until').value
  };
  try{
    if(id){ await http('POST', `${API.SOBATPROMO}?action=update&id=${id}`, body); }
    else  { await http('POST', `${API.SOBATPROMO}?action=create`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-sp')).hide();
    e.target.reset(); document.getElementById('sp-id').value='';
    await loadSobatPromo();
  }catch(err){ alert(err.message); }
});
function reloadResource(name){
  const map = {
    'sobatpromo': loadSobatPromo,
    'justbuy': loadJustBuy,
    'gadget': loadGadget,
    'krusit': loadKrusit,
    'coffeeshop': loadCoffee,
    'reservasi': loadReservasi,
    'maguru': loadMaguru
  };
  map[name]?.();
}

/* =================== JUSTBUY (contoh /accounts) =================== */
async function loadJustBuy(){
  const box='table-jb';
  try{
    const data = await http('GET', `${API.JUSTBUY}/accounts`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    const mapped = rows.map(u=>({id:normalizeId(u),username:u.username||u.name||'',email:u.email||'',_idForEdit:normalizeId(u)}));
    renderTable(box,
      [{key:'id',label:'ID'},{key:'username',label:'Username'},{key:'email',label:'Email'}],
      mapped,
      (row)=>{
        document.getElementById('jb-id').value=row.id||'';
        document.getElementById('jb-username').value=safe(row.username);
        document.getElementById('jb-email').value=safe(row.email);
        new bootstrap.Modal(document.getElementById('modal-jb')).show();
      },
      async (row)=>{
        if(!confirm('Hapus akun ini?')) return;
        try{ await http('DELETE', `${API.JUSTBUY}/accounts/${row.id}`); await loadJustBuy(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById(box).innerHTML = `<div class="text-danger">Sesuaikan endpoint JustBuy (/accounts). ${e.message}</div>`;
  }
}
document.getElementById('form-jb').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id  = document.getElementById('jb-id').value;
  const body = { username: document.getElementById('jb-username').value, email: document.getElementById('jb-email').value };
  try{
    if(id){ await http('PUT', `${API.JUSTBUY}/accounts/${id}`, body); }
    else  { await http('POST', `${API.JUSTBUY}/accounts`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-jb')).hide();
    e.target.reset(); document.getElementById('jb-id').value='';
    await loadJustBuy();
  }catch(err){ alert(err.message); }
});

/* =================== GADGET HOUSE (contoh /products) =================== */
async function loadGadget(){
  const box='table-gh';
  try{
    const data = await http('GET', `${API.GADGET}/products`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    const mapped = rows.map(x=>({id:normalizeId(x),name:x.name||'',brand:x.brand||'',price:x.price||x.harga||0,_idForEdit:normalizeId(x)}));
    renderTable(box,
      [{key:'id',label:'ID'},{key:'name',label:'Nama'},{key:'brand',label:'Brand'},{key:'price',label:'Harga'}],
      mapped,
      (row)=>{
        document.getElementById('gh-id').value=row.id||'';
        document.getElementById('gh-name').value=safe(row.name);
        document.getElementById('gh-brand').value=safe(row.brand);
        document.getElementById('gh-price').value=row.price||0;
        new bootstrap.Modal(document.getElementById('modal-gh')).show();
      },
      async (row)=>{
        if(!confirm('Hapus produk ini?')) return;
        try{ await http('DELETE', `${API.GADGET}/products/${row.id}`); await loadGadget(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById(box).innerHTML = `<div class="text-danger">Ganti BASE.GADGET ke domain kalian (/products). ${e.message}</div>`;
  }
}
document.getElementById('form-gh').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id = document.getElementById('gh-id').value;
  const body = { name:gh-name.value, brand:gh-brand.value, price:Number(gh-price.value||0) };
  try{
    if(id){ await http('PUT', `${API.GADGET}/products/${id}`, body); }
    else  { await http('POST', `${API.GADGET}/products`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-gh')).hide();
    e.target.reset(); gh-id.value='';
    await loadGadget();
  }catch(err){ alert(err.message); }
});

/* =================== KRUSIT (makanan & minuman) =================== */
async function loadKrusit(){
  // makanan
  try{
    const mk = await http('GET', `${API.KRUSIT}/makanan`);
    const rows = Array.isArray(mk)?mk:(mk?.data||mk||[]);
    const mapped = rows.map(m=>({id:normalizeId(m),nama:m.name||m.nama||'',desc:m.description||m.deskripsi||'',harga:m.price||m.harga||0,_idForEdit:normalizeId(m)}));
    renderTable('table-krm',
      [{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'desc',label:'Deskripsi'},{key:'harga',label:'Harga'}],
      mapped,
      (row)=>{
        krm-id.value=row.id||''; krm-name.value=safe(row.nama); krm-desc.value=safe(row.desc); krm-price.value=row.harga||0;
        new bootstrap.Modal(document.getElementById('modal-krm')).show();
      },
      async (row)=>{
        if(!confirm('Hapus makanan ini?')) return;
        try{ await http('DELETE', `${API.KRUSIT}/makanan/${row.id}`); await loadKrusit(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById('table-krm').innerHTML = `<div class="text-danger">Gagal memuat makanan: ${e.message}</div>`;
  }
  // minuman
  try{
    const mi = await http('GET', `${API.KRUSIT}/minuman`);
    const rows = Array.isArray(mi)?mi:(mi?.data||mi||[]);
    const mapped = rows.map(m=>({id:normalizeId(m),nama:m.name||m.nama||'',desc:m.description||m.deskripsi||'',harga:m.price||m.harga||0,_idForEdit:normalizeId(m)}));
    renderTable('table-kri',
      [{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'desc',label:'Deskripsi'},{key:'harga',label:'Harga'}],
      mapped,
      (row)=>{
        kri-id.value=row.id||''; kri-name.value=safe(row.nama); kri-desc.value=safe(row.desc); kri-price.value=row.harga||0;
        new bootstrap.Modal(document.getElementById('modal-kri')).show();
      },
      async (row)=>{
        if(!confirm('Hapus minuman ini?')) return;
        try{ await http('DELETE', `${API.KRUSIT}/minuman/${row.id}`); await loadKrusit(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById('table-kri').innerHTML = `<div class="text-danger">Gagal memuat minuman: ${e.message}</div>`;
  }
}
document.getElementById('form-krm').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id = krm-id.value;
  const body={ name:krm-name.value, description:krm-desc.value, price:Number(krm-price.value||0) };
  try{
    if(id){ await http('PUT', `${API.KRUSIT}/makanan/${id}`, body); }
    else  { await http('POST', `${API.KRUSIT}/makanan`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-krm')).hide();
    e.target.reset(); krm-id.value=''; await loadKrusit();
  }catch(err){ alert(err.message); }
});
document.getElementById('form-kri').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id = kri-id.value;
  const body={ name:kri-name.value, description:kri-desc.value, price:Number(kri-price.value||0) };
  try{
    if(id){ await http('PUT', `${API.KRUSIT}/minuman/${id}`, body); }
    else  { await http('POST', `${API.KRUSIT}/minuman`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-kri')).hide();
    e.target.reset(); kri-id.value=''; await loadKrusit();
  }catch(err){ alert(err.message); }
});

/* =================== COFFEESHOP (kopi & nonkopi) =================== */
async function loadCoffee(){
  // kopi
  try{
    const kop = await http('GET', `${API.COFFEE}/kopi`);
    const rows = Array.isArray(kop)?kop:(kop?.data||kop||[]);
    const mapped = rows.map(m=>({id:normalizeId(m),nama:m.name||'',desc:m.description||'',harga:m.price||0,_idForEdit:normalizeId(m)}));
    renderTable('table-ck',
      [{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'desc',label:'Deskripsi'},{key:'harga',label:'Harga'}],
      mapped,
      (row)=>{
        ck-id.value=row.id||''; ck-name.value=safe(row.nama); ck-desc.value=safe(row.desc); ck-price.value=row.harga||0;
        new bootstrap.Modal(document.getElementById('modal-ck')).show();
      },
      async (row)=>{
        if(!confirm('Hapus kopi ini?')) return;
        try{ await http('DELETE', `${API.COFFEE}/kopi/${row.id}`); await loadCoffee(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById('table-ck').innerHTML = `<div class="text-danger">Gagal memuat kopi: ${e.message}</div>`;
  }
  // nonkopi
  try{
    const nk = await http('GET', `${API.COFFEE}/nonkopi`);
    const rows = Array.isArray(nk)?nk:(nk?.data||nk||[]);
    const mapped = rows.map(m=>({id:normalizeId(m),nama:m.name||'',desc:m.description||'',harga:m.price||0,_idForEdit:normalizeId(m)}));
    renderTable('table-cn',
      [{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'desc',label:'Deskripsi'},{key:'harga',label:'Harga'}],
      mapped,
      (row)=>{
        cn-id.value=row.id||''; cn-name.value=safe(row.nama); cn-desc.value=safe(row.desc); cn-price.value=row.harga||0;
        new bootstrap.Modal(document.getElementById('modal-cn')).show();
      },
      async (row)=>{
        if(!confirm('Hapus menu ini?')) return;
        try{ await http('DELETE', `${API.COFFEE}/nonkopi/${row.id}`); await loadCoffee(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById('table-cn').innerHTML = `<div class="text-danger">Gagal memuat nonkopi: ${e.message}</div>`;
  }
}
document.getElementById('form-ck').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id = ck-id.value;
  const body={ name:ck-name.value, description:ck-desc.value, price:Number(ck-price.value||0) };
  try{
    if(id){ await http('PUT', `${API.COFFEE}/kopi/${id}`, body); }
    else  { await http('POST', `${API.COFFEE}/kopi`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-ck')).hide();
    e.target.reset(); ck-id.value=''; await loadCoffee();
  }catch(err){ alert(err.message); }
});
document.getElementById('form-cn').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id = cn-id.value;
  const body={ name:cn-name.value, description:cn-desc.value, price:Number(cn-price.value||0) };
  try{
    if(id){ await http('PUT', `${API.COFFEE}/nonkopi/${id}`, body); }
    else  { await http('POST', `${API.COFFEE}/nonkopi`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-cn')).hide();
    e.target.reset(); cn-id.value=''; await loadCoffee();
  }catch(err){ alert(err.message); }
});

/* =================== RESERVASI =================== */
async function loadReservasi(){
  const box='table-rv';
  try{
    const data = await http('GET', `${API.RESERVASI}/reservasi`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    const mapped = rows.map(x=>({id:normalizeId(x),nama:x.name||x.nama||'',telp:x.phone||x.telepon||'',waktu:x.datetime||x.waktu||'',_idForEdit:normalizeId(x)}));
    renderTable(box,
      [{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'telp',label:'Telepon'},{key:'waktu',label:'Waktu'}],
      mapped,
      (row)=>{
        rv-id.value=row.id||''; rv-nama.value=safe(row.nama); rv-telp.value=safe(row.telp);
        rv-waktu.value=(row.waktu||'').toString().replace(' ','T');
        new bootstrap.Modal(document.getElementById('modal-rv')).show();
      },
      async (row)=>{
        if(!confirm('Hapus reservasi ini?')) return;
        try{ await http('DELETE', `${API.RESERVASI}/reservasi/${row.id}`); await loadReservasi(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById(box).innerHTML = `<div class="text-danger">Ganti BASE.RESERVASI ke endpoint kalian (/reservasi). ${e.message}</div>`;
  }
}
document.getElementById('form-rv').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const id = rv-id.value;
  const body={ name:rv-nama.value, phone:rv-telp.value, datetime:rv-waktu.value.replace('T',' ') };
  try{
    if(id){ await http('PUT', `${API.RESERVASI}/reservasi/${id}`, body); }
    else  { await http('POST', `${API.RESERVASI}/reservasi`, body); }
    bootstrap.Modal.getInstance(document.getElementById('modal-rv')).hide();
    e.target.reset(); rv-id.value=''; await loadReservasi();
  }catch(err){ alert(err.message); }
});

/* =================== MAGURU (products & categories) =================== */
async function loadMaguru(){
  // products
  try{
    const p = await http('GET', `${API.MAGURU}/products`);
    const rows = Array.isArray(p)?p:(p?.data||p||[]);
    const mapped = rows.map(m=>({id:normalizeId(m),nama:m.name||'',desc:m.description||'',harga:m.price||0,_idForEdit:normalizeId(m)}));
    renderTable('table-mgp',
      [{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'desc',label:'Deskripsi'},{key:'harga',label:'Harga'}],
      mapped,
      (row)=>{
        mgp-id.value=row.id||''; mgp-name.value=safe(row.nama); mgp-desc.value=safe(row.desc); mgp-price.value=row.harga||0;
        new bootstrap.Modal(document.getElementById('modal-mgp')).show();
      },
      async (row)=>{
        if(!confirm('Hapus product ini?')) return;
        try{ await http('DELETE', `${API.MAGURU}/products/${row.id}`); await loadMaguru(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById('table-mgp').innerHTML = `<div class="text-danger">Maguru Products belum aktif: ${e.message}</div>`;
  }
  // categories
  try{
    const c = await http('GET', `${API.MAGURU}/categories`);
    const rows = Array.isArray(c)?c:(c?.data||c||[]);
    const mapped = rows.map(x=>({id:normalizeId(x),nama:x.name||'',slug:x.slug||'',_idForEdit:normalizeId(x)}));
    renderTable('table-mgc',
      [{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'slug',label:'Slug'}],
      mapped,
      (row)=>{
        mgc-id.value=row.id||''; mgc-name.value=safe(row.nama); mgc-slug.value=safe(row.slug);
        new bootstrap.Modal(document.getElementById('modal-mgc')).show();
      },
      async (row)=>{
        if(!confirm('Hapus category ini?')) return;
        try{ await http('DELETE', `${API.MAGURU}/categories/${row.id}`); await loadMaguru(); }
        catch(e){ alert(e.message); }
      }
    );
  }catch(e){
    document.getElementById('table-mgc').innerHTML = `<div class="text-danger">Maguru Categories belum aktif: ${e.message}</div>`;
  }
}

/* =================== OPEN CREATE (kosongkan form) =================== */
function openCreate(key){
  const map = {
    'sobatpromo': ()=>{ sp-id.value=''; sp-title.value=''; sp-desc.value=''; sp-until.value=''; },
    'justbuy': ()=>{ jb-id.value=''; jb-username.value=''; jb-email.value=''; },
    'gadget': ()=>{ gh-id.value=''; gh-name.value=''; gh-brand.value=''; gh-price.value=''; },
    'krusit-makanan': ()=>{ krm-id.value=''; krm-name.value=''; krm-desc.value=''; krm-price.value=''; },
    'krusit-minuman': ()=>{ kri-id.value=''; kri-name.value=''; kri-desc.value=''; kri-price.value=''; },
    'cs-kopi': ()=>{ ck-id.value=''; ck-name.value=''; ck-desc.value=''; ck-price.value=''; },
    'cs-nonkopi': ()=>{ cn-id.value=''; cn-name.value=''; cn-desc.value=''; cn-price.value=''; },
    'reservasi': ()=>{ rv-id.value=''; rv-nama.value=''; rv-telp.value=''; rv-waktu.value=''; },
    'mg-products': ()=>{ mgp-id.value=''; mgp-name.value=''; mgp-desc.value=''; mgp-price.value=''; },
    'mg-categories': ()=>{ mgc-id.value=''; mgc-name.value=''; mgc-slug.value=''; },
  }; map[key]?.();
}

/* =================== INIT =================== */
document.addEventListener('DOMContentLoaded', ()=>{
  loadSobatPromo();
  loadJustBuy();
  loadGadget();
  loadKrusit();
  loadCoffee();
  loadReservasi();
  loadMaguru();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
