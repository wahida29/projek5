<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>☕ Dashboard CRUD API — Final Version</title>
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
    .badge-endpoint{font-size:.75rem;background:#eef;border:1px solid #dde;color:#334;padding:.2rem .5rem;border-radius:.4rem}
  </style>
</head>
<body>
<div class="container py-5">

  <h1 class="text-center mb-4"><i class="bi bi-database-gear"></i> Dashboard CRUD 7 Kelompok</h1>
  <p class="text-center muted mb-4">
    <span class="badge-endpoint">PUT/DELETE otomatis dikonversi ke POST agar kompatibel Railway ✅</span>
  </p>

  <!-- KONFIGURASI ENDPOINT -->
  <script>
    const BASE = {
      SOBAT_PROMO : "https://sobatpromo-api-production.up.railway.app/api.php",
      JUSTBUY      : "https://projekkelompok9-production.up.railway.app/api",
      GADGET       : "https://your-gadget-house-api.example.com/api",
      KRUSIT       : "https://projekkelompok4-production-3d9b.up.railway.app/api",
      COFFEESHOP   : "https://projek5-production.up.railway.app/api",
      RESERVASI    : "https://your-reservasi-api.example.com/api",
      MAGURU       : "http://localhost:3001/api/public"
    };
  </script>

  <!-- NAVIGATION TABS -->
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

  <!-- =======================================================
       SEMUA TAB DARI KOLEKSI KAMU
       (disingkat di sini karena sama seperti versi sebelumnya)
       ======================================================= -->
  <!-- paste seluruh struktur tab SobatPromo–Maguru milikmu di sini;
       tidak perlu diubah apa pun selain bagian script di bawah -->

</div>

<!-- =============== SCRIPT JAVASCRIPT =============== -->
<script>
/* === NOTIFIKASI === */
const alertBox=document.getElementById('alertBox');
function notify(type,msg){
  alertBox.className=`alert alert-${type}`;
  alertBox.textContent=msg;
  alertBox.classList.remove('d-none');
  setTimeout(()=>alertBox.classList.add('d-none'),2500);
}

/* === API FUNCTION (versi Railway friendly) === */
async function api(method,url,body=null){
  const opt={method,headers:{'Content-Type':'application/json'}};
  if(body) opt.body=JSON.stringify(body);

  // 🚀 fallback PUT/DELETE → POST
  if(['PUT','DELETE'].includes(method.toUpperCase())){
    const real=method.toUpperCase();
    url+=(url.includes('?')?'&':'?')+`_method=${real}`;
    opt.method='POST';
  }

  const res=await fetch(url,opt);
  if(!res.ok) throw new Error(`${res.status} ${res.statusText}`);
  const ct=res.headers.get('content-type')||'';
  return ct.includes('application/json')?res.json():res.text();
}

/* === ENDPOINT BADGES === */
function fillEndpointBadges(){
  if(typeof ep1!=="undefined"){
    ep1.textContent=BASE.SOBAT_PROMO;
    ep2.textContent=BASE.JUSTBUY;
    ep3.textContent=BASE.GADGET;
    ep4.textContent=BASE.KRUSIT;
    ep5.textContent=BASE.COFFEESHOP;
    ep6.textContent=BASE.RESERVASI;
    ep7.textContent=BASE.MAGURU;
  }
}
fillEndpointBadges();

/* =====================================================
   ⬇️ Semua fungsi loadSp(), loadJustBuy(), loadGadget(),
   loadKrusit(), loadCoffee(), loadReservasi(), loadMaguru()
   dari file lamamu tetap dipakai TANPA perlu diubah.
   Karena fungsi api() di atas sudah otomatis handle PUT/DELETE.
   ===================================================== */

/* Contoh kecil (SobatPromo) */
let sp_editId=null;
async function loadSp(){
  const url=`${BASE.SOBAT_PROMO}?action=list`;
  try{
    const data=await api('GET',url);
    const rows=Array.isArray(data)?data:(data?.data||[]);
    tbl1.querySelector('tbody').innerHTML=rows.length?
      rows.map((p,i)=>`
        <tr>
          <td>${i+1}</td>
          <td>${p.title||''}</td>
          <td>${p.description||''}</td>
          <td>${p.valid_until||''}</td>
          <td>
            <button class="btn btn-warning btn-sm"
              onclick='spStartEdit(${p.id||i},"${(p.title||"").replace(/"/g,"&quot;")}","${(p.description||"").replace(/"/g,"&quot;")}","${p.valid_until||""}")'>
              <i class="bi bi-pencil-square"></i></button>
            <button class="btn btn-danger btn-sm"
              onclick='spDelete(${p.id||i})'><i class="bi bi-trash3"></i></button>
          </td>
        </tr>`).join('')
      :`<tr><td colspan="5" class="muted">Tidak ada data</td></tr>`;
  }catch(e){
    tbl1.querySelector('tbody').innerHTML=`<tr><td colspan="5" class="text-danger">Gagal muat: ${e.message}</td></tr>`;
  }
}
function spStartEdit(id,t,d,u){sp_editId=id;p1_title.value=t;p1_desc.value=d;p1_until.value=(u||"").substring(0,10);}
async function spDelete(id){
  if(!confirm("Hapus promo?"))return;
  try{await api('POST',`${BASE.SOBAT_PROMO}?action=delete&id=${id}`);notify('success','Dihapus');loadSp();}
  catch(e){notify('danger',e.message);}
}
form1.addEventListener('submit',async e=>{
  e.preventDefault();
  const data={title:p1_title.value,description:p1_desc.value,valid_until:p1_until.value};
  const act=sp_editId==null?'create':`update&id=${sp_editId}`;
  try{
    await api('POST',`${BASE.SOBAT_PROMO}?action=${act}`,data);
    sp_editId=null;form1.reset();notify('success','Tersimpan');loadSp();
  }catch(e){notify('danger',e.message);}
});
reload1.addEventListener('click',loadSp);

/* Panggil semua loader saat pertama buka halaman */
document.addEventListener('DOMContentLoaded',()=>{
  loadSp();
  // loadJustBuy(); loadGadget(); loadKrusit(); loadCoffee(); loadReservasi(); loadMaguru();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
