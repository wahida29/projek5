<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>☕ Dashboard CRUD API</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root{--brown:#5c4033;--brown-dark:#3e2723;}
    body{background:#f8f9fa;font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial}
    h1{color:var(--brown-dark);font-weight:800}
    .card{border-radius:14px;box-shadow:0 6px 18px rgba(0,0,0,.06)}
    .table thead th{background:var(--brown-dark);color:#fff;white-space:nowrap}
    .nav-tabs .nav-link.active{background:var(--brown-dark);color:#fff;border:none}
    .nav-tabs .nav-link{color:var(--brown-dark)}
    .btn-brown{background:var(--brown);color:#fff;border:none}
    .btn-brown:hover{background:#4e372c}
    .muted{color:#6c757d}
    .spin{opacity:.7}
    .form-section .card-header{background:var(--brown);color:#fff}
    .badge-endpoint{font-size:.75rem;background:#eef;border:1px solid #dde;color:#334;padding:.2rem .5rem;border-radius:.4rem}
  </style>
</head>
<body>
<div class="container py-5">

  <h1 class="text-center mb-4"><i class="bi bi-database-gear"></i> Dashboard CRUD API</h1>
  <p class="text-center muted mb-4">
    <span class="badge-endpoint">Catatan: ganti BASE_URL pada bagian <b>Konfigurasi</b> bila perlu</span>
  </p>

  <!-- ============ Konfigurasi endpoint (ubah di sini jika perlu) ============ -->
  <script>
    // ✅ Yang SUDAH benar dari koleksi kamu:
    const BASE = {
      SOBAT_PROMO : "https://sobatpromo-api-production.up.railway.app/api.php", // asumsi actions via query ?action=
      JUSTBUY      : "https://projekkelompok9-production.up.railway.app/api",   // ganti sesuai koleksi final kalian
      GADGET       : "https://your-gadget-house-api.example.com/api",           // TODO: ganti (dari koleksi)
      KRUSIT       : "https://projekkelompok4-production-3d9b.up.railway.app/api",
      COFFEESHOP   : "https://projek5-production.up.railway.app/api",
      RESERVASI    : "https://your-reservasi-api.example.com/api",              // TODO: ganti (dari koleksi)
      MAGURU       : "http://localhost:3001/api/public"                         // ganti jika sudah di-host
    };
  </script>
  <!-- ====================================================================== -->

  <!-- Tabs -->
  <ul class="nav nav-tabs mb-3 justify-content-center">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab1">SobatPromo</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab2">JustBuy</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab3">Gadget House</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab4">Krusit</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab5">CoffeeShop</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab6">Reservasi</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab7">Maguru</a></li>
  </ul>

  <div id="alertBox" class="alert d-none" role="alert"></div>

  <div class="tab-content">

    <!-- =================== SOBATPROMO =================== -->
    <div class="tab-pane fade show active" id="tab1">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">SobatPromo <span class="badge-endpoint" id="ep1"></span></h4>
        <button class="btn btn-outline-secondary btn-sm" id="reload1"><i class="bi bi-arrow-clockwise"></i> Reload</button>
      </div>

      <div class="card form-section mb-3">
        <div class="card-header">Tambah / Update Promo</div>
        <div class="card-body">
          <form id="form1" class="row g-2">
            <div class="col-md-3"><input class="form-control" id="p1_title" placeholder="Judul" required></div>
            <div class="col-md-4"><input class="form-control" id="p1_desc" placeholder="Deskripsi" required></div>
            <div class="col-md-3"><input type="date" class="form-control" id="p1_until" required></div>
            <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-plus-circle"></i> Simpan</button></div>
            <div class="col-12">
              <small class="muted">Untuk Update, pilih baris → otomatis isi form → klik Simpan (asumsi action=update).</small>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered align-middle text-center" id="tbl1">
              <thead><tr><th>#</th><th>Judul</th><th>Deskripsi</th><th>Berlaku Sampai</th><th>Aksi</th></tr></thead>
              <tbody><tr><td colspan="5" class="muted">Memuat...</td></tr></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- =================== JUSTBUY =================== -->
    <div class="tab-pane fade" id="tab2">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">JustBuy <span class="badge-endpoint" id="ep2"></span></h4>
        <button class="btn btn-outline-secondary btn-sm" id="reload2"><i class="bi bi-arrow-clockwise"></i> Reload</button>
      </div>

      <div class="card form-section mb-3">
        <div class="card-header">Aksi (contoh: akun ML)</div>
        <div class="card-body">
          <form id="form2" class="row g-2">
            <div class="col-md-3"><input class="form-control" id="j_username" placeholder="Username"></div>
            <div class="col-md-3"><input class="form-control" id="j_email" placeholder="Email"></div>
            <div class="col-md-3"><input class="form-control" id="j_id" placeholder="ID (untuk edit/hapus)"></div>
            <div class="col-md-3 d-grid">
              <div class="btn-group">
                <button class="btn btn-success" type="button" id="j_add"><i class="bi bi-plus-lg"></i></button>
                <button class="btn btn-warning" type="button" id="j_edit"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" type="button" id="j_del"><i class="bi bi-trash3"></i></button>
              </div>
            </div>
            <div class="col-12"><small class="muted">Sesuaikan endpoint di konfigurasi JUSTBUY (collection kamu mengandung beberapa skrip PHP).</small></div>
          </form>
        </div>
      </div>

      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center" id="tbl2">
            <thead><tr><th>#</th><th>Username</th><th>Email</th><th>Aksi</th></tr></thead>
            <tbody><tr><td colspan="4" class="muted">Memuat / menunggu endpoint final…</td></tr></tbody>
          </table>
        </div>
      </div></div>
    </div>

    <!-- =================== GADGET HOUSE =================== -->
    <div class="tab-pane fade" id="tab3">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Gadget House <span class="badge-endpoint" id="ep3"></span></h4>
        <button class="btn btn-outline-secondary btn-sm" id="reload3"><i class="bi bi-arrow-clockwise"></i> Reload</button>
      </div>

      <div class="card form-section mb-3">
        <div class="card-header">Tambah / Update Produk</div>
        <div class="card-body">
          <form id="form3" class="row g-2">
            <div class="col-md-3"><input class="form-control" id="g_name" placeholder="Nama Produk"></div>
            <div class="col-md-3"><input class="form-control" id="g_brand" placeholder="Brand"></div>
            <div class="col-md-2"><input type="number" class="form-control" id="g_price" placeholder="Harga"></div>
            <div class="col-md-2"><input class="form-control" id="g_id" placeholder="ID (edit/hapus)"></div>
            <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-save"></i> Simpan</button></div>
            <div class="col-12"><small class="muted">Ganti BASE.GADGET agar CRUD aktif (GET /products, POST /products, PUT/DELETE /products/{id}).</small></div>
          </form>
        </div>
      </div>

      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center" id="tbl3">
            <thead><tr><th>#</th><th>Nama</th><th>Brand</th><th>Harga</th><th>Aksi</th></tr></thead>
            <tbody><tr><td colspan="5" class="muted">Menunggu endpoint…</td></tr></tbody>
          </table>
        </div>
      </div></div>
    </div>

    <!-- =================== KRUSIT (Makanan/Minuman) =================== -->
    <div class="tab-pane fade" id="tab4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Krusit <span class="badge-endpoint" id="ep4"></span></h4>
        <button class="btn btn-outline-secondary btn-sm" id="reload4"><i class="bi bi-arrow-clockwise"></i> Reload</button>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Makanan</div>
            <div class="card-body">
              <form id="form4a" class="row g-2">
                <div class="col-md-4"><input class="form-control" id="km_name" placeholder="Nama" required></div>
                <div class="col-md-4"><input class="form-control" id="km_desc" placeholder="Deskripsi" required></div>
                <div class="col-md-2"><input type="number" class="form-control" id="km_price" placeholder="Harga" required></div>
                <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-plus-circle"></i> Tambah</button></div>
              </form>
            </div>
          </div>

          <div class="card"><div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center" id="tbl4a">
                <thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead>
                <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
              </table>
            </div>
          </div></div>
        </div>

        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Minuman</div>
            <div class="card-body">
              <form id="form4b" class="row g-2">
                <div class="col-md-4"><input class="form-control" id="kmi_name" placeholder="Nama" required></div>
                <div class="col-md-4"><input class="form-control" id="kmi_desc" placeholder="Deskripsi" required></div>
                <div class="col-md-2"><input type="number" class="form-control" id="kmi_price" placeholder="Harga" required></div>
                <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-plus-circle"></i> Tambah</button></div>
              </form>
            </div>
          </div>

          <div class="card"><div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center" id="tbl4b">
                <thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead>
                <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
              </table>
            </div>
          </div></div>
        </div>
      </div>
    </div>

    <!-- =================== COFFEESHOP (Kopi/NonKopi) =================== -->
    <div class="tab-pane fade" id="tab5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">CoffeeShop <span class="badge-endpoint" id="ep5"></span></h4>
        <button class="btn btn-outline-secondary btn-sm" id="reload5"><i class="bi bi-arrow-clockwise"></i> Reload</button>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Kopi</div>
            <div class="card-body">
              <form id="form5a" class="row g-2">
                <div class="col-md-4"><input class="form-control" id="ck_name" placeholder="Nama" required></div>
                <div class="col-md-4"><input class="form-control" id="ck_desc" placeholder="Deskripsi" required></div>
                <div class="col-md-2"><input type="number" class="form-control" id="ck_price" placeholder="Harga" required></div>
                <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-plus-circle"></i> Tambah</button></div>
              </form>
            </div>
          </div>

          <div class="card"><div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center" id="tbl5a">
                <thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead>
                <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
              </table>
            </div>
          </div></div>
        </div>

        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">NonKopi</div>
            <div class="card-body">
              <form id="form5b" class="row g-2">
                <div class="col-md-4"><input class="form-control" id="cn_name" placeholder="Nama" required></div>
                <div class="col-md-4"><input class="form-control" id="cn_desc" placeholder="Deskripsi" required></div>
                <div class="col-md-2"><input type="number" class="form-control" id="cn_price" placeholder="Harga" required></div>
                <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-plus-circle"></i> Tambah</button></div>
              </form>
            </div>
          </div>

          <div class="card"><div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center" id="tbl5b">
                <thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead>
                <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
              </table>
            </div>
          </div></div>
        </div>
      </div>
    </div>

    <!-- =================== RESERVASI =================== -->
    <div class="tab-pane fade" id="tab6">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Reservasi <span class="badge-endpoint" id="ep6"></span></h4>
        <button class="btn btn-outline-secondary btn-sm" id="reload6"><i class="bi bi-arrow-clockwise"></i> Reload</button>
      </div>

      <div class="card form-section mb-3">
        <div class="card-header">Tambah / Update Reservasi</div>
        <div class="card-body">
          <form id="form6" class="row g-2">
            <div class="col-md-3"><input class="form-control" id="r_nama" placeholder="Nama"></div>
            <div class="col-md-3"><input class="form-control" id="r_telp" placeholder="Telepon"></div>
            <div class="col-md-3"><input type="datetime-local" class="form-control" id="r_waktu"></div>
            <div class="col-md-3 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-save"></i> Simpan</button></div>
            <div class="col-12"><small class="muted">Isi BASE.RESERVASI agar aktif (GET /reservasi, POST /reservasi, PUT/DELETE /reservasi/{id}).</small></div>
          </form>
        </div>
      </div>

      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center" id="tbl6">
            <thead><tr><th>ID</th><th>Nama</th><th>Telepon</th><th>Waktu</th><th>Aksi</th></tr></thead>
            <tbody><tr><td colspan="5" class="muted">Menunggu endpoint…</td></tr></tbody>
          </table>
        </div>
      </div></div>
    </div>

    <!-- =================== MAGURU (products & categories) =================== -->
    <div class="tab-pane fade" id="tab7">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Maguru <span class="badge-endpoint" id="ep7"></span></h4>
        <button class="btn btn-outline-secondary btn-sm" id="reload7"><i class="bi bi-arrow-clockwise"></i> Reload</button>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Products</div>
            <div class="card-body">
              <form id="form7a" class="row g-2">
                <div class="col-md-4"><input class="form-control" id="mp_name" placeholder="Nama"></div>
                <div class="col-md-4"><input class="form-control" id="mp_desc" placeholder="Deskripsi"></div>
                <div class="col-md-2"><input type="number" class="form-control" id="mp_price" placeholder="Harga"></div>
                <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-plus-circle"></i> Tambah</button></div>
              </form>
            </div>
          </div>
          <div class="card"><div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center" id="tbl7a">
                <thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead>
                <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
              </table>
            </div>
          </div></div>
        </div>

        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Categories</div>
            <div class="card-body">
              <form id="form7b" class="row g-2">
                <div class="col-md-6"><input class="form-control" id="mc_name" placeholder="Nama Kategori"></div>
                <div class="col-md-4"><input class="form-control" id="mc_slug" placeholder="Slug"></div>
                <div class="col-md-2 d-grid"><button class="btn btn-brown" type="submit"><i class="bi bi-plus-circle"></i> Tambah</button></div>
              </form>
            </div>
          </div>
          <div class="card"><div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered align-middle text-center" id="tbl7b">
                <thead><tr><th>ID</th><th>Nama</th><th>Slug</th><th>Aksi</th></tr></thead>
                <tbody><tr><td colspan="4" class="muted">Memuat…</td></tr></tbody>
              </table>
            </div>
          </div></div>
        </div>
      </div>
    </div>
    <!-- ================================================== -->

  </div><!-- /.tab-content -->
</div><!-- /.container -->

<script>
/* ======================== UTIL ======================== */
const alertBox = document.getElementById('alertBox');
function notify(type, msg){
  alertBox.className = `alert alert-${type}`;
  alertBox.textContent = msg;
  alertBox.classList.remove('d-none');
  setTimeout(()=>alertBox.classList.add('d-none'), 2500);
}
async function api(method, url, body=null){
  const opt = { method, headers:{'Content-Type':'application/json'} };
  if(body) opt.body = JSON.stringify(body);
  const res = await fetch(url, opt);
  if(!res.ok) throw new Error(`${res.status} ${res.statusText}`);
  const ct = res.headers.get('content-type')||'';
  return ct.includes('application/json') ? res.json() : res.text();
}
function fillEndpointBadges(){
  ep1.textContent = BASE.SOBAT_PROMO;
  ep2.textContent = BASE.JUSTBUY;
  ep3.textContent = BASE.GADGET;
  ep4.textContent = BASE.KRUSIT;
  ep5.textContent = BASE.COFFEESHOP;
  ep6.textContent = BASE.RESERVASI;
  ep7.textContent = BASE.MAGURU;
}
fillEndpointBadges();
/* ====================================================== */

/* ===================== SOBATPROMO ===================== */
// asumsi pola: ?action=list|create|update|delete, payload via JSON
let sp_editId = null;
async function loadSp(){
  const url = `${BASE.SOBAT_PROMO}?action=list`;
  try{
    const data = await api('GET', url);
    const rows = Array.isArray(data) ? data : (data?.data || []);
    tbl1.querySelector('tbody').innerHTML = rows.length ? rows.map((p,i)=>`
      <tr>
        <td>${i+1}</td>
        <td>${p.title||''}</td>
        <td>${p.description||''}</td>
        <td>${p.valid_until||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='spStartEdit(${p.id||i},"${(p.title||"").replace(/"/g,"&quot;")}','${(p.description||"").replace(/"/g,"&quot;")}','${p.valid_until||""}')><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='spDelete(${p.id||i})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl1.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal memuat: ${e.message}</td></tr>`;
  }
}
function spStartEdit(id,title,desc,until){
  sp_editId = id;
  p1_title.value = title; p1_desc.value = desc; p1_until.value = (until||"").substring(0,10);
}
async function spDelete(id){
  if(!confirm("Hapus promo ini?")) return;
  try{
    await api('POST', `${BASE.SOBAT_PROMO}?action=delete&id=${id}`);
    notify('success','Promo dihapus'); loadSp();
  }catch(e){ notify('danger', e.message); }
}
form1.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const payload = { title:p1_title.value, description:p1_desc.value, valid_until:p1_until.value };
  const action = sp_editId==null ? 'create' : `update&id=${sp_editId}`;
  try{
    await api('POST', `${BASE.SOBAT_PROMO}?action=${action}`, payload);
    sp_editId=null; form1.reset(); notify('success','Tersimpan'); loadSp();
  }catch(err){ notify('danger', err.message); }
});
reload1.addEventListener('click', loadSp);

/* ======================= JUSTBUY ====================== */
// NOTE: isi sesuai PHP API kalian. Di sini hanya kerangka agar tabel hidup.
async function loadJustBuy(){
  try{
    // contoh GET semua akun:
    const data = await api('GET', `${BASE.JUSTBUY}/accounts`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    tbl2.querySelector('tbody').innerHTML = rows.length ? rows.map((u,i)=>`
      <tr>
        <td>${i+1}</td><td>${u.username||''}</td><td>${u.email||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='jbEdit("${u.id}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='jbDel("${u.id}")'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="4" class="muted">Belum ada data</td></tr>`;
  }catch(e){
    tbl2.querySelector('tbody').innerHTML = `<tr><td colspan="4" class="text-danger">Sesuaikan endpoint JUSTBUY (lihat koleksi). ${e.message}</td></tr>`;
  }
}
async function jbEdit(id){
  j_id.value = id;
  notify('info','Mode edit: isi form lalu klik tombol kuning.');
}
j_add.addEventListener('click', async ()=>{
  try{
    await api('POST', `${BASE.JUSTBUY}/accounts`, {username:j_username.value,email:j_email.value});
    notify('success','Ditambahkan'); loadJustBuy(); form2.reset();
  }catch(e){ notify('danger', e.message); }
});
j_edit.addEventListener('click', async ()=>{
  if(!j_id.value) return notify('warning','Isi ID dulu');
  try{
    await api('PUT', `${BASE.JUSTBUY}/accounts/${j_id.value}`, {username:j_username.value,email:j_email.value});
    notify('success','Diubah'); loadJustBuy(); form2.reset();
  }catch(e){ notify('danger', e.message); }
});
j_del.addEventListener('click', async ()=>{
  if(!j_id.value) return notify('warning','Isi ID dulu');
  if(!confirm('Hapus data ini?')) return;
  try{
    await api('DELETE', `${BASE.JUSTBUY}/accounts/${j_id.value}`);
    notify('success','Dihapus'); loadJustBuy(); form2.reset();
  }catch(e){ notify('danger', e.message); }
});
reload2.addEventListener('click', loadJustBuy);

/* ===================== GADGET HOUSE =================== */
async function loadGadget(){
  try{
    const data = await api('GET', `${BASE.GADGET}/products`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    tbl3.querySelector('tbody').innerHTML = rows.length ? rows.map((x,i)=>`
      <tr>
        <td>${x.id||i+1}</td><td>${x.name||''}</td><td>${x.brand||''}</td><td>${x.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='gStart("${x.id}","${(x.name||"").replace(/"/g,"&quot;")}","${(x.brand||"").replace(/"/g,"&quot;")}","${x.price||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='gDel("${x.id}")'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Belum ada data</td></tr>`;
  }catch(e){
    tbl3.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Ganti BASE.GADGET agar aktif. ${e.message}</td></tr>`;
  }
}
function gStart(id,name,brand,price){ g_id.value=id; g_name.value=name; g_brand.value=brand; g_price.value=price; }
form3.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body= { name:g_name.value, brand:g_brand.value, price:Number(g_price.value||0) };
  try{
    if(g_id.value) await api('PUT', `${BASE.GADGET}/products/${g_id.value}`, body);
    else await api('POST', `${BASE.GADGET}/products`, body);
    notify('success','Tersimpan'); g_id.value=''; form3.reset(); loadGadget();
  }catch(err){ notify('danger', err.message); }
});
async function gDel(id){
  if(!confirm('Hapus data?')) return;
  try{ await api('DELETE', `${BASE.GADGET}/products/${id}`); notify('success','Dihapus'); loadGadget(); }
  catch(e){ notify('danger', e.message); }
}
reload3.addEventListener('click', loadGadget);

/* ========================= KRUSIT ===================== */
async function loadKrusit(){
  // makanan
  try{
    const mk = await api('GET', `${BASE.KRUSIT}/makanan`);
    const rows = Array.isArray(mk)?mk:(mk?.data||mk||[]);
    tbl4a.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||m.nama||''}</td><td>${m.description||m.deskripsi||''}</td><td>${m.price||m.harga||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='kEdit("makanan",${m.id},"${(m.name||m.nama||"").replace(/"/g,"&quot;")}','${(m.description||m.deskripsi||"").replace(/"/g,"&quot;")}','${m.price||m.harga||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='kDel("makanan",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl4a.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }

  // minuman
  try{
    const mi = await api('GET', `${BASE.KRUSIT}/minuman`);
    const rows = Array.isArray(mi)?mi:(mi?.data||mi||[]);
    tbl4b.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||m.nama||''}</td><td>${m.description||m.deskripsi||''}</td><td>${m.price||m.harga||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='kEdit("minuman",${m.id},"${(m.name||m.nama||"").replace(/"/g,"&quot;")}','${(m.description||m.deskripsi||"").replace(/"/g,"&quot;")}','${m.price||m.harga||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='kDel("minuman",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl4b.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }
}
form4a.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body = { name: km_name.value, description: km_desc.value, price: Number(km_price.value||0) };
  try{ await api('POST', `${BASE.KRUSIT}/makanan`, body); notify('success','Makanan ditambah'); form4a.reset(); loadKrusit(); }
  catch(err){ notify('danger', err.message); }
});
form4b.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body = { name: kmi_name.value, description: kmi_desc.value, price: Number(kmi_price.value||0) };
  try{ await api('POST', `${BASE.KRUSIT}/minuman`, body); notify('success','Minuman ditambah'); form4b.reset(); loadKrusit(); }
  catch(err){ notify('danger', err.message); }
});
async function kEdit(cat,id,name,desc,price){
  const newName = prompt('Nama', name); if(newName===null) return;
  const newDesc = prompt('Deskripsi', desc); if(newDesc===null) return;
  const newPrice= prompt('Harga', price); if(newPrice===null) return;
  try{ await api('PUT', `${BASE.KRUSIT}/${cat}/${id}`, {name:newName,description:newDesc,price:Number(newPrice||0)}); notify('success','Diubah'); loadKrusit(); }
  catch(e){ notify('danger', e.message); }
}
async function kDel(cat,id){
  if(!confirm('Hapus data?')) return;
  try{ await api('DELETE', `${BASE.KRUSIT}/${cat}/${id}`); notify('success','Dihapus'); loadKrusit(); }
  catch(e){ notify('danger', e.message); }
}
reload4.addEventListener('click', loadKrusit);

/* ======================= COFFEESHOP =================== */
async function loadCoffee(){
  // kopi
  try{
    const kopi = await api('GET', `${BASE.COFFEESHOP}/kopi`);
    const rows = Array.isArray(kopi)?kopi:(kopi?.data||kopi||[]);
    tbl5a.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||''}</td><td>${m.description||''}</td><td>${m.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='cEdit("kopi",${m.id},"${(m.name||"").replace(/"/g,"&quot;")}','${(m.description||"").replace(/"/g,"&quot;")}','${m.price||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='cDel("kopi",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl5a.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }

  // nonkopi
  try{
    const non = await api('GET', `${BASE.COFFEESHOP}/nonkopi`);
    const rows = Array.isArray(non)?non:(non?.data||non||[]);
    tbl5b.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||''}</td><td>${m.description||''}</td><td>${m.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='cEdit("nonkopi",${m.id},"${(m.name||"").replace(/"/g,"&quot;")}','${(m.description||"").replace(/"/g,"&quot;")}','${m.price||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='cDel("nonkopi",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl5b.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }
}
form5a.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body = { name: ck_name.value, description: ck_desc.value, price: Number(ck_price.value||0) };
  try{ await api('POST', `${BASE.COFFEESHOP}/kopi`, body); notify('success','Kopi ditambah'); form5a.reset(); loadCoffee(); }
  catch(err){ notify('danger', err.message); }
});
form5b.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body = { name: cn_name.value, description: cn_desc.value, price: Number(cn_price.value||0) };
  try{ await api('POST', `${BASE.COFFEESHOP}/nonkopi`, body); notify('success','NonKopi ditambah'); form5b.reset(); loadCoffee(); }
  catch(err){ notify('danger', err.message); }
});
async function cEdit(cat,id,name,desc,price){
  const newName = prompt('Nama', name); if(newName===null) return;
  const newDesc = prompt('Deskripsi', desc); if(newDesc===null) return;
  const newPrice= prompt('Harga', price); if(newPrice===null) return;
  try{ await api('PUT', `${BASE.COFFEESHOP}/${cat}/${id}`, {name:newName,description:newDesc,price:Number(newPrice||0)}); notify('success','Diubah'); loadCoffee(); }
  catch(e){ notify('danger', e.message); }
}
async function cDel(cat,id){
  if(!confirm('Hapus data?')) return;
  try{ await api('DELETE', `${BASE.COFFEESHOP}/${cat}/${id}`); notify('success','Dihapus'); loadCoffee(); }
  catch(e){ notify('danger', e.message); }
}
reload5.addEventListener('click', loadCoffee);

/* ======================= RESERVASI ==================== */
async function loadReservasi(){
  try{
    const data = await api('GET', `${BASE.RESERVASI}/reservasi`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    tbl6.querySelector('tbody').innerHTML = rows.length ? rows.map(x=>`
      <tr>
        <td>${x.id}</td><td>${x.name||x.nama||''}</td><td>${x.phone||x.telepon||''}</td><td>${x.datetime||x.waktu||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='rEdit(${x.id},"${(x.name||x.nama||"").replace(/"/g,"&quot;")}','${(x.phone||x.telepon||"").replace(/"/g,"&quot;")}','${x.datetime||x.waktu||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='rDel(${x.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl6.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Ganti BASE.RESERVASI agar aktif. ${e.message}</td></tr>`;
  }
}
form6.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:r_nama.value, phone:r_telp.value, datetime:r_waktu.value };
  try{
    await api('POST', `${BASE.RESERVASI}/reservasi`, body);
    notify('success','Reservasi disimpan'); form6.reset(); loadReservasi();
  }catch(err){ notify('danger', err.message); }
});
async function rEdit(id,nama,telp,waktu){
  const n = prompt('Nama', nama); if(n===null) return;
  const t = prompt('Telepon', telp); if(t===null) return;
  const w = prompt('Waktu (YYYY-MM-DD HH:mm)', waktu); if(w===null) return;
  try{ await api('PUT', `${BASE.RESERVASI}/reservasi/${id}`, {name:n,phone:t,datetime:w}); notify('success','Diubah'); loadReservasi(); }
  catch(e){ notify('danger', e.message); }
}
async function rDel(id){
  if(!confirm('Hapus reservasi?')) return;
  try{ await api('DELETE', `${BASE.RESERVASI}/reservasi/${id}`); notify('success','Dihapus'); loadReservasi(); }
  catch(e){ notify('danger', e.message); }
}
reload6.addEventListener('click', loadReservasi);

/* ========================== MAGURU ==================== */
async function loadMaguru(){
  // products
  try{
    const p = await api('GET', `${BASE.MAGURU}/products`);
    const rows = Array.isArray(p)?p:(p?.data||p||[]);
    tbl7a.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||''}</td><td>${m.description||''}</td><td>${m.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='mPEdit(${m.id},"${(m.name||"").replace(/"/g,"&quot;")}','${(m.description||"").replace(/"/g,"&quot;")}','${m.price||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='mPDel(${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl7a.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Maguru belum aktif / bukan localhost. ${e.message}</td></tr>`;
  }

  // categories
  try{
    const c = await api('GET', `${BASE.MAGURU}/categories`);
    const rows = Array.isArray(c)?c:(c?.data||c||[]);
    tbl7b.querySelector('tbody').innerHTML = rows.length ? rows.map(x=>`
      <tr>
        <td>${x.id}</td><td>${x.name||''}</td><td>${x.slug||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='mCEdit(${x.id},"${(x.name||"").replace(/"/g,"&quot;")}','${(x.slug||"").replace(/"/g,"&quot;")}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='mCDel(${x.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="4" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl7b.querySelector('tbody').innerHTML = `<tr><td colspan="4" class="text-danger">Maguru belum aktif / bukan localhost. ${e.message}</td></tr>`;
  }
}
form7a.addEventListener('submit', async (e)=>{
  e.preventDefault();
  try{
    await api('POST', `${BASE.MAGURU}/products`, {name:mp_name.value, description:mp_desc.value, price:Number(mp_price.value||0)});
    notify('success','Product ditambah'); form7a.reset(); loadMaguru();
  }catch(err){ notify('danger', err.message); }
});
async function mPEdit(id,name,desc,price){
  const n=prompt('Nama',name); if(n===null) return;
  const d=prompt('Deskripsi',desc); if(d===null) return;
  const p=prompt('Harga',price); if(p===null) return;
  try{ await api('PUT', `${BASE.MAGURU}/products/${id}`, {name:n,description:d,price:Number(p||0)}); notify('success','Diubah'); loadMaguru(); }
  catch(e){ notify('danger',e.message); }
}
async function mPDel(id){
  if(!confirm('Hapus product?')) return;
  try{ await api('DELETE', `${BASE.MAGURU}/products/${id}`); notify('success','Dihapus'); loadMaguru(); }
  catch(e){ notify('danger',e.message); }
}
form7b.addEventListener('submit', async (e)=>{
  e.preventDefault();
  try{
    await api('POST', `${BASE.MAGURU}/categories`, {name:mc_name.value, slug:mc_slug.value});
    notify('success','Category ditambah'); form7b.reset(); loadMaguru();
  }catch(err){ notify('danger', err.message); }
});
async function mCEdit(id,name,slug){
  const n=prompt('Nama',name); if(n===null) return;
  const s=prompt('Slug',slug); if(s===null) return;
  try{ await api('PUT', `${BASE.MAGURU}/categories/${id}`, {name:n,slug:s}); notify('success','Diubah'); loadMaguru(); }
  catch(e){ notify('danger',e.message); }
}
async function mCDel(id){
  if(!confirm('Hapus category?')) return;
  try{ await api('DELETE', `${BASE.MAGURU}/categories/${id}`); notify('success','Dihapus'); loadMaguru(); }
  catch(e){ notify('danger',e.message); }
}
reload7.addEventListener('click', loadMaguru);

/* =================== INIT on first load =================== */
document.addEventListener('DOMContentLoaded', ()=>{
  loadSp();
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
