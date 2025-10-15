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
    .form-section .card-header{background:var(--brown);color:#fff}
    .badge-endpoint{font-size:.75rem;background:#eef;border:1px solid #dde;color:#334;padding:.2rem .5rem;border-radius:.4rem}
    .small-hint{font-size:.85rem}
  </style>
</head>
<body>
<div class="container py-5">

  <h1 class="text-center mb-4"><i class="bi bi-database-gear"></i> Dashboard CRUD API</h1>
  <p class="text-center muted mb-4">
    <span class="badge-endpoint">Tip: ganti BASE_URL pada bagian <b>Konfigurasi</b> jika ada perubahan endpoint.</span>
  </p>

  <!-- ===================== KONFIGURASI ENDPOINT ===================== -->
  <script>
    // ✔ Silakan sesuaikan kalau ada perubahan:
    const BASE = {
      SOBAT_PROMO : "https://sobatpromo-api-production.up.railway.app/api.php", // memakai action ?action=list|create|update|delete
      JUSTBUY      : "https://projekkelompok9-production.up.railway.app/api",   // contoh: /accounts
      GADGET       : "https://your-gadget-house-api.example.com/api",           // ganti sesuai koleksi kalian
      KRUSIT       : "https://projekkelompok4-production-3d9b.up.railway.app/api",
      COFFEESHOP   : "https://projek5-production.up.railway.app/api",
      RESERVASI    : "https://your-reservasi-api.example.com/api",              // ganti sesuai koleksi
      MAGURU       : "http://localhost:3001/api/public"                         // ganti bila sudah deploy
    };
  </script>
  <!-- =============================================================== -->

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
        <div>
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modalSp"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" id="reload1"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center" id="tbl1">
            <thead><tr><th>#</th><th>Judul</th><th>Deskripsi</th><th>Berlaku Sampai</th><th>Aksi</th></tr></thead>
            <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
          </table>
        </div>
        <div class="small-hint muted mt-2">Format aksi SobatPromo menggunakan query: <code>?action=list|create|update|delete</code></div>
      </div></div>
    </div>

    <!-- =================== JUSTBUY =================== -->
    <div class="tab-pane fade" id="tab2">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">JustBuy <span class="badge-endpoint" id="ep2"></span></h4>
        <div>
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modalJb"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" id="reload2"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center" id="tbl2">
            <thead><tr><th>#</th><th>Username</th><th>Email</th><th>Aksi</th></tr></thead>
            <tbody><tr><td colspan="4" class="muted">Memuat…</td></tr></tbody>
          </table>
        </div>
        <div class="small-hint muted mt-2">Sesuaikan endpoint koleksi JustBuy kalian (contoh: <code>/accounts</code>).</div>
      </div></div>
    </div>

    <!-- =================== GADGET HOUSE =================== -->
    <div class="tab-pane fade" id="tab3">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Gadget House <span class="badge-endpoint" id="ep3"></span></h4>
        <div>
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modalGh"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" id="reload3"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center" id="tbl3">
            <thead><tr><th>#</th><th>Nama</th><th>Brand</th><th>Harga</th><th>Aksi</th></tr></thead>
            <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
          </table>
        </div>
        <div class="small-hint muted mt-2">Ganti <code>BASE.GADGET</code> agar aktif (GET/POST/PUT/DELETE <code>/products</code>).</div>
      </div></div>
    </div>

    <!-- =================== KRUSIT =================== -->
    <div class="tab-pane fade" id="tab4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Krusit <span class="badge-endpoint" id="ep4"></span></h4>
        <div><button class="btn btn-outline-secondary btn-sm" id="reload4"><i class="bi bi-arrow-clockwise"></i> Reload</button></div>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Makanan</div>
            <div class="card-body d-flex gap-2">
              <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#modalKrMkn"><i class="bi bi-plus-circle"></i> Tambah</button>
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
            <div class="card-body d-flex gap-2">
              <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#modalKrMin"><i class="bi bi-plus-circle"></i> Tambah</button>
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

    <!-- =================== COFFEESHOP =================== -->
    <div class="tab-pane fade" id="tab5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">CoffeeShop <span class="badge-endpoint" id="ep5"></span></h4>
        <div><button class="btn btn-outline-secondary btn-sm" id="reload5"><i class="bi bi-arrow-clockwise"></i> Reload</button></div>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Kopi</div>
            <div class="card-body d-flex gap-2">
              <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#modalCk"><i class="bi bi-plus-circle"></i> Tambah</button>
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
            <div class="card-body d-flex gap-2">
              <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#modalCn"><i class="bi bi-plus-circle"></i> Tambah</button>
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
        <div>
          <button class="btn btn-brown btn-sm" data-bs-toggle="modal" data-bs-target="#modalRv"><i class="bi bi-plus-circle"></i> Tambah</button>
          <button class="btn btn-outline-secondary btn-sm" id="reload6"><i class="bi bi-arrow-clockwise"></i> Reload</button>
        </div>
      </div>
      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center" id="tbl6">
            <thead><tr><th>ID</th><th>Nama</th><th>Telepon</th><th>Waktu</th><th>Aksi</th></tr></thead>
            <tbody><tr><td colspan="5" class="muted">Memuat…</td></tr></tbody>
          </table>
        </div>
        <div class="small-hint muted mt-2">Ganti <code>BASE.RESERVASI</code> agar aktif (GET/POST/PUT/DELETE <code>/reservasi</code>).</div>
      </div></div>
    </div>

    <!-- =================== MAGURU =================== -->
    <div class="tab-pane fade" id="tab7">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Maguru <span class="badge-endpoint" id="ep7"></span></h4>
        <div><button class="btn btn-outline-secondary btn-sm" id="reload7"><i class="bi bi-arrow-clockwise"></i> Reload</button></div>
      </div>

      <div class="row g-3">
        <div class="col-lg-6">
          <div class="card form-section mb-3">
            <div class="card-header">Products</div>
            <div class="card-body d-flex gap-2">
              <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#modalMgProd"><i class="bi bi-plus-circle"></i> Tambah</button>
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
            <div class="card-body d-flex gap-2">
              <button class="btn btn-brown" data-bs-toggle="modal" data-bs-target="#modalMgCat"><i class="bi bi-plus-circle"></i> Tambah</button>
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

  </div><!-- /.tab-content -->
</div><!-- /.container -->

<!-- =============== MODALS (Tambah/Edit) =============== -->
<!-- SobatPromo -->
<div class="modal fade" id="modalSp" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formSp">
    <div class="modal-header"><h5 class="modal-title">SobatPromo</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="sp_id">
      <div class="col-12"><input class="form-control" id="sp_title" placeholder="Judul" required></div>
      <div class="col-12"><input class="form-control" id="sp_desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="date" class="form-control" id="sp_until" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- JustBuy -->
<div class="modal fade" id="modalJb" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formJb">
    <div class="modal-header"><h5 class="modal-title">JustBuy - Account</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="jb_id">
      <div class="col-12"><input class="form-control" id="jb_username" placeholder="Username" required></div>
      <div class="col-12"><input class="form-control" id="jb_email" placeholder="Email" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Gadget House -->
<div class="modal fade" id="modalGh" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formGh">
    <div class="modal-header"><h5 class="modal-title">Gadget House - Produk</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="gh_id">
      <div class="col-12"><input class="form-control" id="gh_name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="gh_brand" placeholder="Brand" required></div>
      <div class="col-12"><input type="number" class="form-control" id="gh_price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Krusit: Makanan -->
<div class="modal fade" id="modalKrMkn" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formKrMkn">
    <div class="modal-header"><h5 class="modal-title">Krusit - Makanan</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="krm_id">
      <div class="col-12"><input class="form-control" id="krm_name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="krm_desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="krm_price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Krusit: Minuman -->
<div class="modal fade" id="modalKrMin" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formKrMin">
    <div class="modal-header"><h5 class="modal-title">Krusit - Minuman</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="kri_id">
      <div class="col-12"><input class="form-control" id="kri_name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="kri_desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="kri_price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Coffee: Kopi -->
<div class="modal fade" id="modalCk" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formCk">
    <div class="modal-header"><h5 class="modal-title">CoffeeShop - Kopi</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="ck_id">
      <div class="col-12"><input class="form-control" id="ck_name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="ck_desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="ck_price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Coffee: NonKopi -->
<div class="modal fade" id="modalCn" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formCn">
    <div class="modal-header"><h5 class="modal-title">CoffeeShop - NonKopi</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="cn_id">
      <div class="col-12"><input class="form-control" id="cn_name" placeholder="Nama" required></div>
      <div class="col-12"><input class="form-control" id="cn_desc" placeholder="Deskripsi" required></div>
      <div class="col-12"><input type="number" class="form-control" id="cn_price" placeholder="Harga" required></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Reservasi -->
<div class="modal fade" id="modalRv" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formRv">
    <div class="modal-header"><h5 class="modal-title">Reservasi</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="rv_id">
      <div class="col-12"><input class="form-control" id="rv_nama" placeholder="Nama"></div>
      <div class="col-12"><input class="form-control" id="rv_telp" placeholder="Telepon"></div>
      <div class="col-12"><input type="datetime-local" class="form-control" id="rv_waktu"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Maguru: Products -->
<div class="modal fade" id="modalMgProd" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formMgProd">
    <div class="modal-header"><h5 class="modal-title">Maguru - Product</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="mgp_id">
      <div class="col-12"><input class="form-control" id="mgp_name" placeholder="Nama"></div>
      <div class="col-12"><input class="form-control" id="mgp_desc" placeholder="Deskripsi"></div>
      <div class="col-12"><input type="number" class="form-control" id="mgp_price" placeholder="Harga"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>

<!-- Maguru: Categories -->
<div class="modal fade" id="modalMgCat" tabindex="-1"><div class="modal-dialog">
  <form class="modal-content" id="formMgCat">
    <div class="modal-header"><h5 class="modal-title">Maguru - Category</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body row g-2">
      <input type="hidden" id="mgc_id">
      <div class="col-12"><input class="form-control" id="mgc_name" placeholder="Nama"></div>
      <div class="col-12"><input class="form-control" id="mgc_slug" placeholder="Slug"></div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      <button class="btn btn-brown" type="submit">Simpan</button>
    </div>
  </form>
</div></div>
<!-- ===================================================== -->

<script>
/* ======================== UTIL & CORE ======================== */
const alertBox = document.getElementById('alertBox');
function notify(type, msg){
  alertBox.className = `alert alert-${type}`;
  alertBox.textContent = msg;
  alertBox.classList.remove('d-none');
  setTimeout(()=>alertBox.classList.add('d-none'), 2500);
}
async function request(method, url, body=null){
  // Try true method first; if 405/400, fallback to POST + _method
  const headers = {'Content-Type':'application/json'};
  try{
    const res = await fetch(url, {method, headers, body: body?JSON.stringify(body):null});
    if(res.ok) return await (res.headers.get('content-type')||'').includes('json')?res.json():res.text();
    // if method unsupported, fallback
    if(method!=='GET' && res.status>=400){
      const fb = await fetch(url, {method:'POST', headers, body: JSON.stringify({...body, _method: method})});
      if(!fb.ok) throw new Error(`${res.status} ${res.statusText}`);
      return (fb.headers.get('content-type')||'').includes('json')?fb.json():fb.text();
    }
    throw new Error(`${res.status} ${res.statusText}`);
  }catch(e){ throw e; }
}
function badgeEndpoints(){
  ep1.textContent = BASE.SOBAT_PROMO;
  ep2.textContent = BASE.JUSTBUY;
  ep3.textContent = BASE.GADGET;
  ep4.textContent = BASE.KRUSIT;
  ep5.textContent = BASE.COFFEESHOP;
  ep6.textContent = BASE.RESERVASI;
  ep7.textContent = BASE.MAGURU;
}
badgeEndpoints();
/* ============================================================ */

/* ========================= SOBATPROMO ======================= */
let spEditing = null;
async function loadSp(){
  try{
    const data = await request('GET', `${BASE.SOBAT_PROMO}?action=list`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    tbl1.querySelector('tbody').innerHTML = rows.length ? rows.map((p,i)=>`
      <tr>
        <td>${i+1}</td>
        <td>${p.title||''}</td>
        <td>${p.description||''}</td>
        <td>${(p.valid_until||'').toString().substring(0,10)}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='spOpen(${p.id||i},"${(p.title||"").replace(/"/g,"&quot;")}','${(p.description||"").replace(/"/g,"&quot;")}','${(p.valid_until||"").toString().substring(0,10)}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='spDelete(${p.id||i})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl1.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal memuat: ${e.message}</td></tr>`;
  }
}
function spOpen(id,title,desc,until){
  sp_id.value = id||'';
  sp_title.value = title||'';
  sp_desc.value = desc||'';
  sp_until.value = until||'';
  spEditing = !!id;
  new bootstrap.Modal(document.getElementById('modalSp')).show();
}
formSp.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const payload = { title: sp_title.value, description: sp_desc.value, valid_until: sp_until.value };
  try{
    if(spEditing && sp_id.value){
      await request('POST', `${BASE.SOBAT_PROMO}?action=update&id=${sp_id.value}`, payload);
      notify('success','Promo diperbarui');
    }else{
      await request('POST', `${BASE.SOBAT_PROMO}?action=create`, payload);
      notify('success','Promo ditambahkan');
    }
    bootstrap.Modal.getInstance(document.getElementById('modalSp')).hide();
    formSp.reset(); spEditing=false; loadSp();
  }catch(e){ notify('danger', e.message); }
});
async function spDelete(id){
  if(!confirm('Hapus promo ini?')) return;
  try{ await request('POST', `${BASE.SOBAT_PROMO}?action=delete&id=${id}`); notify('success','Dihapus'); loadSp(); }
  catch(e){ notify('danger', e.message); }
}
reload1.addEventListener('click', loadSp);

/* =========================== JUSTBUY ======================= */
let jbEditing = null;
async function loadJb(){
  try{
    const data = await request('GET', `${BASE.JUSTBUY}/accounts`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    tbl2.querySelector('tbody').innerHTML = rows.length ? rows.map((u,i)=>`
      <tr>
        <td>${i+1}</td><td>${u.username||''}</td><td>${u.email||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='jbOpen("${u.id}","${(u.username||"").replace(/"/g,"&quot;")}","${(u.email||"").replace(/"/g,"&quot;")}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='jbDelete("${u.id}")'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="4" class="muted">Belum ada data</td></tr>`;
  }catch(e){
    tbl2.querySelector('tbody').innerHTML = `<tr><td colspan="4" class="text-danger">Sesuaikan endpoint JustBuy (mis: /accounts). ${e.message}</td></tr>`;
  }
}
function jbOpen(id,username,email){
  jb_id.value = id||'';
  jb_username.value = username||'';
  jb_email.value = email||'';
  jbEditing = !!id;
  new bootstrap.Modal(document.getElementById('modalJb')).show();
}
formJb.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body = { username: jb_username.value, email: jb_email.value };
  try{
    if(jbEditing && jb_id.value){
      await request('PUT', `${BASE.JUSTBUY}/accounts/${jb_id.value}`, body);
      notify('success','Akun diubah');
    }else{
      await request('POST', `${BASE.JUSTBUY}/accounts`, body);
      notify('success','Akun ditambah');
    }
    bootstrap.Modal.getInstance(document.getElementById('modalJb')).hide();
    formJb.reset(); jbEditing=false; loadJb();
  }catch(e){ notify('danger', e.message); }
});
async function jbDelete(id){
  if(!confirm('Hapus akun ini?')) return;
  try{ await request('DELETE', `${BASE.JUSTBUY}/accounts/${id}`); notify('success','Dihapus'); loadJb(); }
  catch(e){ notify('danger', e.message); }
}
reload2.addEventListener('click', loadJb);

/* ========================= GADGET HOUSE ==================== */
let ghEditing = null;
async function loadGh(){
  try{
    const data = await request('GET', `${BASE.GADGET}/products`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    tbl3.querySelector('tbody').innerHTML = rows.length ? rows.map((x,i)=>`
      <tr>
        <td>${x.id||i+1}</td><td>${x.name||''}</td><td>${x.brand||''}</td><td>${x.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='ghOpen("${x.id}","${(x.name||"").replace(/"/g,"&quot;")}","${(x.brand||"").replace(/"/g,"&quot;")}','${x.price||""}')'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='ghDelete("${x.id}")'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Belum ada data</td></tr>`;
  }catch(e){
    tbl3.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Ganti BASE.GADGET agar aktif. ${e.message}</td></tr>`;
  }
}
function ghOpen(id,name,brand,price){
  gh_id.value=id||''; gh_name.value=name||''; gh_brand.value=brand||''; gh_price.value=price||'';
  ghEditing = !!id;
  new bootstrap.Modal(document.getElementById('modalGh')).show();
}
formGh.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body = { name: gh_name.value, brand: gh_brand.value, price: Number(gh_price.value||0) };
  try{
    if(ghEditing && gh_id.value){
      await request('PUT', `${BASE.GADGET}/products/${gh_id.value}`, body);
      notify('success','Produk diubah');
    }else{
      await request('POST', `${BASE.GADGET}/products`, body);
      notify('success','Produk ditambah');
    }
    bootstrap.Modal.getInstance(document.getElementById('modalGh')).hide();
    formGh.reset(); ghEditing=false; loadGh();
  }catch(e){ notify('danger', e.message); }
});
async function ghDelete(id){
  if(!confirm('Hapus produk ini?')) return;
  try{ await request('DELETE', `${BASE.GADGET}/products/${id}`); notify('success','Dihapus'); loadGh(); }
  catch(e){ notify('danger', e.message); }
}
reload3.addEventListener('click', loadGh);

/* ============================= KRUSIT ====================== */
let kmEditing=false, kmiEditing=false;
let kmId=null, kmiId=null;
async function loadKrusit(){
  // makanan
  try{
    const mk = await request('GET', `${BASE.KRUSIT}/makanan`);
    const rows = Array.isArray(mk)?mk:(mk?.data||mk||[]);
    tbl4a.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||m.nama||''}</td><td>${m.description||m.deskripsi||''}</td><td>${m.price||m.harga||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='krmOpen(${m.id},"${(m.name||m.nama||"").replace(/"/g,"&quot;")}','${(m.description||m.deskripsi||"").replace(/"/g,"&quot;")}','${m.price||m.harga||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='krDel("makanan",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl4a.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }
  // minuman
  try{
    const mi = await request('GET', `${BASE.KRUSIT}/minuman`);
    const rows = Array.isArray(mi)?mi:(mi?.data||mi||[]);
    tbl4b.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||m.nama||''}</td><td>${m.description||m.deskripsi||''}</td><td>${m.price||m.harga||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='krmiOpen(${m.id},"${(m.name||m.nama||"").replace(/"/g,"&quot;")}','${(m.description||m.deskripsi||"").replace(/"/g,"&quot;")}','${m.price||m.harga||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='krDel("minuman",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl4b.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }
}
// open modals
function krmOpen(id,name,desc,price){ kmEditing=!!id; kmId=id||null; krm_name.value=name||''; krm_desc.value=desc||''; krm_price.value=price||''; new bootstrap.Modal(modalKrMkn).show(); }
function krmiOpen(id,name,desc,price){ kmiEditing=!!id; kmiId=id||null; kri_name.value=name||''; kri_desc.value=desc||''; kri_price.value=price||''; new bootstrap.Modal(modalKrMin).show(); }
// submit forms
formKrMkn.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:krm_name.value, description:krm_desc.value, price:Number(krm_price.value||0) };
  try{
    if(kmEditing && kmId!=null) await request('PUT', `${BASE.KRUSIT}/makanan/${kmId}`, body);
    else await request('POST', `${BASE.KRUSIT}/makanan`, body);
    notify('success','Makanan tersimpan');
    bootstrap.Modal.getInstance(modalKrMkn).hide(); formKrMkn.reset(); kmEditing=false; kmId=null; loadKrusit();
  }catch(err){ notify('danger', err.message); }
});
formKrMin.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:kri_name.value, description:kri_desc.value, price:Number(kri_price.value||0) };
  try{
    if(kmiEditing && kmiId!=null) await request('PUT', `${BASE.KRUSIT}/minuman/${kmiId}`, body);
    else await request('POST', `${BASE.KRUSIT}/minuman`, body);
    notify('success','Minuman tersimpan');
    bootstrap.Modal.getInstance(modalKrMin).hide(); formKrMin.reset(); kmiEditing=false; kmiId=null; loadKrusit();
  }catch(err){ notify('danger', err.message); }
});
async function krDel(cat,id){
  if(!confirm('Hapus data ini?')) return;
  try{ await request('DELETE', `${BASE.KRUSIT}/${cat}/${id}`); notify('success','Dihapus'); loadKrusit(); }
  catch(e){ notify('danger', e.message); }
}
reload4.addEventListener('click', loadKrusit);

/* =========================== COFFEESHOP ===================== */
let ckEditing=false, cnEditing=false, ckId=null, cnId=null;
async function loadCoffee(){
  // kopi
  try{
    const kopi = await request('GET', `${BASE.COFFEESHOP}/kopi`);
    const rows = Array.isArray(kopi)?kopi:(kopi?.data||kopi||[]);
    tbl5a.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||''}</td><td>${m.description||''}</td><td>${m.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='ckOpen(${m.id},"${(m.name||"").replace(/"/g,"&quot;")}','${(m.description||"").replace(/"/g,"&quot;")}','${m.price||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='cDel("kopi",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl5a.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }
  // nonkopi
  try{
    const non = await request('GET', `${BASE.COFFEESHOP}/nonkopi`);
    const rows = Array.isArray(non)?non:(non?.data||non||[]);
    tbl5b.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||''}</td><td>${m.description||''}</td><td>${m.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='cnOpen(${m.id},"${(m.name||"").replace(/"/g,"&quot;")}','${(m.description||"").replace(/"/g,"&quot;")}','${m.price||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='cDel("nonkopi",${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl5b.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }
}
// open modals
function ckOpen(id,name,desc,price){ ckEditing=!!id; ckId=id||null; ck_name.value=name||''; ck_desc.value=desc||''; ck_price.value=price||''; new bootstrap.Modal(modalCk).show(); }
function cnOpen(id,name,desc,price){ cnEditing=!!id; cnId=id||null; cn_name.value=name||''; cn_desc.value=desc||''; cn_price.value=price||''; new bootstrap.Modal(modalCn).show(); }
// submit forms
formCk.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:ck_name.value, description:ck_desc.value, price:Number(ck_price.value||0) };
  try{
    if(ckEditing && ckId!=null) await request('PUT', `${BASE.COFFEESHOP}/kopi/${ckId}`, body);
    else await request('POST', `${BASE.COFFEESHOP}/kopi`, body);
    notify('success','Menu kopi tersimpan'); bootstrap.Modal.getInstance(modalCk).hide(); formCk.reset(); ckEditing=false; ckId=null; loadCoffee();
  }catch(err){ notify('danger', err.message); }
});
formCn.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:cn_name.value, description:cn_desc.value, price:Number(cn_price.value||0) };
  try{
    if(cnEditing && cnId!=null) await request('PUT', `${BASE.COFFEESHOP}/nonkopi/${cnId}`, body);
    else await request('POST', `${BASE.COFFEESHOP}/nonkopi`, body);
    notify('success','Menu nonkopi tersimpan'); bootstrap.Modal.getInstance(modalCn).hide(); formCn.reset(); cnEditing=false; cnId=null; loadCoffee();
  }catch(err){ notify('danger', err.message); }
});
async function cDel(cat,id){
  if(!confirm('Hapus item ini?')) return;
  try{ await request('DELETE', `${BASE.COFFEESHOP}/${cat}/${id}`); notify('success','Dihapus'); loadCoffee(); }
  catch(e){ notify('danger', e.message); }
}
reload5.addEventListener('click', loadCoffee);

/* ============================ RESERVASI ===================== */
let rvEditing=false, rvId=null;
async function loadRv(){
  try{
    const data = await request('GET', `${BASE.RESERVASI}/reservasi`);
    const rows = Array.isArray(data)?data:(data?.data||[]);
    tbl6.querySelector('tbody').innerHTML = rows.length ? rows.map(x=>`
      <tr>
        <td>${x.id}</td><td>${x.name||x.nama||''}</td><td>${x.phone||x.telepon||''}</td><td>${x.datetime||x.waktu||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='rvOpen(${x.id},"${(x.name||x.nama||"").replace(/"/g,"&quot;")}','${(x.phone||x.telepon||"").replace(/"/g,"&quot;")}','${(x.datetime||x.waktu||"").replace(/"/g,"&quot;")}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='rvDelete(${x.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl6.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Ganti BASE.RESERVASI agar aktif. ${e.message}</td></tr>`;
  }
}
function rvOpen(id,nama,telp,waktu){
  rv_id.value = id||''; rv_nama.value = nama||''; rv_telp.value = telp||''; rv_waktu.value = (waktu||'').replace(' ','T');
  rvEditing = !!id; new bootstrap.Modal(modalRv).show();
}
formRv.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:rv_nama.value, phone:rv_telp.value, datetime:rv_waktu.value.replace('T',' ') };
  try{
    if(rvEditing && rv_id.value) await request('PUT', `${BASE.RESERVASI}/reservasi/${rv_id.value}`, body);
    else await request('POST', `${BASE.RESERVASI}/reservasi`, body);
    notify('success','Reservasi tersimpan'); bootstrap.Modal.getInstance(modalRv).hide(); formRv.reset(); rvEditing=false; rvId=null; loadRv();
  }catch(err){ notify('danger', err.message); }
});
async function rvDelete(id){
  if(!confirm('Hapus data ini?')) return;
  try{ await request('DELETE', `${BASE.RESERVASI}/reservasi/${id}`); notify('success','Dihapus'); loadRv(); }
  catch(e){ notify('danger', e.message); }
}
reload6.addEventListener('click', loadRv);

/* =============================== MAGURU ===================== */
let mgpEditing=false, mgpId=null, mgcEditing=false, mgcId=null;
async function loadMg(){
  // products
  try{
    const p = await request('GET', `${BASE.MAGURU}/products`);
    const rows = Array.isArray(p)?p:(p?.data||p||[]);
    tbl7a.querySelector('tbody').innerHTML = rows.length ? rows.map(m=>`
      <tr>
        <td>${m.id}</td><td>${m.name||''}</td><td>${m.description||''}</td><td>${m.price||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='mgpOpen(${m.id},"${(m.name||"").replace(/"/g,"&quot;")}','${(m.description||"").replace(/"/g,"&quot;")}','${m.price||""}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='mgpDelete(${m.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl7a.querySelector('tbody').innerHTML = `<tr><td colspan="5" class="text-danger">Maguru belum aktif/localhost. ${e.message}</td></tr>`;
  }
  // categories
  try{
    const c = await request('GET', `${BASE.MAGURU}/categories`);
    const rows = Array.isArray(c)?c:(c?.data||c||[]);
    tbl7b.querySelector('tbody').innerHTML = rows.length ? rows.map(x=>`
      <tr>
        <td>${x.id}</td><td>${x.name||''}</td><td>${x.slug||''}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick='mgcOpen(${x.id},"${(x.name||"").replace(/"/g,"&quot;")}','${(x.slug||"").replace(/"/g,"&quot;")}")'><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-danger btn-sm" onclick='mgcDelete(${x.id})'><i class="bi bi-trash3"></i></button>
        </td>
      </tr>`).join('') : `<tr><td colspan="4" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl7b.querySelector('tbody').innerHTML = `<tr><td colspan="4" class="text-danger">Maguru belum aktif/localhost. ${e.message}</td></tr>`;
  }
}
function mgpOpen(id,name,desc,price){
  mgp_id.value=id||''; mgp_name.value=name||''; mgp_desc.value=desc||''; mgp_price.value=price||''; mgpEditing=!!id;
  new bootstrap.Modal(modalMgProd).show();
}
formMgProd.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:mgp_name.value, description:mgp_desc.value, price:Number(mgp_price.value||0) };
  try{
    if(mgpEditing && mgp_id.value) await request('PUT', `${BASE.MAGURU}/products/${mgp_id.value}`, body);
    else await request('POST', `${BASE.MAGURU}/products`, body);
    notify('success','Product tersimpan'); bootstrap.Modal.getInstance(modalMgProd).hide(); formMgProd.reset(); mgpEditing=false; mgpId=null; loadMg();
  }catch(err){ notify('danger', err.message); }
});
async function mgpDelete(id){
  if(!confirm('Hapus product ini?')) return;
  try{ await request('DELETE', `${BASE.MAGURU}/products/${id}`); notify('success','Dihapus'); loadMg(); }
  catch(e){ notify('danger', e.message); }
}
function mgcOpen(id,name,slug){
  mgc_id.value=id||''; mgc_name.value=name||''; mgc_slug.value=slug||''; mgcEditing=!!id;
  new bootstrap.Modal(modalMgCat).show();
}
formMgCat.addEventListener('submit', async (e)=>{
  e.preventDefault();
  const body={ name:mgc_name.value, slug:mgc_slug.value };
  try{
    if(mgcEditing && mgc_id.value) await request('PUT', `${BASE.MAGURU}/categories/${mgc_id.value}`, body);
    else await request('POST', `${BASE.MAGURU}/categories`, body);
    notify('success','Category tersimpan'); bootstrap.Modal.getInstance(modalMgCat).hide(); formMgCat.reset(); mgcEditing=false; mgcId=null; loadMg();
  }catch(err){ notify('danger', err.message); }
});
async function mgcDelete(id){
  if(!confirm('Hapus category ini?')) return;
  try{ await request('DELETE', `${BASE.MAGURU}/categories/${id}`); notify('success','Dihapus'); loadMg(); }
  catch(e){ notify('danger', e.message); }
}
reload7.addEventListener('click', loadMg);

/* ========================== INIT ============================ */
document.addEventListener('DOMContentLoaded', ()=>{
  // isi label endpoint
  try{
    ep1.textContent = BASE.SOBAT_PROMO;
    ep2.textContent = BASE.JUSTBUY;
    ep3.textContent = BASE.GADGET;
    ep4.textContent = BASE.KRUSIT;
    ep5.textContent = BASE.COFFEESHOP;
    ep6.textContent = BASE.RESERVASI;
    ep7.textContent = BASE.MAGURU;
  }catch{}
  // load semua
  loadSp();
  loadJb();
  loadGh();
  loadKrusit();
  loadCoffee();
  loadRv();
  loadMg();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
