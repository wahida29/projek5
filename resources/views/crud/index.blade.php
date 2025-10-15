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
    .btn-action { padding:2px 8px; font-size:13px; }
  </style>
</head>
<body>
<div class="container py-4">
  <h1 class="text-center mb-4">🌐 Dashboard Kolaborasi CRUD</h1>

  <!-- NAV TAB -->
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
    <!-- ===== CAFFE ===== -->
    <div class="tab-pane fade show active" id="k5">
      <h3>☕ CaffeShop</h3>
      <div class="mb-2 d-flex gap-2">
        <button class="btn btn-success" onclick="openModal('k5')">➕ Tambah Data</button>
        <button class="btn btn-outline-dark" onclick="loadK5()">🔁 Reload</button>
      </div>
      <div id="tableK5" class="spinner">⏳ Memuat data...</div>
    </div>

    <div class="tab-pane fade" id="k4"><h3>🍔 Krusit (K4)</h3><div class="mb-2"><button class="btn btn-success" onclick="openModal('k4')">➕ Tambah</button><button class="btn btn-outline-dark" onclick="loadK4()">🔁 Reload</button></div><div id="tableK4" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="k3"><h3>📱 Gadget House</h3><div class="mb-2"><button class="btn btn-success" onclick="openModal('k3')">➕ Tambah</button><button class="btn btn-outline-dark" onclick="loadK3()">🔁 Reload</button></div><div id="tableK3" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="promo"><h3>💸 SobatPromo</h3><div class="mb-2"><button class="btn btn-success" onclick="openModal('promo')">➕ Tambah</button><button class="btn btn-outline-dark" onclick="loadPromo()">🔁 Reload</button></div><div id="tablePromo" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="justbuy"><h3>🛍️ JustBuy</h3><div class="mb-2"><button class="btn btn-success" onclick="openModal('justbuy')">➕ Tambah</button><button class="btn btn-outline-dark" onclick="loadJB()">🔁 Reload</button></div><div id="tableJB" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="reservasi"><h3>📅 Reservasi</h3><div class="mb-2"><button class="btn btn-success" onclick="openModal('reservasi')">➕ Tambah</button><button class="btn btn-outline-dark" onclick="loadRes()">🔁 Reload</button></div><div id="tableRes" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="public"><h3>🌍 Public API</h3><div id="tablePublic" class="spinner">⏳ Memuat data...</div></div>
  </div>
</div>

<!-- ===== MODAL FORM ===== -->
<div class="modal fade" id="crudModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="crudTitle">Tambah Data</h5>
      <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <form id="crudForm">
      <div class="modal-body">
        <input type="hidden" id="crudId" />
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" id="crudNama" class="form-control" required /></div>
        <div class="mb-3"><label class="form-label">Deskripsi</label><input type="text" id="crudDesc" class="form-control" /></div>
        <div class="mb-3"><label class="form-label">Harga</label><input type="number" id="crudHarga" class="form-control" /></div>
        <div class="mb-3"><label class="form-label">Kategori</label><input type="text" id="crudKategori" class="form-control" /></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </form>
  </div></div>
</div>

<script>
/* ================= KONFIG PROXY ================= */
const API = {
  k3: '/proxy/k3/produk',
  k4: '/proxy/k4/makanan',
  k5: '/proxy/k5/kopi',
  promo: '/proxy/promo',
  justbuy: '/proxy/justbuy/produk',
  reservasi: '/proxy/reservasi/reservasi',
  public: 'https://jsonplaceholder.typicode.com/posts'
};

/* ================= FETCH WRAPPER ================= */
async function safeFetch(url,opt={}) {
  try {
    const r = await fetch(url,opt);
    const ct = r.headers.get("content-type") || "";
    if(!r.ok) throw new Error(r.status);
    return ct.includes("json") ? await r.json() : await r.text();
  } catch(e){ return {error:e.message}; }
}

function showError(id,msg){
  document.getElementById(id).innerHTML=`<div class='alert alert-danger'>⚠️ ${msg}</div>`;
}

/* ================= BUILD TABLE ================= */
function buildTable({id,columns,rows,group}) {
  const el=document.getElementById(id);
  if(!rows?.length){el.innerHTML='<div class="alert alert-info">Belum ada data</div>';return;}
  const head=`<thead class="table-dark"><tr>${columns.map(c=>`<th>${c.label}</th>`).join('')}<th>Aksi</th></tr></thead>`;
  const body=`<tbody>${rows.map(r=>`
    <tr>${columns.map(c=>`<td>${r[c.key]??'-'}</td>`).join('')}
    <td>
      <button class='btn btn-warning btn-sm btn-action' onclick="openModal('${group}',${r.id},'edit')">✏️</button>
      <button class='btn btn-danger btn-sm btn-action' onclick="hapusData('${group}',${r.id})">🗑️</button>
    </td></tr>`).join('')}</tbody>`;
  el.innerHTML=`<div class='table-responsive'><table class='table table-hover table-striped'>${head}${body}</table></div>`;
}

/* ================= CRUD FUNCTIONS ================= */
async function hapusData(gr,id){
  if(!confirm('Hapus data ini?')) return;
  const res=await safeFetch(`${API[gr]}/${id}`,{method:'DELETE'});
  if(res.error) alert('Gagal hapus: '+res.error); else {alert('Berhasil dihapus!'); eval(`load${gr.toUpperCase()}()`);}
}

/* ====== Modal Tambah/Edit ====== */
let currentGroup=null;
function openModal(gr,id=null,mode='add'){
  currentGroup=gr;
  const modal=new bootstrap.Modal(document.getElementById('crudModal'));
  document.getElementById('crudTitle').innerText = mode==='edit'?'Edit Data':'Tambah Data';
  document.getElementById('crudForm').dataset.mode=mode;
  document.getElementById('crudId').value=id||'';
  document.getElementById('crudNama').value='';
  document.getElementById('crudDesc').value='';
  document.getElementById('crudHarga').value='';
  document.getElementById('crudKategori').value='';
  modal.show();
}

/* ====== Simpan Data ====== */
document.getElementById('crudForm').addEventListener('submit', async e=>{
  e.preventDefault();
  const mode=e.target.dataset.mode;
  const payload={
    name:crudNama.value,
    description:crudDesc.value,
    price:crudHarga.value,
    category:crudKategori.value
  };
  const id=crudId.value;
  const method = mode==='edit'?'PUT':'POST';
  const url = mode==='edit'?`${API[currentGroup]}/${id}`:API[currentGroup];
  const res = await safeFetch(url,{method,headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
  if(res.error) alert('Gagal: '+res.error); else {alert('Berhasil disimpan!'); bootstrap.Modal.getInstance(crudModal).hide(); eval(`load${currentGroup.toUpperCase()}()`);}
});

/* ================= LOADERS ================= */
async function loadK5(){ const d=await safeFetch(API.k5); if(d.error) return showError('tableK5',d.error);
  buildTable({id:'tableK5',columns:[{key:'id',label:'ID'},{key:'name',label:'Nama'},{key:'description',label:'Deskripsi'},{key:'price',label:'Harga'},{key:'category',label:'Kategori'}],rows:d.data||d,group:'k5'}); }
async function loadK4(){ const d=await safeFetch(API.k4); if(d.error) return showError('tableK4',d.error);
  buildTable({id:'tableK4',columns:[{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'deskripsi',label:'Deskripsi'},{key:'harga',label:'Harga'}],rows:d.data||d,group:'k4'}); }
async function loadK3(){ const d=await safeFetch(API.k3); if(d.error) return showError('tableK3',d.error);
  buildTable({id:'tableK3',columns:[{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'harga',label:'Harga'},{key:'stok',label:'Stok'}],rows:d.data||d,group:'k3'}); }
async function loadPromo(){ const d=await safeFetch(API.promo); if(d.error) return showError('tablePromo',d.error);
  buildTable({id:'tablePromo',columns:[{key:'id',label:'ID'},{key:'nama_promo',label:'Nama Promo'},{key:'deskripsi',label:'Deskripsi'}],rows:d.data||d,group:'promo'}); }
async function loadJB(){ const d=await safeFetch(API.justbuy); if(d.error) return showError('tableJB',d.error);
  buildTable({id:'tableJB',columns:[{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'harga',label:'Harga'},{key:'kategori',label:'Kategori'}],rows:d.data||d,group:'justbuy'}); }
async function loadRes(){ const d=await safeFetch(API.reservasi); if(d.error) return showError('tableRes',d.error);
  buildTable({id:'tableRes',columns:[{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'tanggal',label:'Tanggal'},{key:'status',label:'Status'}],rows:d.data||d,group:'reservasi'}); }
async function loadPublic(){ const d=await safeFetch(API.public); if(d.error) return showError('tablePublic',d.error);
  buildTable({id:'tablePublic',columns:[{key:'id',label:'ID'},{key:'title',label:'Judul'},{key:'body',label:'Isi'}],rows:d.slice(0,10),group:'public'}); }

document.addEventListener('DOMContentLoaded',()=>{ loadK5();loadK4();loadK3();loadPromo();loadJB();loadRes();loadPublic(); });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
