<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>🌐 Dashboard Kolaborasi CRUD 6 Kelompok — Full CRUD</title>
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

    <!-- SobatPromo (read mostly) -->
    <div class="tab-pane fade" id="promo">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">💸 SobatPromo</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-success" onclick="openModal('promo')">➕ Tambah Promo</button>
          <button class="btn btn-sm btn-outline-success" onclick="loadSobatPromo()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePromo" class="spinner">⏳ Memuat data...</div>
      <small class="text-muted">Catatan: Beberapa server SobatPromo mungkin hanya mendukung GET/POST (update/delete bisa tergantung implementasi).</small>
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

    <!-- Public API (read-only) -->
    <div class="tab-pane fade" id="public">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">🌍 Public API</h3>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-outline-secondary" onclick="loadPublic()">🔁 Reload</button>
        </div>
      </div>
      <div id="tablePublic" class="spinner">⏳ Memuat data...</div>
      <small class="text-muted">Read-only (dummy JSONPlaceholder).</small>
    </div>
  </div>
</div>

<!-- Modal Generic CRUD -->
<div class="modal fade" id="crudModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crudModalTitle">Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
const API_K5 = "https://projek5-production.up.railway.app/api";           // kopi, nonkopi
const API_K4 = "https://projekkelompok4-production-3d9b.up.railway.app/api"; // makanan, minuman
const API_PROMO = "https://sobatpromo-api-production.up.railway.app/api.php"; // action based
const API_JB = "https://justbuy-production.up.railway.app/api";              // produk
const API_RES = "https://reservasi-production.up.railway.app/api";           // reservasi
const API_PUBLIC = "https://jsonplaceholder.typicode.com/posts";             // read only

// Field schemas per tab (untuk generate form modal)
const SCHEMAS = {
  k5: [
    {key:'name', label:'Nama', type:'text', required:true},
    {key:'description', label:'Deskripsi', type:'text', required:true},
    {key:'price', label:'Harga', type:'number', required:true},
    {key:'image', label:'Gambar (nama file/url)', type:'text'},
    {key:'category', label:'Kategori', type:'select', options:[{v:'kopi',t:'Kopi'},{v:'nonkopi',t:'Non Kopi'}], required:true}
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
    {key:'valid_until', label:'Berlaku Sampai (YYYY-MM-DD)', type:'date'}
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

// ================= HELPERS =================
async function safeFetch(url, options = {}, retries = 1) {
  for (let i=0; i<=retries; i++) {
    try {
      const res = await fetch(url, options);
      if (!res.ok) throw new Error(`${res.status}`);
      const type = res.headers.get('content-type')||'';
      if (type.includes('application/json')) return await res.json();
      return await res.text();
    } catch (e) {
      if (i===retries) throw e;
      await new Promise(r=>setTimeout(r, 1200));
    }
  }
}

function buildTable({container, theadClass, columns, rows, actions}) {
  const el = document.getElementById(container);
  if (!rows || rows.length===0) {
    el.innerHTML = `<div class="alert alert-info">Tidak ada data.</div>`;
    return;
  }
  const head = `<thead class="${theadClass||''}"><tr>${columns.map(c=>`<th>${c.label}</th>`).join('')}<th>Aksi</th></tr></thead>`;
  const body = `<tbody>${rows.map(item=>{
    const tds = columns.map(c=>`<td>${(item[c.key]??'-')}</td>`).join('');
    return `<tr>${tds}<td class="text-nowrap">${actions(item)}</td></tr>`;
  }).join('')}</tbody>`;
  el.innerHTML = `<div class="table-responsive"><table class="table table-striped table-hover">${head}${body}</table></div>`;
}

// ============== MODAL (create/update) ==============
let currentModalCtx = null; // {tab, mode, schemaKey, item, endpointBase}

function openModal(tab, init = {}) {
  const modalTitle = document.getElementById('crudModalTitle');
  const modalBody = document.getElementById('crudModalBody');
  const form = document.getElementById('crudForm');

  const ctx = { tab, mode: init.id? 'edit':'create', item: init };

  // Tentukan schema & endpointBase per tab
  if (tab === 'k5') {
    ctx.schemaKey = 'k5';
    // category menentukan endpointBase kopi/nonkopi
    ctx.endpointBase = (init.category==='nonkopi')? 'nonkopi':'kopi';
  } else if (tab==='k4') {
    ctx.endpointBase = init._endpointBase || (init._endpointBaseGuess||'makanan');
    ctx.schemaKey = ctx.endpointBase==='minuman' ? 'k4_minuman' : 'k4_makanan';
  } else if (tab==='promo') {
    ctx.schemaKey = 'promo';
  } else if (tab==='justbuy') {
    ctx.schemaKey = 'justbuy';
  } else if (tab==='reservasi') {
    ctx.schemaKey = 'reservasi';
  }

  // Build form fields
  const schema = SCHEMAS[ctx.schemaKey];
  modalTitle.textContent = (ctx.mode==='edit'? 'Edit':'Tambah') + ` (${tab.toUpperCase()})`;
  modalBody.innerHTML = schema.map(f=>{
    const value = (ctx.item && (ctx.item[f.key]!==undefined))? ctx.item[f.key] : '';
    if (f.type==='select') {
      const opts = (f.options||[]).map(o=>`<option value="${o.v}" ${value==o.v?'selected':''}>${o.t}</option>`).join('');
      return `<div class="mb-3"><label class="form-label">${f.label}</label><select class="form-select" name="${f.key}" ${f.required?'required':''}>${opts}</select></div>`;
    }
    return `<div class="mb-3"><label class="form-label">${f.label}</label><input class="form-control" type="${f.type}" name="${f.key}" value="${value}" ${f.required?'required':''}></div>`;
  }).join('');

  currentModalCtx = ctx;

  // Submit handler
  form.onsubmit = async (e)=>{
    e.preventDefault();
    const fd = new FormData(form);
    const data = Object.fromEntries(fd.entries());

    try {
      if (ctx.tab==='k5') {
        const base = data.category || ctx.endpointBase || 'kopi';
        const url = `${API_K5}/${base}` + (ctx.mode==='edit'? `/${ctx.item.id}`:'' );
        const method = ctx.mode==='edit'? 'PUT':'POST';
        await safeFetch(url, { method, headers:{'Content-Type':'application/json'}, body: JSON.stringify({
          name: data.name, description: data.description, price: Number(data.price), image: data.image||'', category: base
        })});
        bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();
        await loadKelompok5();
      }
      else if (ctx.tab==='k4') {
        const base = ctx.endpointBase; // makanan atau minuman
        const url = `${API_K4}/${base}` + (ctx.mode==='edit'? `/${ctx.item.id}`:'' );
        const method = ctx.mode==='edit'? 'PUT':'POST';
        await safeFetch(url, { method, headers:{'Content-Type':'application/json'}, body: JSON.stringify({
          name: data.name, description: data.description||'', price: Number(data.price)
        })});
        bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();
        await loadKelompok4();
      }
      else if (ctx.tab==='promo') {
        // Asumsi backend menerima via action=add / update
        const action = ctx.mode==='edit' ? `update&id=${encodeURIComponent(ctx.item.id)}` : 'add';
        const url = `${API_PROMO}?action=${action}`;
        await safeFetch(url, { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({
          title: data.title, description: data.description||'', valid_until: data.valid_until||null
        })});
        bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();
        await loadSobatPromo();
      }
      else if (ctx.tab==='justbuy') {
        const url = `${API_JB}/produk` + (ctx.mode==='edit'? `/${ctx.item.id}`:'' );
        const method = ctx.mode==='edit'? 'PUT':'POST';
        await safeFetch(url, { method, headers:{'Content-Type':'application/json'}, body: JSON.stringify({
          name: data.name, price: Number(data.price)
        })});
        bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();
        await loadJustBuy();
      }
      else if (ctx.tab==='reservasi') {
        const url = `${API_RES}/reservasi` + (ctx.mode==='edit'? `/${ctx.item.id}`:'' );
        const method = ctx.mode==='edit'? 'PUT':'POST';
        await safeFetch(url, { method, headers:{'Content-Type':'application/json'}, body: JSON.stringify({
          nama: data.nama, tanggal: data.tanggal, jam: data.jam
        })});
        bootstrap.Modal.getInstance(document.getElementById('crudModal')).hide();
        await loadReservasi();
      }
    } catch(err) {
      alert('Gagal menyimpan. Pastikan API mendukung method ini & CORS diizinkan.');
      console.error(err);
    }
  };

  // Tampilkan modal
  const modal = new bootstrap.Modal(document.getElementById('crudModal'));
  modal.show();
}

async function deleteItem(tab, item) {
  if (!confirm(`Yakin hapus data ID ${item.id}?`)) return;
  try {
    if (tab==='k5') {
      const base = item.category || (item._endpointBase||'kopi');
      await safeFetch(`${API_K5}/${base}/${item.id}`, { method:'DELETE' });
      await loadKelompok5();
    } else if (tab==='k4') {
      const base = item._endpointBase || 'makanan';
      await safeFetch(`${API_K4}/${base}/${item.id}`, { method:'DELETE' });
      await loadKelompok4();
    } else if (tab==='promo') {
      await safeFetch(`${API_PROMO}?action=delete&id=${encodeURIComponent(item.id)}`);
      await loadSobatPromo();
    } else if (tab==='justbuy') {
      await safeFetch(`${API_JB}/produk/${item.id}`, { method:'DELETE' });
      await loadJustBuy();
    } else if (tab==='reservasi') {
      await safeFetch(`${API_RES}/reservasi/${item.id}`, { method:'DELETE' });
      await loadReservasi();
    }
  } catch (e) {
    alert('Gagal menghapus. Pastikan API aktif & mengizinkan DELETE.');
    console.error(e);
  }
}

// ================= LOADERS (READ) =================
async function loadKelompok5() {
  const el = document.getElementById('tableKopi');
  el.innerHTML = `<div class='spinner'>⏳ Memuat data...</div>`;
  try {
    const kopiRes = await safeFetch(`${API_K5}/kopi`);
    const nonRes = await safeFetch(`${API_K5}/nonkopi`);
    const kopi = (kopiRes.data || kopiRes).map(x=>({...x, category:'kopi', _endpointBase:'kopi'}));
    const nonkopi = (nonRes.data || nonRes).map(x=>({...x, category:'nonkopi', _endpointBase:'nonkopi'}));
    const rows = [...kopi, ...nonkopi];

    buildTable({
      container:'tableKopi',
      theadClass:'table-dark',
      columns:[
        {key:'id', label:'ID'},
        {key:'name', label:'Nama'},
        {key:'description', label:'Deskripsi'},
        {key:'price', label:'Harga'},
        {key:'image', label:'Gambar'},
      ],
      rows,
      actions:(item)=>`
        <span class='badge bg-secondary badge-pill me-1'>${item.category}</span>
        <button class='btn btn-sm btn-outline-primary me-1' onclick='openModal("k5", ${JSON.stringify(item)})'>✏️</button>
        <button class='btn btn-sm btn-outline-danger' onclick='deleteItem("k5", ${JSON.stringify(item)})'>🗑️</button>`
    });
  } catch(e) {
    el.innerHTML = `<div class='alert alert-warning'>⚠️ API Kelompok 5 tidak merespon / CORS. </div>`;
    console.error(e);
  }
}

async function loadKelompok4() {
  const el = document.getElementById('tableK4');
  el.innerHTML = `<div class='spinner'>⏳ Memuat data...</div>`;
  try {
    const mkn = await safeFetch(`${API_K4}/makanan`);
    const mnm = await safeFetch(`${API_K4}/minuman`);
    const rows = [
      ...(mkn.data||mkn).map(x=>({...x, _endpointBase:'makanan'})),
      ...(mnm.data||mnm).map(x=>({...x, _endpointBase:'minuman'})),
    ];
    buildTable({
      container:'tableK4',
      theadClass:'table-primary',
      columns:[
        {key:'id', label:'ID'},
        {key:'name', label:'Nama'},
        {key:'description', label:'Deskripsi'},
        {key:'price', label:'Harga'},
      ],
      rows,
      actions:(item)=>`
        <span class='badge bg-info text-dark badge-pill me-1'>${item._endpointBase}</span>
        <button class='btn btn-sm btn-outline-primary me-1' onclick='openModal("k4", ${JSON.stringify(item)})'>✏️</button>
        <button class='btn btn-sm btn-outline-danger' onclick='deleteItem("k4", ${JSON.stringify(item)})'>🗑️</button>`
    });
  } catch(e) {
    el.innerHTML = `<div class='alert alert-warning'>⚠️ API Kelompok 4 tidak merespon / endpoint salah.</div>`;
    console.error(e);
  }
}

async function loadSobatPromo() {
  const el = document.getElementById('tablePromo');
  el.innerHTML = `<div class='spinner'>⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(`${API_PROMO}?action=list`);
    const rows = Array.isArray(data)? data : (data.data||[]);
    buildTable({
      container:'tablePromo',
      theadClass:'table-success',
      columns:[
        {key:'id', label:'ID'},
        {key:'title', label:'Judul'},
        {key:'description', label:'Deskripsi'},
        {key:'valid_until', label:'Berlaku Sampai'},
      ],
      rows,
      actions:(item)=>`
        <button class='btn btn-sm btn-outline-success me-1' onclick='openModal("promo", ${JSON.stringify(item)})'>✏️</button>
        <button class='btn btn-sm btn-outline-danger' onclick='deleteItem("promo", ${JSON.stringify(item)})'>🗑️</button>`
    });
  } catch(e) {
    el.innerHTML = `<div class='alert alert-warning'>⚠️ API SobatPromo tidak merespon / mungkin read-only.</div>`;
    console.error(e);
  }
}

async function loadJustBuy() {
  const el = document.getElementById('tableJustBuy');
  el.innerHTML = `<div class='spinner'>⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(`${API_JB}/produk`);
    const rows = Array.isArray(data)? data : (data.data||[]);
    buildTable({
      container:'tableJustBuy',
      theadClass:'table-warning',
      columns:[
        {key:'id', label:'ID'},
        {key:'name', label:'Nama Produk'},
        {key:'price', label:'Harga'},
      ],
      rows,
      actions:(item)=>`
        <button class='btn btn-sm btn-outline-warning me-1' onclick='openModal("justbuy", ${JSON.stringify(item)})'>✏️</button>
        <button class='btn btn-sm btn-outline-danger' onclick='deleteItem("justbuy", ${JSON.stringify(item)})'>🗑️</button>`
    });
  } catch(e) {
    el.innerHTML = `<div class='alert alert-warning'>⚠️ API JustBuy tidak merespon / Railway tidur.</div>`;
    console.error(e);
  }
}

async function loadReservasi() {
  const el = document.getElementById('tableReservasi');
  el.innerHTML = `<div class='spinner'>⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(`${API_RES}/reservasi`);
    const rows = Array.isArray(data)? data : (data.data||[]);
    buildTable({
      container:'tableReservasi',
      theadClass:'table-danger',
      columns:[
        {key:'id', label:'ID'},
        {key:'nama', label:'Nama'},
        {key:'tanggal', label:'Tanggal'},
        {key:'jam', label:'Jam'},
      ],
      rows,
      actions:(item)=>`
        <button class='btn btn-sm btn-outline-danger me-1' onclick='openModal("reservasi", ${JSON.stringify(item)})'>✏️</button>
        <button class='btn btn-sm btn-outline-danger' onclick='deleteItem("reservasi", ${JSON.stringify(item)})'>🗑️</button>`
    });
  } catch(e) {
    el.innerHTML = `<div class='alert alert-warning'>⚠️ API Reservasi tidak merespon.</div>`;
    console.error(e);
  }
}

async function loadPublic() {
  const el = document.getElementById('tablePublic');
  el.innerHTML = `<div class='spinner'>⏳ Memuat data...</div>`;
  try {
    const data = await safeFetch(API_PUBLIC);
    const rows = (Array.isArray(data)? data : []).slice(0, 10);
    buildTable({
      container:'tablePublic',
      theadClass:'table-secondary',
      columns:[{key:'id',label:'ID'},{key:'title',label:'Judul'},{key:'body',label:'Konten'}],
      rows,
      actions:()=>`<span class='text-muted'>Read-only</span>`
    });
  } catch(e) {
    el.innerHTML = `<div class='alert alert-warning'>⚠️ Public API tidak merespon.</div>`;
    console.error(e);
  }
}

// Load saat awal
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
