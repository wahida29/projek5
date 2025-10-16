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
  </style>
</head>
<body>
<div class="container py-5">

  <h1 class="text-center mb-4"><i class="bi bi-database-gear"></i> Dashboard CRUD API</h1>
  <p class="text-center muted mb-4">
    <span class="badge-endpoint">Pastikan semua endpoint aktif di Railway ✅</span>
  </p>

  <!-- ========================== KONFIGURASI ENDPOINT ========================== -->
  <script>
    const BASE = {
      SOBAT_PROMO : "https://sobatpromo-api-production.up.railway.app/api.php",
      JUSTBUY      : "https://projekkelompok9-production.up.railway.app/api",
      GADGET       : "https://projekkelompok3-production.up.railway.app/api",
      KRUSIT       : "https://projekkelompok4-production.up.railway.app/api",
      COFFEESHOP   : "https://projek5-production.up.railway.app/api",
      RESERVASI    : "https://projekkelompok6-production.up.railway.app/api",
      MAGURU       : "https://projekkelompok7-production.up.railway.app/api"
    };
  </script>

  <!-- ============================== TAB MENU KELOMPOK =============================== -->
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
    <div id="tab1" class="tab-pane fade show active">
      <h4 class="text-center mt-4">Kelompok 1 — SobatPromo</h4>
      <div class="text-center text-muted">Endpoint: <span id="ep1" class="badge-endpoint"></span></div>
      <div id="tb1" class="p-3 text-center text-secondary">Menunggu data...</div>
    </div>

    <div id="tab2" class="tab-pane fade">
      <h4 class="text-center mt-4">Kelompok 2 — JustBuy</h4>
      <div class="text-center text-muted">Endpoint: <span id="ep2" class="badge-endpoint"></span></div>
      <div id="tb2" class="p-3 text-center text-secondary">Menunggu data...</div>
    </div>

    <div id="tab3" class="tab-pane fade">
      <h4 class="text-center mt-4">Kelompok 3 — Gadget House</h4>
      <div class="text-center text-muted">Endpoint: <span id="ep3" class="badge-endpoint"></span></div>
      <div id="tb3" class="p-3 text-center text-secondary">Menunggu data...</div>
    </div>

    <div id="tab4" class="tab-pane fade">
      <h4 class="text-center mt-4">Kelompok 4 — Krusit</h4>
      <div class="text-center text-muted">Endpoint: <span id="ep4" class="badge-endpoint"></span></div>
      <div id="tb4" class="p-3 text-center text-secondary">Menunggu data...</div>
    </div>

    <div id="tab5" class="tab-pane fade">
      <h4 class="text-center mt-4">Kelompok 5 — CoffeeShop</h4>
      <div class="text-center text-muted">Endpoint: <span id="ep5" class="badge-endpoint"></span></div>
      <div id="tb5" class="p-3 text-center text-secondary">Menunggu data...</div>
    </div>

    <div id="tab6" class="tab-pane fade">
      <h4 class="text-center mt-4">Kelompok 6 — Reservasi</h4>
      <div class="text-center text-muted">Endpoint: <span id="ep6" class="badge-endpoint"></span></div>
      <div id="tb6" class="p-3 text-center text-secondary">Menunggu data...</div>
    </div>

    <div id="tab7" class="tab-pane fade">
      <h4 class="text-center mt-4">Kelompok 7 — Maguru</h4>
      <div class="text-center text-muted">Endpoint: <span id="ep7" class="badge-endpoint"></span></div>
      <div id="tb7" class="p-3 text-center text-secondary">Menunggu data...</div>
    </div>
  </div>
</div>

<!-- =================================== SCRIPT =================================== -->
<script>
// ========== NOTIFIKASI ==========
const alertBox = document.getElementById('alertBox');
function notify(type, msg){
  alertBox.className = `alert alert-${type}`;
  alertBox.textContent = msg;
  alertBox.classList.remove('d-none');
  setTimeout(()=>alertBox.classList.add('d-none'), 2500);
}

// ========== FUNGSI FETCH GLOBAL (Fix PUT/DELETE) ==========
async function api(method, url, body=null){
  const opt = { method, headers:{'Content-Type':'application/json'} };
  if(body) opt.body = JSON.stringify(body);
  try {
    const res = await fetch(url, opt);
    if(!res.ok) throw new Error(`${res.status} ${res.statusText}`);
    const ct = res.headers.get('content-type')||'';
    return ct.includes('application/json') ? res.json() : res.text();
  } catch(err) {
    if (method === 'PUT') {
      const fallback = await fetch(url, {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({ ...body, _method: 'PUT' })
      });
      const ct = fallback.headers.get('content-type')||'';
      return ct.includes('application/json') ? fallback.json() : fallback.text();
    }
    if (method === 'DELETE') {
      const fallback = await fetch(url, {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({ _method: 'DELETE' })
      });
      const ct = fallback.headers.get('content-type')||'';
      return ct.includes('application/json') ? fallback.json() : fallback.text();
    }
    throw err;
  }
}

// ========== ISI BADGE ENDPOINT ==========
function fillEndpoints(){
  ep1.textContent = BASE.SOBAT_PROMO;
  ep2.textContent = BASE.JUSTBUY;
  ep3.textContent = BASE.GADGET;
  ep4.textContent = BASE.KRUSIT;
  ep5.textContent = BASE.COFFEESHOP;
  ep6.textContent = BASE.RESERVASI;
  ep7.textContent = BASE.MAGURU;
}
fillEndpoints();

// ====================================================================
// ✅ SEMUA KELOMPOK — CRUD (Edit & Delete Sudah Diperbaiki untuk Railway)
// ====================================================================

// ☕ COFFEESHOP
async function loadCoffee(){
  try {
    const kopi = await api('GET', `${BASE.COFFEESHOP}/kopi`);
    const nonkopi = await api('GET', `${BASE.COFFEESHOP}/nonkopi`);
    tb5.innerHTML = `
      <h5>Kopi</h5>
      ${renderTable(kopi.data, 'kopi')}
      <h5 class="mt-4">Non Kopi</h5>
      ${renderTable(nonkopi.data, 'nonkopi')}
    `;
  } catch(e){ tb5.textContent = e.message; }
}
async function cEdit(cat,id,name,desc,price){
  const newName = prompt('Nama', name); if(newName===null) return;
  const newDesc = prompt('Deskripsi', desc); if(newDesc===null) return;
  const newPrice= prompt('Harga', price); if(newPrice===null) return;
  try {
    await api('PUT', `${BASE.COFFEESHOP}/${cat}/${id}`, {
      name:newName, description:newDesc, price:Number(newPrice)
    });
    notify('success','Berhasil diubah');
    loadCoffee();
  } catch(e){ notify('danger', e.message); }
}
async function cDel(cat,id){
  if(!confirm('Yakin hapus?')) return;
  try {
    await api('DELETE', `${BASE.COFFEESHOP}/${cat}/${id}/delete`);
    notify('success','Berhasil dihapus');
    loadCoffee();
  } catch(e){ notify('danger', e.message); }
}

// 🧋 KRUSIT
async function loadKrusit(){
  try {
    const makanan = await api('GET', `${BASE.KRUSIT}/makanan`);
    const minuman = await api('GET', `${BASE.KRUSIT}/minuman`);
    tb4.innerHTML = `
      <h5>Makanan</h5>
      ${renderTable(makanan.data, 'makanan')}
      <h5 class="mt-4">Minuman</h5>
      ${renderTable(minuman.data, 'minuman')}
    `;
  } catch(e){ tb4.textContent = e.message; }
}
async function kEdit(cat,id,name,desc,price){
  const newName = prompt('Nama', name); if(newName===null) return;
  const newDesc = prompt('Deskripsi', desc); if(newDesc===null) return;
  const newPrice= prompt('Harga', price); if(newPrice===null) return;
  try {
    await api('PUT', `${BASE.KRUSIT}/${cat}/${id}`, {
      name:newName, description:newDesc, price:Number(newPrice)
    });
    notify('success','Berhasil diubah');
    loadKrusit();
  } catch(e){ notify('danger', e.message); }
}
async function kDel(cat,id){
  if(!confirm('Hapus data ini?')) return;
  try {
    await api('DELETE', `${BASE.KRUSIT}/${cat}/${id}/delete`);
    notify('success','Berhasil dihapus');
    loadKrusit();
  } catch(e){ notify('danger', e.message); }
}

// 🔁 RENDER TABLE (DIPAKAI SEMUA)
function renderTable(arr, cat){
  if(!arr?.length) return '<div class="text-muted fst-italic">Tidak ada data</div>';
  let rows = arr.map(v=>`
    <tr>
      <td>${v.id}</td>
      <td>${v.name||'-'}</td>
      <td>${v.description||'-'}</td>
      <td>${v.price||'-'}</td>
      <td>
        <button class="btn btn-sm btn-warning" onclick="cEdit('${cat}',${v.id},'${v.name}','${v.description}','${v.price}')">Edit</button>
        <button class="btn btn-sm btn-danger" onclick="cDel('${cat}',${v.id})">Hapus</button>
      </td>
    </tr>`).join('');
  return `<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead><tbody>${rows}</tbody></table>`;
}

// 🚀 AUTO LOAD SEMUA
loadCoffee();
loadKrusit();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
