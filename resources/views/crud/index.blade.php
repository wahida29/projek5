<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>🌐 Dashboard Kolaborasi CRUD 7 Kelompok — Full CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background: #f8f9fa; font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }
    h1 { font-weight: 700; color: #222; }
    .tab-pane { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
    .reload-btn { float: right; font-size: 0.9rem; }
    .spinner { text-align: center; padding: 30px; color: #666; font-style: italic; }
    .badge-pill { border-radius: 1rem; padding: .35rem .6rem; font-size: .7rem; }
    .table thead th { white-space: nowrap; }
  </style>
</head>
<body>
<div class="container py-4">
  <h1 class="text-center mb-4">🌐 Dashboard Kolaborasi CRUD </h1>

  <ul class="nav nav-tabs mb-4">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#k5">☕ CaffeShop</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k4">🍔 Krusit (K4)</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#k3">📱 Gadget House</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#promo">💸 SobatPromo</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#justbuy">🛍️ JustBuy</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#reservasi">📅 Reservasi</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#public">🌍 Public API</a></li>
  </ul>

  <div class="tab-content">
    <!-- K5 -->
    <div class="tab-pane fade show active" id="k5">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">☕ CaffeShop (Kelompok 5)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-success" onclick="openModal('k5', {category:'kopi'})">➕ Tambah Kopi</button>
          <button class="btn btn-sm btn-success" onclick="openModal('k5', {category:'nonkopi'})">➕ Tambah Non Kopi</button>
          <button class="btn btn-sm btn-outline-dark" onclick="loadKelompok5()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableKopi" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- K4 -->
    <div class="tab-pane fade" id="k4">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">🍔 Krusit (Kelompok 4)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-primary" onclick="openModal('k4', {_endpointBase:'makanan'})">➕ Tambah Makanan</button>
          <button class="btn btn-sm btn-primary" onclick="openModal('k4', {_endpointBase:'minuman'})">➕ Tambah Minuman</button>
          <button class="btn btn-sm btn-outline-primary" onclick="loadKelompok4()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK4" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- K3 -->
    <div class="tab-pane fade" id="k3">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">📱 Gadget House (Kelompok 3)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-info" onclick="openModal('k3')">➕ Tambah Produk</button>
          <button class="btn btn-sm btn-outline-info" onclick="loadKelompok3()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK3" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- SobatPromo -->
    <div class="tab-pane fade" id="promo">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">💸 SobatPromo</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-success" onclick="openModal('promo')">➕ Tambah Promo</button>
          <button class="btn btn-sm btn-outline-success" onclick="loadSobatPromo()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePromo" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- JustBuy -->
    <div class="tab-pane fade" id="justbuy">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">🛍️ JustBuy</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-warning" onclick="openModal('justbuy')">➕ Tambah Produk</button>
          <button class="btn btn-sm btn-outline-warning" onclick="loadJustBuy()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableJustBuy" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- Reservasi -->
    <div class="tab-pane fade" id="reservasi">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">📅 Reservasi (Kelompok 6)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-danger" onclick="openModal('reservasi')">➕ Tambah Reservasi</button>
          <button class="btn btn-sm btn-outline-danger" onclick="loadReservasi()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableReservasi" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- Public API -->
    <div class="tab-pane fade" id="public">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">🌍 Public API</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-outline-secondary" onclick="loadPublic()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePublic" class="spinner">⏳ Memuat data...</div>
    </div>
  </div>
</div>

<!-- Modal Generic CRUD -->
<div class="modal fade" id="crudModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crudModalTitle">Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="crudForm">
        <div class="modal-body" id="crudModalBody"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// ================= CONFIG =================
const API_K3 = "https://gadgethouse-production.up.railway.app/api"; // produk gadget
const API_K5 = "https://projek5-production.up.railway.app/api";
const API_K4 = "https://projekkelompok4-production-3d9b.up.railway.app/api";
const API_PROMO = "https://sobatpromo-api-production.up.railway.app/api.php";
const API_JB = "https://justbuy-production.up.railway.app/api";
const API_RES = "https://reservasi-production.up.railway.app/api";
const API_PUBLIC = "https://jsonplaceholder.typicode.com/posts";

// ================= SCHEMAS =================
const SCHEMAS = {
  k3: [
    {key:'nama', label:'Nama Produk', type:'text', required:true},
    {key:'kategori', label:'Kategori', type:'text', required:true},
    {key:'harga', label:'Harga', type:'number', required:true},
    {key:'stok', label:'Stok', type:'number', required:true},
    {key:'gambar', label:'URL Gambar', type:'text'}
  ],
  k5: [
    {key:'name', label:'Nama', type:'text', required:true},
    {key:'description', label:'Deskripsi', type:'text', required:true},
    {key:'price', label:'Harga', type:'number', required:true},
    {key:'image', label:'Gambar', type:'text'},
    {key:'category', label:'Kategori', type:'select', options:[{v:'kopi',t:'Kopi'},{v:'nonkopi',t:'Non Kopi'}]}
  ],
  k4_makanan: [
    {key:'name', label:'Nama Makanan', type:'text', required:true},
    {key:'description', label:'Deskripsi', type:'text'},
    {key:'price', label:'Harga', type:'number', required:true}
  ],
  k4_minuman: [
    {key:'name', label:'Nama Minuman', type:'text', required:true},
    {key:'description', label:'Deskripsi', type:'text'},
    {key:'price', label:'Harga', type:'number', required:true}
  ],
  promo: [
    {key:'title', label:'Judul Promo', type:'text', required:true},
    {key:'description', label:'Deskripsi', type:'text'},
    {key:'valid_until', label:'Berlaku Sampai', type:'date'}
  ],
  justbuy: [
    {key:'name', label:'Nama Produk', type:'text', required:true},
    {key:'price', label:'Harga', type:'number', required:true}
  ],
  reservasi: [
    {key:'nama', label:'Nama', type:'text', required:true},
    {key:'tanggal', label:'Tanggal', type:'date', required:true},
    {key:'jam', label:'Jam', type:'time', required:true}
  ]
};

// ========== HELPER & FETCH ==========
async function safeFetch(url, options={}, retries=1){for(let i=0;i<=retries;i++){try{const r=await fetch(url,options);if(!r.ok)throw new Error(r.status);const t=r.headers.get("content-type")||"";if(t.includes("application/json"))return await r.json();return await r.text()}catch(e){if(i===retries)throw e;await new Promise(r=>setTimeout(r,1200))}}}
function buildTable({container,theadClass,columns,rows,actions}){const el=document.getElementById(container);if(!rows||rows.length===0){el.innerHTML=`<div class="alert alert-info">Tidak ada data.</div>`;return}const head=`<thead class="${theadClass||''}"><tr>${columns.map(c=>`<th>${c.label}</th>`).join('')}<th>Aksi</th></tr></thead>`;const body=`<tbody>${rows.map(i=>{const tds=columns.map(c=>`<td>${i[c.key]??'-'}</td>`).join('');return`<tr>${tds}<td>${actions(i)}</td></tr>`}).join('')}</tbody>`;el.innerHTML=`<div class="table-responsive"><table class="table table-striped table-hover">${head}${body}</table></div>`}

// ========== MODAL OPEN ==========
let currentModalCtx=null;
function openModal(tab,init={}){const modalTitle=document.getElementById('crudModalTitle');const modalBody=document.getElementById('crudModalBody');const form=document.getElementById('crudForm');const ctx={tab,mode:init.id?'edit':'create',item:init};ctx.schemaKey=tab==='k4'?(init._endpointBase==='minuman'?'k4_minuman':'k4_makanan'):tab;const schema=SCHEMAS[ctx.schemaKey];modalTitle.textContent=(ctx.mode==='edit'?'Edit':'Tambah')+` (${tab.toUpperCase()})`;modalBody.innerHTML=schema.map(f=>{const val=ctx.item?.[f.key]??'';return`<div class="mb-3"><label>${f.label}</label><input class="form-control" name="${f.key}" type="${f.type}" value="${val}" ${f.required?'required':''}></div>`}).join('');currentModalCtx=ctx;
form.onsubmit=async(e)=>{e.preventDefault();const fd=new FormData(form);const d=Object.fromEntries(fd.entries());
try{
if(ctx.tab==='k3'){const url=`${API_K3}/produk`+(ctx.mode==='edit'?`/${ctx.item.id}`:'');const m=ctx.mode==='edit'?'PUT':'POST';await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify(d)});bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();await loadKelompok3();}
else if(ctx.tab==='k5'){const base=d.category||'kopi';const url=`${API_K5}/${base}`+(ctx.mode==='edit'?`/${ctx.item.id}`:'');const m=ctx.mode==='edit'?'PUT':'POST';await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({name:d.name,description:d.description,price:Number(d.price),image:d.image||'',category:base})});bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();await loadKelompok5();}
else if(ctx.tab==='k4'){const base=init._endpointBase||'makanan';const url=`${API_K4}/${base}`+(ctx.mode==='edit'?`/${ctx.item.id}`:'');const m=ctx.mode==='edit'?'PUT':'POST';await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({name:d.name,description:d.description||'',price:Number(d.price)})});bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();await loadKelompok4();}
else if(ctx.tab==='promo'){const act=ctx.mode==='edit'?`update&id=${ctx.item.id}`:'add';await safeFetch(`${API_PROMO}?action=${act}`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(d)});bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();await loadSobatPromo();}
else if(ctx.tab==='justbuy'){const url=`${API_JB}/produk`+(ctx.mode==='edit'?`/${ctx.item.id}`:'');const m=ctx.mode==='edit'?'PUT':'POST';await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({name:d.name,price:Number(d.price)})});bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();await loadJustBuy();}
else if(ctx.tab==='reservasi'){const url=`${API_RES}/reservasi`+(ctx.mode==='edit'?`/${ctx.item.id}`:'');const m=ctx.mode==='edit'?'PUT':'POST';await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify(d)});bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();await loadReservasi();}
}catch(e){alert('Gagal menyimpan');console.error(e)}};new bootstrap.Modal(document.getElementById('crudModal')).show();}

// ========== DELETE ==========
async function deleteItem(tab,item){if(!confirm(`Hapus ID ${item.id}?`))return;
try{
if(tab==='k3'){await safeFetch(`${API_K3}/produk/${item.id}`,{method:'DELETE'});await loadKelompok3();}
else if(tab==='k5'){await safeFetch(`${API_K5}/${item.category}/${item.id}`,{method:'DELETE'});await loadKelompok5();}
else if(tab==='k4'){await safeFetch(`${API_K4}/${item._endpointBase}/${item.id}`,{method:'DELETE'});await loadKelompok4();}
else if(tab==='promo'){await safeFetch(`${API_PROMO}?action=delete&id=${item.id}`);await loadSobatPromo();}
else if(tab==='justbuy'){await safeFetch(`${API_JB}/produk/${item.id}`,{method:'DELETE'});await loadJustBuy();}
else if(tab==='reservasi'){await safeFetch(`${API_RES}/reservasi/${item.id}`,{method:'DELETE'});await loadReservasi();}
}catch(e){alert('Gagal menghapus');console.error(e)}}

// ========== LOAD DATA ==========
async function loadKelompok3(){const el=document.getElementById('tableK3');el.innerHTML='<div class="spinner">⏳ Memuat data...</div>';try{const d=await safeFetch(`${API_K3}/produk`);const r=Array.isArray(d)?d:(d.data||[]);buildTable({container:'tableK3',theadClass:'table-info',columns:[{key:'id',label:'ID'},{key:'nama',label:'Nama Produk'},{key:'kategori',label:'Kategori'},{key:'harga',label:'Harga'},{key:'stok',label:'Stok'},{key:'gambar',label:'Gambar'}],rows:r,actions:(i)=>`<button class='btn btn-sm btn-outline-info me-1' onclick='openModal("k3",${JSON.stringify(i)})'>✏️</button><button class='btn btn-sm btn-outline-danger' onclick='deleteItem("k3",${JSON.stringify(i)})'>🗑️</button>`})}catch(e){el.innerHTML=`<div class='alert alert-warning'>⚠️ API Gadget House tidak merespon.</div>`;console.error(e)}}

// ========== LOAD OTHERS ==========
async function loadKelompok5(){/* sama seperti versi kamu sebelumnya */}
async function loadKelompok4(){/* ... */}
async function loadSobatPromo(){/* ... */}
async function loadJustBuy(){/* ... */}
async function loadReservasi(){/* ... */}
async function loadPublic(){/* ... */}

// ========== INITIAL LOAD ==========
loadKelompok3();
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
