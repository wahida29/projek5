<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>🌐 Dashboard Kolaborasi CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f8f9fa; font-family:system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial; }
    h1 { font-weight:700; color:#222; }
    .tab-pane { animation: fadeIn .25s ease-in-out; }
    @keyframes fadeIn { from{opacity:0} to{opacity:1} }
    .spinner { text-align:center; padding:30px; color:#666; font-style:italic; }
    .table thead th { white-space:nowrap; }
  </style>
</head>
<body>
<div class="container py-4">
  <h1 class="text-center mb-4">🌐 Dashboard Kolaborasi CRUD</h1>

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
    <!-- Semua tab -->
    <div class="tab-pane fade show active" id="k5">
      <h3>☕ CaffeShop</h3>
      <div class="mb-2">
        <button class="btn btn-success" onclick="openModal('k5',{category:'kopi'})">➕ Tambah Kopi</button>
        <button class="btn btn-success" onclick="openModal('k5',{category:'nonkopi'})">➕ Tambah Non Kopi</button>
        <button class="btn btn-outline-dark" onclick="loadK5()">🔁 Reload</button>
      </div>
      <div id="tableK5" class="spinner">⏳ Memuat data...</div>
    </div>

    <div class="tab-pane fade" id="k4"><h3>🍔 Krusit (K4)</h3><div id="tableK4" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="k3"><h3>📱 Gadget House</h3><div id="tableK3" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="promo"><h3>💸 SobatPromo</h3><div id="tablePromo" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="justbuy"><h3>🛍️ JustBuy</h3><div id="tableJB" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="reservasi"><h3>📅 Reservasi</h3><div id="tableRes" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="public"><h3>🌍 Public API</h3><div id="tablePublic" class="spinner">⏳ Memuat data...</div></div>
  </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="crudModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="crudTitle">Form CRUD</h5>
      <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <form id="crudForm">
      <div class="modal-body" id="crudBody"></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </form>
  </div></div>
</div>

<script>
const API = {
  k3:'/proxy/k3',
  k4:'/proxy/k4',
  k5:'/proxy/k5',
  promo:'/proxy/promo',
  justbuy:'/proxy/justbuy',
  reservasi:'/proxy/reservasi',
  public:'https://jsonplaceholder.typicode.com/posts'
};

async function safeFetch(url,opt={}) {
  const res = await fetch(url,opt);
  if(!res.ok) throw new Error(`${res.status} ${url}`);
  const ct = res.headers.get('content-type')||'';
  return ct.includes('application/json')?res.json():res.text();
}

/* ======== TABLE BUILDER ======== */
function buildTable({id,columns,rows}) {
  const el=document.getElementById(id);
  if(!rows?.length){el.innerHTML='<div class="alert alert-info">Tidak ada data.</div>';return;}
  const thead=`<thead class="table-dark"><tr>${columns.map(c=>`<th>${c.label}</th>`).join('')}</tr></thead>`;
  const tbody=`<tbody>${rows.map(r=>`<tr>${columns.map(c=>`<td>${r[c.key]??'-'}</td>`).join('')}</tr>`).join('')}</tbody>`;
  el.innerHTML=`<div class='table-responsive'><table class='table table-striped table-hover'>${thead}${tbody}</table></div>`;
}

/* ======== LOAD CAFFESHOP ======== */
async function loadK5(){
  const el=document.getElementById('tableK5');el.innerHTML='⏳ Memuat data...';
  try{
    const kopi=await safeFetch(`${API.k5}/kopi`);
    const non=await safeFetch(`${API.k5}/nonkopi`);
    const data=[...(kopi.data||kopi||[]),...(non.data||non||[])];
    buildTable({
      id:'tableK5',
      columns:[
        {key:'id',label:'ID'},{key:'name',label:'Nama'},
        {key:'description',label:'Deskripsi'},{key:'price',label:'Harga'},{key:'category',label:'Kategori'}
      ],
      rows:data
    });
  }catch(e){el.innerHTML=`<div class='alert alert-danger'>Gagal load: ${e}</div>`;}
}

/* ======== LOAD KRUSIT ======== */
async function loadK4(){
  const el=document.getElementById('tableK4');
  try{
    const makanan=await safeFetch(`${API.k4}/makanan`);
    const minuman=await safeFetch(`${API.k4}/minuman`);
    const data=[...(makanan.data||makanan||[]),...(minuman.data||minuman||[])];
    buildTable({id:'tableK4',columns:[
      {key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'deskripsi',label:'Deskripsi'},{key:'harga',label:'Harga'}
    ],rows:data});
  }catch(e){el.innerHTML=`<div class='alert alert-danger'>Gagal load: ${e}</div>`;}
}

/* ======== LOAD GADGET HOUSE ======== */
async function loadK3(){
  const el=document.getElementById('tableK3');
  try{
    const produk=await safeFetch(`${API.k3}/produk`);
    const data=produk.data||produk||[];
    buildTable({id:'tableK3',columns:[
      {key:'id',label:'ID'},{key:'nama',label:'Nama Produk'},{key:'harga',label:'Harga'},{key:'stok',label:'Stok'}
    ],rows:data});
  }catch(e){el.innerHTML=`<div class='alert alert-danger'>Gagal load: ${e}</div>`;}
}

/* ======== LOAD SOBATPROMO ======== */
async function loadPromo(){
  const el=document.getElementById('tablePromo');
  try{
    const list=await safeFetch(`${API.promo}?action=list`);
    buildTable({id:'tablePromo',columns:[
      {key:'id',label:'ID'},{key:'nama_promo',label:'Nama Promo'},{key:'deskripsi',label:'Deskripsi'}
    ],rows:list.data||list});
  }catch(e){el.innerHTML=`<div class='alert alert-danger'>Gagal load: ${e}</div>`;}
}

/* ======== LOAD JUSTBUY ======== */
async function loadJB(){
  const el=document.getElementById('tableJB');
  try{
    const list=await safeFetch(`${API.justbuy}/produk`);
    buildTable({id:'tableJB',columns:[
      {key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'harga',label:'Harga'},{key:'stok',label:'Stok'}
    ],rows:list.data||list});
  }catch(e){el.innerHTML=`<div class='alert alert-danger'>Gagal load: ${e}</div>`;}
}

/* ======== LOAD RESERVASI ======== */
async function loadRes(){
  const el=document.getElementById('tableRes');
  try{
    const list=await safeFetch(`${API.reservasi}/reservasi`);
    buildTable({id:'tableRes',columns:[
      {key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'tanggal',label:'Tanggal'},{key:'status',label:'Status'}
    ],rows:list.data||list});
  }catch(e){el.innerHTML=`<div class='alert alert-danger'>Gagal load: ${e}</div>`;}
}

/* ======== LOAD PUBLIC ======== */
async function loadPublic(){
  const el=document.getElementById('tablePublic');
  try{
    const list=await safeFetch(API.public);
    buildTable({id:'tablePublic',columns:[
      {key:'id',label:'ID'},{key:'title',label:'Judul'},{key:'body',label:'Isi'}
    ],rows:list.slice(0,10)});
  }catch(e){el.innerHTML=`<div class='alert alert-danger'>Gagal load: ${e}</div>`;}
}

/* ======== INISIAL LOAD ======== */
document.addEventListener('DOMContentLoaded',()=>{
  loadK5();loadK4();loadK3();loadPromo();loadJB();loadRes();loadPublic();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
