<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>🌐 Dashboard Kolaborasi CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background:#f8f9fa; font-family: system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial; }
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
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">☕ CaffeShop</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-success" onclick="openModal('k5',{category:'kopi'})">➕ Tambah Kopi</button>
          <button class="btn btn-sm btn-success" onclick="openModal('k5',{category:'nonkopi'})">➕ Tambah Non Kopi</button>
          <button class="btn btn-sm btn-outline-dark" onclick="loadK5()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK5" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- K4 -->
    <div class="tab-pane fade" id="k4">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">🍔 Krusit (K4)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-primary" onclick="openModal('k4',{_base:'makanan'})">➕ Tambah Makanan</button>
          <button class="btn btn-sm btn-primary" onclick="openModal('k4',{_base:'minuman'})">➕ Tambah Minuman</button>
          <button class="btn btn-sm btn-outline-primary" onclick="loadK4()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK4" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- K3 -->
    <div class="tab-pane fade" id="k3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">📱 Gadget House (K3)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-info" onclick="openModal('k3')">➕ Tambah Produk</button>
          <button class="btn btn-sm btn-outline-info" onclick="loadK3()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableK3" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- Promo -->
    <div class="tab-pane fade" id="promo">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">💸 SobatPromo</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-success" onclick="openModal('promo')">➕ Tambah Promo</button>
          <button class="btn btn-sm btn-outline-success" onclick="loadPromo()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePromo" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- JustBuy -->
    <div class="tab-pane fade" id="justbuy">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">🛍️ JustBuy</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-warning" onclick="openModal('justbuy')">➕ Tambah Produk</button>
          <button class="btn btn-sm btn-outline-warning" onclick="loadJB()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableJB" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- Reservasi -->
    <div class="tab-pane fade" id="reservasi">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">📅 Reservasi</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-danger" onclick="openModal('reservasi')">➕ Tambah Reservasi</button>
          <button class="btn btn-sm btn-outline-danger" onclick="loadRes()">🔁 Reload</button>
        </div>
      </div>
      <div id="tableRes" class="spinner">⏳ Memuat data...</div>
    </div>

    <!-- Public -->
    <div class="tab-pane fade" id="public">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="mb-0">🌍 Public API (simulasi CRUD)</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-secondary" onclick="openModal('public')">➕ Tambah Post</button>
          <button class="btn btn-sm btn-outline-secondary" onclick="loadPublic()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePublic" class="spinner">⏳ Memuat data...</div>
      <small class="text-muted">Perubahan Public API hanya simulasi di sisi UI (JSONPlaceholder tidak menyimpan permanen).</small>
    </div>
  </div>
</div>

<!-- Modal CRUD -->
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
          <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
/* ================== CONFIG (via proxy anti-CORS) ================== */
const API_K3   = "/proxy/k3";
const API_K4   = "/proxy/k4";
const API_K5   = "/proxy/k5";
const API_PROMO= "/proxy/promo";
const API_JB   = "/proxy/justbuy";
const API_RES  = "/proxy/reservasi";
const API_PUBLIC = "https://jsonplaceholder.typicode.com/posts"; // simulasi

/* ================== HELPERS ================== */
async function safeFetch(url, options={}){
  const res = await fetch(url, options);
  if (!res.ok) throw new Error(res.status + ' ' + url);
  const ct = res.headers.get('content-type')||'';
  return ct.includes('application/json') ? res.json() : res.text();
}
function buildTable({id, theadClass, columns, rows, actions}){
  const el = document.getElementById(id);
  if (!rows || rows.length === 0) {
    el.innerHTML = `<div class="alert alert-info">Tidak ada data.</div>`;
    return;
  }
  const head = `<thead class="${theadClass||''}"><tr>${
    columns.map(c=>`<th>${c.label}</th>`).join('')
  }${actions?'<th>Aksi</th>':''}</tr></thead>`;
  const body = `<tbody>${
    rows.map(r=>`<tr>${
      columns.map(c=>`<td>${r[c.key]??'-'}</td>`).join('')
    }${actions?`<td class="text-nowrap">${actions(r)}</td>`:''}</tr>`).join('')
  }</tbody>`;
  el.innerHTML = `<div class="table-responsive"><table class="table table-striped table-hover">${head}${body}</table></div>`;
}

/* ================== MODAL DINAMIS ================== */
let CTX = null; // {tab, mode, item, extra}

function openModal(tab, extra={}){
  CTX = { tab, mode:'create', item:null, extra };
  const title = document.getElementById('crudTitle');
  const body  = document.getElementById('crudBody');
  const form  = document.getElementById('crudForm');
  const isEdit= !!extra.id;
  CTX.mode = isEdit? 'edit' : 'create';
  CTX.item = isEdit? extra : null;

  title.textContent = (isEdit?'Edit':'Tambah') + ' (' + tab.toUpperCase() + ')';

  let fields = '';
  if (tab==='k5'){ // CaffeShop
    const v = isEdit? CTX.item : {};
    fields = `
      <div class="mb-2"><label class="form-label">Nama</label><input name="name" class="form-control" value="${v.name||''}" required></div>
      <div class="mb-2"><label class="form-label">Deskripsi</label><input name="description" class="form-control" value="${v.description||''}" required></div>
      <div class="mb-2"><label class="form-label">Harga</label><input name="price" type="number" class="form-control" value="${v.price||''}" required></div>
      <div class="mb-2"><label class="form-label">Kategori</label>
        <select name="category" class="form-select">
          <option value="kopi" ${ (v.category||CTX.extra.category)==='kopi'?'selected':'' }>Kopi</option>
          <option value="nonkopi" ${ (v.category||CTX.extra.category)==='nonkopi'?'selected':'' }>Non Kopi</option>
        </select>
      </div>`;
  }
  else if (tab==='k4'){ // Krusit
    const v = isEdit? CTX.item : {};
    fields = `
      <div class="mb-2"><label class="form-label">Nama</label><input name="name" class="form-control" value="${v.name||''}" required></div>
      <div class="mb-2"><label class="form-label">Deskripsi</label><input name="description" class="form-control" value="${v.description||''}"></div>
      <div class="mb-2"><label class="form-label">Harga</label><input name="price" type="number" class="form-control" value="${v.price||''}" required></div>
      <input type="hidden" name="_base" value="${(v._base||CTX.extra._base||'makanan')}">`;
  }
  else if (tab==='k3'){ // Gadget House
    const v = isEdit? CTX.item : {};
    fields = `
      <div class="mb-2"><label class="form-label">Nama Produk</label><input name="nama" class="form-control" value="${v.nama||''}" required></div>
      <div class="mb-2"><label class="form-label">Kategori</label><input name="kategori" class="form-control" value="${v.kategori||''}" required></div>
      <div class="mb-2"><label class="form-label">Harga</label><input name="harga" type="number" class="form-control" value="${v.harga||''}" required></div>
      <div class="mb-2"><label class="form-label">Stok</label><input name="stok" type="number" class="form-control" value="${v.stok||''}" required></div>`;
  }
  else if (tab==='promo'){ // SobatPromo
    const v = isEdit? CTX.item : {};
    fields = `
      <div class="mb-2"><label class="form-label">Judul</label><input name="title" class="form-control" value="${v.title||''}" required></div>
      <div class="mb-2"><label class="form-label">Deskripsi</label><input name="description" class="form-control" value="${v.description||''}"></div>
      <div class="mb-2"><label class="form-label">Berlaku Sampai</label><input name="valid_until" type="date" class="form-control" value="${v.valid_until||''}"></div>`;
  }
  else if (tab==='justbuy'){ // JustBuy
    const v = isEdit? CTX.item : {};
    fields = `
      <div class="mb-2"><label class="form-label">Nama Produk</label><input name="name" class="form-control" value="${v.name||''}" required></div>
      <div class="mb-2"><label class="form-label">Harga</label><input name="price" type="number" class="form-control" value="${v.price||''}" required></div>`;
  }
  else if (tab==='reservasi'){ // Reservasi
    const v = isEdit? CTX.item : {};
    fields = `
      <div class="mb-2"><label class="form-label">Nama</label><input name="nama" class="form-control" value="${v.nama||''}" required></div>
      <div class="mb-2"><label class="form-label">Tanggal</label><input name="tanggal" type="date" class="form-control" value="${v.tanggal||''}" required></div>
      <div class="mb-2"><label class="form-label">Jam</label><input name="jam" type="time" class="form-control" value="${v.jam||''}" required></div>`;
  }
  else if (tab==='public'){ // simulasi
    const v = isEdit? CTX.item : {};
    fields = `
      <div class="mb-2"><label class="form-label">Judul</label><input name="title" class="form-control" value="${v.title||''}" required></div>
      <div class="mb-2"><label class="form-label">Konten</label><textarea name="body" class="form-control" rows="3" required>${v.body||''}</textarea></div>`;
  }

  body.innerHTML = fields;

  // submit handler
  document.getElementById('crudForm').onsubmit = onSubmitModal;
  new bootstrap.Modal(document.getElementById('crudModal')).show();
}

async function onSubmitModal(e){
  e.preventDefault();
  const fd = new FormData(e.target);
  const data = Object.fromEntries(fd.entries());
  try {
    if (CTX.tab==='k5'){ // kopi / nonkopi
      const base = data.category || (CTX.item?.category) || CTX.extra.category || 'kopi';
      const url  = `${API_K5}/${base}` + (CTX.mode==='edit'? `/${CTX.item.id}` : '');
      const m    = CTX.mode==='edit'? 'PUT':'POST';
      await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({
        name:data.name, description:data.description, price:Number(data.price), category:base
      })});
      await loadK5();
    }
    else if (CTX.tab==='k4'){ // makanan/minuman
      const base = data._base || CTX.item?._base || CTX.extra._base || 'makanan';
      const url  = `${API_K4}/${base}` + (CTX.mode==='edit'? `/${CTX.item.id}` : '');
      const m    = CTX.mode==='edit'? 'PUT':'POST';
      await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({
        name:data.name, description:data.description||'', price:Number(data.price)
      })});
      await loadK4();
    }
    else if (CTX.tab==='k3'){ // produk
      const url = `${API_K3}/produk` + (CTX.mode==='edit'? `/${CTX.item.id}` : '');
      const m   = CTX.mode==='edit'? 'PUT':'POST';
      await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({
        nama:data.nama, kategori:data.kategori, harga:Number(data.harga), stok:Number(data.stok)
      })});
      await loadK3();
    }
    else if (CTX.tab==='promo'){ // pakai action
      const act = CTX.mode==='edit' ? `?action=update&id=${encodeURIComponent(CTX.item.id)}` : `?action=add`;
      await safeFetch(`${API_PROMO}${act}`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({
        title:data.title, description:data.description||'', valid_until:data.valid_until||null
      })});
      await loadPromo();
    }
    else if (CTX.tab==='justbuy'){
      const url = `${API_JB}/produk` + (CTX.mode==='edit'? `/${CTX.item.id}`:'');
      const m   = CTX.mode==='edit'? 'PUT':'POST';
      await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({
        name:data.name, price:Number(data.price)
      })});
      await loadJB();
    }
    else if (CTX.tab==='reservasi'){
      const url = `${API_RES}/reservasi` + (CTX.mode==='edit'? `/${CTX.item.id}`:'');
      const m   = CTX.mode==='edit'? 'PUT':'POST';
      await safeFetch(url,{method:m,headers:{'Content-Type':'application/json'},body:JSON.stringify({
        nama:data.nama, tanggal:data.tanggal, jam:data.jam
      })});
      await loadRes();
    }
    else if (CTX.tab==='public'){ // simulasi create/update (tidak persistent)
      if (CTX.mode==='edit'){
        await fetch(`${API_PUBLIC}/${CTX.item.id}`,{method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify({title:data.title, body:data.body})});
        // update cache lokal
        const i = PUBLIC_CACHE.findIndex(x=>x.id===CTX.item.id);
        if (i>-1){ PUBLIC_CACHE[i].title=data.title; PUBLIC_CACHE[i].body=data.body; }
      } else {
        const r = await fetch(API_PUBLIC,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({title:data.title, body:data.body})});
        const j = await r.json(); // id palsu
        PUBLIC_CACHE.unshift({id:j.id||Math.floor(Math.random()*10000), title:data.title, body:data.body});
      }
      await renderPublic();
    }
    bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();
  } catch(err){
    alert('Gagal menyimpan: '+err);
    console.error(err);
  }
}

/* ================== DELETE ================== */
async function deleteItem(tab, item){
  if (!confirm(`Hapus data ID ${item.id}?`)) return;
  try {
    if (tab==='k5'){
      await safeFetch(`${API_K5}/${item.category}/${item.id}`,{method:'DELETE'});
      await loadK5();
    } else if (tab==='k4'){
      const base = item._base || 'makanan';
      await safeFetch(`${API_K4}/${base}/${item.id}`,{method:'DELETE'});
      await loadK4();
    } else if (tab==='k3'){
      await safeFetch(`${API_K3}/produk/${item.id}`,{method:'DELETE'});
      await loadK3();
    } else if (tab==='promo'){
      await safeFetch(`${API_PROMO}?action=delete&id=${encodeURIComponent(item.id)}`);
      await loadPromo();
    } else if (tab==='justbuy'){
      await safeFetch(`${API_JB}/produk/${item.id}`,{method:'DELETE'});
      await loadJB();
    } else if (tab==='reservasi'){
      await safeFetch(`${API_RES}/reservasi/${item.id}`,{method:'DELETE'});
      await loadRes();
    } else if (tab==='public'){ // simulasi
      PUBLIC_CACHE = PUBLIC_CACHE.filter(x=>x.id!==item.id);
      await renderPublic();
    }
  } catch(e){
    alert('Gagal menghapus');
    console.error(e);
  }
}

/* ================== LOADERS ================== */
async function loadK5(){
  const el=document.getElementById('tableK5'); el.innerHTML='⏳ Memuat data...';
  try{
    const kopi = await safeFetch(`${API_K5}/kopi`);
    const non  = await safeFetch(`${API_K5}/nonkopi`);
    const rows = [...(kopi.data||kopi).map(x=>({...x,category:'kopi'})), ...(non.data||non).map(x=>({...x,category:'nonkopi'}))];
    buildTable({
      id:'tableK5', theadClass:'table-dark',
      columns:[{key:'id',label:'ID'},{key:'name',label:'Nama'},{key:'description',label:'Deskripsi'},{key:'price',label:'Harga'},{key:'category',label:'Kategori'}],
      rows,
      actions:(r)=>`<button class="btn btn-sm btn-outline-primary me-1" onclick='openModal("k5",${JSON.stringify(r)})'>✏️</button>
                   <button class="btn btn-sm btn-outline-danger" onclick='deleteItem("k5",${JSON.stringify(r)})'>🗑️</button>`
    });
  }catch(e){ el.innerHTML=`<div class='alert alert-warning'>⚠️ API CaffeShop tidak merespon.</div>`; console.error(e); }
}

async function loadK4(){
  const el=document.getElementById('tableK4'); el.innerHTML='⏳ Memuat data...';
  try{
    const m = await safeFetch(`${API_K4}/makanan`);
    const n = await safeFetch(`${API_K4}/minuman`);
    const rows = [
      ...(m.data||m).map(x=>({...x,_base:'makanan'})),
      ...(n.data||n).map(x=>({...x,_base:'minuman'}))
    ];
    buildTable({
      id:'tableK4', theadClass:'table-primary',
      columns:[{key:'id',label:'ID'},{key:'name',label:'Nama'},{key:'description',label:'Deskripsi'},{key:'price',label:'Harga'},{key:'_base',label:'Jenis'}],
      rows,
      actions:(r)=>`<button class="btn btn-sm btn-outline-primary me-1" onclick='openModal("k4",${JSON.stringify(r)})'>✏️</button>
                   <button class="btn btn-sm btn-outline-danger" onclick='deleteItem("k4",${JSON.stringify(r)})'>🗑️</button>`
    });
  }catch(e){ el.innerHTML=`<div class='alert alert-warning'>⚠️ API Krusit tidak merespon.</div>`; console.error(e); }
}

async function loadK3(){
  const el=document.getElementById('tableK3'); el.innerHTML='⏳ Memuat data...';
  try{
    const d = await safeFetch(`${API_K3}/produk`);
    const rows = d.data || d;
    buildTable({
      id:'tableK3', theadClass:'table-info',
      columns:[{key:'id',label:'ID'},{key:'nama',label:'Nama Produk'},{key:'kategori',label:'Kategori'},{key:'harga',label:'Harga'},{key:'stok',label:'Stok'}],
      rows,
      actions:(r)=>`<button class="btn btn-sm btn-outline-info me-1" onclick='openModal("k3",${JSON.stringify(r)})'>✏️</button>
                   <button class="btn btn-sm btn-outline-danger" onclick='deleteItem("k3",${JSON.stringify(r)})'>🗑️</button>`
    });
  }catch(e){ el.innerHTML=`<div class='alert alert-warning'>⚠️ API Gadget House tidak merespon.</div>`; console.error(e); }
}

async function loadPromo(){
  const el=document.getElementById('tablePromo'); el.innerHTML='⏳ Memuat data...';
  try{
    const d = await safeFetch(`${API_PROMO}?action=list`);
    const rows = Array.isArray(d)? d : (d.data||[]);
    buildTable({
      id:'tablePromo', theadClass:'table-success',
      columns:[{key:'id',label:'ID'},{key:'title',label:'Judul'},{key:'description',label:'Deskripsi'},{key:'valid_until',label:'Berlaku Sampai'}],
      rows,
      actions:(r)=>`<button class="btn btn-sm btn-outline-success me-1" onclick='openModal("promo",${JSON.stringify(r)})'>✏️</button>
                   <button class="btn btn-sm btn-outline-danger" onclick='deleteItem("promo",${JSON.stringify(r)})'>🗑️</button>`
    });
  }catch(e){ el.innerHTML=`<div class='alert alert-warning'>⚠️ API SobatPromo tidak merespon.</div>`; console.error(e); }
}

async function loadJB(){
  const el=document.getElementById('tableJB'); el.innerHTML='⏳ Memuat data...';
  try{
    const d = await safeFetch(`${API_JB}/produk`);
    const rows = d.data || d;
    buildTable({
      id:'tableJB', theadClass:'table-warning',
      columns:[{key:'id',label:'ID'},{key:'name',label:'Nama Produk'},{key:'price',label:'Harga'}],
      rows,
      actions:(r)=>`<button class="btn btn-sm btn-outline-warning me-1" onclick='openModal("justbuy",${JSON.stringify(r)})'>✏️</button>
                   <button class="btn btn-sm btn-outline-danger" onclick='deleteItem("justbuy",${JSON.stringify(r)})'>🗑️</button>`
    });
  }catch(e){ el.innerHTML=`<div class='alert alert-warning'>⚠️ API JustBuy tidak merespon.</div>`; console.error(e); }
}

async function loadRes(){
  const el=document.getElementById('tableRes'); el.innerHTML='⏳ Memuat data...';
  try{
    const d = await safeFetch(`${API_RES}/reservasi`);
    const rows = d.data || d;
    buildTable({
      id:'tableRes', theadClass:'table-danger',
      columns:[{key:'id',label:'ID'},{key:'nama',label:'Nama'},{key:'tanggal',label:'Tanggal'},{key:'jam',label:'Jam'}],
      rows,
      actions:(r)=>`<button class="btn btn-sm btn-outline-danger me-1" onclick='openModal("reservasi",${JSON.stringify(r)})'>✏️</button>
                   <button class="btn btn-sm btn-outline-danger" onclick='deleteItem("reservasi",${JSON.stringify(r)})'>🗑️</button>`
    });
  }catch(e){ el.innerHTML=`<div class='alert alert-warning'>⚠️ API Reservasi tidak merespon.</div>`; console.error(e); }
}

/* ===== Public API (simulasi CRUD di UI) ===== */
let PUBLIC_CACHE = [];
async function loadPublic(){
  const el=document.getElementById('tablePublic'); el.innerHTML='⏳ Memuat data...';
  try{
    const d = await safeFetch(API_PUBLIC);
    PUBLIC_CACHE = d.slice(0,10);
    await renderPublic();
  }catch(e){ el.innerHTML=`<div class='alert alert-warning'>⚠️ Gagal memuat Public API.</div>`; console.error(e); }
}
async function renderPublic(){
  buildTable({
    id:'tablePublic', theadClass:'table-secondary',
    columns:[{key:'id',label:'ID'},{key:'title',label:'Judul'},{key:'body',label:'Konten'}],
    rows: PUBLIC_CACHE,
    actions:(r)=>`<button class="btn btn-sm btn-outline-secondary me-1" onclick='openModal("public",${JSON.stringify(r)})'>✏️</button>
                 <button class="btn btn-sm btn-outline-danger" onclick='deleteItem("public",${JSON.stringify(r)})'>🗑️</button>`
  });
}

/* ================== INITIAL LOAD ================== */
loadK5(); loadK4(); loadK3(); loadPromo(); loadJB(); loadRes(); loadPublic();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
