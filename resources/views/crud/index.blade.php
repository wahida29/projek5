<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>🌐 Dashboard Kolaborasi CRUD 7 Kelompok</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background: #f8f9fa; font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }
    h1 { font-weight: 700; color: #222; }
    .tab-pane { animation: fadeIn 0.3s ease-in-out; }
    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
    .spinner { text-align: center; padding: 30px; color: #666; font-style: italic; }
    .table thead th { white-space: nowrap; }
  </style>
</head>
<body>
<div class="container py-4">
  <h1 class="text-center mb-4">🌐 Dashboard Kolaborasi CRUD 7 Kelompok</h1>

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
    <div class="tab-pane fade show active" id="k5"><h3>☕ CaffeShop</h3><div id="tableK5" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="k4"><h3>🍔 Krusit</h3><div id="tableK4" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="k3"><h3>📱 Gadget House</h3><div id="tableK3" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="promo"><h3>💸 SobatPromo</h3><div id="tablePromo" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="justbuy"><h3>🛍️ JustBuy</h3><div id="tableJB" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="reservasi"><h3>📅 Reservasi</h3><div id="tableRes" class="spinner">⏳ Memuat data...</div></div>
    <div class="tab-pane fade" id="public"><h3>🌍 Public API</h3><div id="tablePublic" class="spinner">⏳ Memuat data...</div></div>
  </div>
</div>

<script>
// ================= CONFIG =================
// 👉 gunakan proxy bawaan Laravel agar tidak error CORS di Railway
const API_K3 = "/proxy/k3";
const API_K4 = "/proxy/k4";
const API_K5 = "/proxy/k5";
const API_PROMO = "/proxy/promo";
const API_JB = "/proxy/justbuy";
const API_RES = "/proxy/reservasi";
const API_PUBLIC = "https://jsonplaceholder.typicode.com/posts";

async function safeFetch(url,options={}){
  try{
    const res=await fetch(url,options);
    if(!res.ok) throw new Error(res.status);
    const type=res.headers.get("content-type")||"";
    return type.includes("application/json") ? await res.json() : await res.text();
  }catch(e){
    console.error("Fetch error:",url,e);
    throw e;
  }
}

function buildTable(id,theadClass,cols,rows){
  const el=document.getElementById(id);
  if(!rows||rows.length===0){
    el.innerHTML='<div class="alert alert-info">Tidak ada data.</div>';return;
  }
  const head='<thead class="'+theadClass+'"><tr>'+cols.map(c=>`<th>${c.label}</th>`).join('')+'</tr></thead>';
  const body='<tbody>'+rows.map(r=>'<tr>'+cols.map(c=>`<td>${r[c.key]??'-'}</td>`).join('')+'</tr>').join('')+'</tbody>';
  el.innerHTML='<div class="table-responsive"><table class="table table-striped">'+head+body+'</table></div>';
}

// ========== LOAD DATA PER KELOMPOK ==========
async function loadKelompok3(){
  const el=document.getElementById("tableK3");el.innerHTML="⏳ Memuat data...";
  try{
    const d=await safeFetch(`${API_K3}/produk`);
    buildTable("tableK3","table-info",[
      {key:"id",label:"ID"},{key:"nama",label:"Nama"},{key:"kategori",label:"Kategori"},
      {key:"harga",label:"Harga"},{key:"stok",label:"Stok"}
    ],d.data||d);
  }catch(e){el.innerHTML="<div class='alert alert-warning'>⚠️ API GadgetHouse tidak merespon.</div>";}
}

async function loadKelompok4(){
  const el=document.getElementById("tableK4");el.innerHTML="⏳ Memuat data...";
  try{
    const mkn=await safeFetch(`${API_K4}/makanan`);
    const mnm=await safeFetch(`${API_K4}/minuman`);
    const data=[...(mkn.data||mkn),...(mnm.data||mnm)];
    buildTable("tableK4","table-primary",[
      {key:"id",label:"ID"},{key:"name",label:"Nama"},{key:"description",label:"Deskripsi"},{key:"price",label:"Harga"}
    ],data);
  }catch(e){el.innerHTML="<div class='alert alert-warning'>⚠️ API Krusit tidak merespon.</div>";}
}

async function loadKelompok5(){
  const el=document.getElementById("tableK5");el.innerHTML="⏳ Memuat data...";
  try{
    const kopi=await safeFetch(`${API_K5}/kopi`);
    const nonkopi=await safeFetch(`${API_K5}/nonkopi`);
    const data=[...(kopi.data||kopi),...(nonkopi.data||nonkopi)];
    buildTable("tableK5","table-dark",[
      {key:"id",label:"ID"},{key:"name",label:"Nama"},{key:"description",label:"Deskripsi"},
      {key:"price",label:"Harga"},{key:"category",label:"Kategori"}
    ],data);
  }catch(e){el.innerHTML="<div class='alert alert-warning'>⚠️ API CaffeShop tidak merespon.</div>";}
}

async function loadSobatPromo(){
  const el=document.getElementById("tablePromo");el.innerHTML="⏳ Memuat data...";
  try{
    const d=await safeFetch(`${API_PROMO}?action=list`);
    buildTable("tablePromo","table-success",[
      {key:"id",label:"ID"},{key:"title",label:"Judul"},{key:"description",label:"Deskripsi"},{key:"valid_until",label:"Berlaku Sampai"}
    ],d.data||d);
  }catch(e){el.innerHTML="<div class='alert alert-warning'>⚠️ API SobatPromo tidak merespon.</div>";}
}

async function loadJustBuy(){
  const el=document.getElementById("tableJB");el.innerHTML="⏳ Memuat data...";
  try{
    const d=await safeFetch(`${API_JB}/produk`);
    buildTable("tableJB","table-warning",[
      {key:"id",label:"ID"},{key:"name",label:"Nama Produk"},{key:"price",label:"Harga"}
    ],d.data||d);
  }catch(e){el.innerHTML="<div class='alert alert-warning'>⚠️ API JustBuy tidak merespon.</div>";}
}

async function loadReservasi(){
  const el=document.getElementById("tableRes");el.innerHTML="⏳ Memuat data...";
  try{
    const d=await safeFetch(`${API_RES}/reservasi`);
    buildTable("tableRes","table-danger",[
      {key:"id",label:"ID"},{key:"nama",label:"Nama"},{key:"tanggal",label:"Tanggal"},{key:"jam",label:"Jam"}
    ],d.data||d);
  }catch(e){el.innerHTML="<div class='alert alert-warning'>⚠️ API Reservasi tidak merespon.</div>";}
}

async function loadPublic(){
  const el=document.getElementById("tablePublic");el.innerHTML="⏳ Memuat data...";
  try{
    const d=await safeFetch(API_PUBLIC);
    buildTable("tablePublic","table-secondary",[
      {key:"id",label:"ID"},{key:"title",label:"Judul"},{key:"body",label:"Isi"}
    ],d.slice(0,10));
  }catch(e){el.innerHTML="<div class='alert alert-warning'>⚠️ Gagal memuat Public API.</div>";}
}

// Jalankan semuanya
loadKelompok3();
loadKelompok4();
loadKelompok5();
loadSobatPromo();
loadJustBuy();
loadReservasi();
loadPublic();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
